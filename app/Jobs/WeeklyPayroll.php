<?php

namespace App\Jobs;

use App\Classes\PaySlipCalculator;
use App\Enums\PayModeEnum;
use App\Models\Payslip;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class WeeklyPayroll implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $weeklyEmployees = User::whereHas('payrollInformation', function ($query) {
            $query->where('pay_mode', PayModeEnum::WEEKLY->value);
        })->with(['entries' => function ($query) {
            $startOfMonth = now()->startOfWeek();
            $endOfMonth = now()->endOfWeek();

            $query->where('clock_in', '>=', $startOfMonth)
                ->where('clock_out', '<=', $endOfMonth);
        }, 'deductions'])->get();

        $weeklyEmployees->each(function ($employee) {
            $rate = $employee->payrollInformation->basic_salary;
            $hourlyRate = PaySlipCalculator::getHourlyRate(6,$rate);

            $totalHours = $employee->entries->map(function ($entry) {
                [
                    'hour_worked' => $hoursWorked
                ] = PaySlipCalculator::calculateWorkingHours($entry->clock_in, $entry->clock_out);

                return collect(['worked_hours' => $hoursWorked]);
            })->sum('worked_hours');

            $totalEarn = $totalHours * $hourlyRate;
            $totalDeductions = $employee->deductions->sum('amount') / PaySlipCalculator::getWeeksByMonth();
            $overAllTotal = $totalEarn - $totalDeductions;

            Payslip::create([
                "user_id" => $employee->id,
                "start_date" => now()->startOfWeek(),
                "end_date" => now()->endOfWeek(),
                "total_earn" => $totalEarn,
                "total_deductions" => $totalDeductions,
                "overall_total" => $overAllTotal,
            ]);
        });
    }
}
