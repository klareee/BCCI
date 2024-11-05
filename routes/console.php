<?php

use App\Jobs\BiMonthlyPayroll;
use App\Jobs\MonthlyPayroll;
use App\Jobs\WeeklyPayroll;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::job(new MonthlyPayroll)->lastDayOfMonth('20:00');
Schedule::job(new WeeklyPayroll)->weeklyOn(6, '20:00');

$endDayOfMonth = now()->endOfMonth()->format('m');
Schedule::job(new BiMonthlyPayroll)->twiceMonthly(15, $endDayOfMonth,'20:00');
