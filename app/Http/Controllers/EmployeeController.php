<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\EmployeeRequest;
use App\Models\Benefit;
use App\Models\Deduction;
use App\Models\EmploymentDetail;
use App\Models\Leave;
use App\Models\PayrollInformation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::with(['role', 'employmentDetail'])
            // ->whereHas('role', fn($query) => $query->whereNot('name', RoleEnum::ADMIN))
            ->paginate(10);

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $managers =  User::with(['role', 'employmentDetail'])
            ->whereHas('employmentDetail', fn($query) => $query->where('position', 'like', "%manager%"))
            ->get();
        return view('employees.create', compact('managers'));
    }

    public function store(EmployeeRequest $request)
    {
        $user = User::create([
            ...$request->only([
                'first_name',
                'last_name',
                'gender',
                'marital_status',
                'date_of_birth',
                'contact_number',
                'address',
                'email'
            ]),
            'role_id' => Role::where('name', RoleEnum::EMPLOYEE)->first()?->id,
            'password' => bcrypt('bcci_1234')
        ]);

        EmploymentDetail::create([
            ...$request->only([
                'position',
                'department',
                'employment_status',
                'date_hired',
                'date_regularized',
            ]),
            'manager_id' => $request->manager,
            'user_id' => $user->id,
        ]);

        PayrollInformation::create([
            ...$request->only([
                'basic_salary',
                'pay_mode',
                'payment_method',
                'bank_account'
            ]),
            'user_id' => $user->id,
        ]);

        return redirect(route('employees.index'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $user->load('role','employmentDetail', 'payrollInformation');

        return view('employees.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $user->load('role','employmentDetail', 'payrollInformation');
        $managers =  User::with(['role', 'employmentDetail'])
            ->whereHas('employmentDetail', fn($query) => $query->where('position', 'like', "%manager%"))
            ->get();
        return view('employees.edit', compact('user', 'managers'));
    }

    public function update(EmployeeRequest $request)
    {
        $user = User::findOrFail($request->employee);

        $user->update($request->only([
            'first_name',
            'last_name',
            'gender',
            'marital_status',
            'date_of_birth',
            'contact_number',
            'address',
        ]));

        $user->employmentDetail->update([
            ...$request->only([
            'position',
            'department',
            'employment_status',
            'date_hired',
            'date_regularized',
            ]),
            'manager_id' => $request->manager,
        ]);

        $user->payrollInformation->update($request->only([
            'basic_salary',
            'pay_mode',
            'payment_method',
        ]));

        return redirect(route('employees.index'));

    }

    public function destroy($id)
    {
        User::findOrFail($id)?->delete();
        return back();
    }

    public function leaves($id)
    {
        $user = User::findOrFail($id);

        $leaves = Leave::where('user_id', $id)->paginate(10);

        return view('employees.subview.leaves', compact('leaves', 'user'));
    }

    public function deductions($id)
    {
        $user = User::findOrFail($id);

        $deductions = Deduction::where('user_id', $id)->paginate(10);

        return view('employees.subview.deductions', compact('deductions', 'user'));
    }

    public function deduction_create($id)
    {
        $user = User::findOrFail($id);

        $benefits = Benefit::get();

        return view('deductions.create', compact('benefits', 'user'));
    }
}
