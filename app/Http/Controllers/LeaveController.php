<?php

namespace App\Http\Controllers;

use App\Classes\LeaveCalculatorHelper;
use App\Enums\StatusEnum;
use App\Models\EmployeeLeaveInformation;
use App\Models\Entry;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaveCredits = EmployeeLeaveInformation::with('leaveType')->where('user_id', auth()->id())->get();
        $leaves = Leave::where('user_id', auth()->id())->with('user.employmentDetail')->paginate(10);
        return view('leaves.index', compact('leaves', 'leaveCredits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leaveCredits = EmployeeLeaveInformation::with('leaveType')->where('user_id', auth()->id())->get();
        return view('leaves.create', compact('leaveCredits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'leave_type' => 'required',
            'date' => 'required|date|after_or_equal:now',
            'type' => 'required',
            'reason' => 'required'
        ]);

        Leave::create([
            'user_id' => auth()->id(),
            'leave_type_id' => $request->leave_type,
            'date' => $request->date,
            'type' => $request->type,
            'reason' => $request->reason,
            'total_credit' => $request->type
        ]);

        return redirect(route('leaves.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cancelPage(Leave $leave)
    {
        return view('leaves.cancel', compact('leave'));
    }

    public function cancelOperation(Request $request, Leave $leave)
    {
        $data = ['remarks' => $request->remarks];

        if (auth()->id() == $leave->created_by) {
            $data['status'] = StatusEnum::CANCELLED->value;
            $data['is_mgr_approval_status'] = StatusEnum::CANCELLED->value;
            $data['is_sp_approval_status'] = StatusEnum::CANCELLED->value;
        }

        if (auth()->id() == $leave->user->employmentDetail->manager_id) {
            $data['is_mgr_approval_status'] = StatusEnum::REJECTED->value;
        }

        if (auth()->id() == $leave->user->employmentDetail->supervisor_id) {
            $data['is_sp_approval_status'] = StatusEnum::REJECTED->value;
        }

        $leave->update($data);
        $leave->refresh();

        if ($leave->is_mgr_approval_status == StatusEnum::REJECTED->value && $leave->is_sp_approval_status == StatusEnum::REJECTED->value) {
            $leave->update([
                'status' => StatusEnum::REJECTED->value
            ]);
        }

        if (auth()->id() == $leave->created_by) {
            return redirect(route('leaves.index'));
        }

        return redirect(route('employees.leaves', ['employee_id' => $leave->created_by]));
    }

    public function approveOperation(Leave $leave)
    {
        $data = [];

        if (auth()->id() == $leave->user->employmentDetail->manager_id) {
            $data['is_mgr_approval_status'] = StatusEnum::APPROVED->value;
        }

        if (auth()->id() == $leave->user->employmentDetail->supervisor_id) {
            $data['is_sp_approval_status'] = StatusEnum::APPROVED->value;
        }

        $leave->update($data);
        $leave->refresh();

        if ($leave->is_mgr_approval_status == StatusEnum::APPROVED->value && $leave->is_sp_approval_status == StatusEnum::APPROVED->value) {
            $leave->update([
                'status' => StatusEnum::APPROVED->value
            ]);

            $leaveCredit = EmployeeLeaveInformation::where([
                'user_id' => $leave->created_by,
                'leave_type_id' => $leave->leave_type_id
            ])->first();

            $leaveCredit->update([
                'balance' => ($leaveCredit->balance - $leave->total_credit)
            ]);

            $clockIn = Carbon::createFromFormat('Y-m-d', $leave->date);
            $clockIn->hour = (int) config('app.clock_in');
            $clockIn->minute = (int) 0;
            $clockIn->second = (int) 0;

            $clockOut = Carbon::createFromFormat('Y-m-d', $leave->date);
            $clockOut->hour = (int) config('app.clock_out');
            $clockOut->minute = (int) 0;
            $clockOut->second = (int) 0;

            Entry::create([
                'user_id'  => $leave->created_by,
                'clock_in' => $clockIn,
                'clock_out' => $clockOut
            ]);
        }

        return redirect()->back();
    }
}
