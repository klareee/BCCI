<?php

namespace App\Traits\ModelRelationships;

use App\Models\Deduction;
use App\Models\EmploymentDetail;
use App\Models\Leave;
use App\Models\PayrollInformation;
use App\Models\Role;

trait UserRelationships
{
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function employmentDetail()
    {
        return $this->hasOne(EmploymentDetail::class);
    }

    public function payrollInformation()
    {
        return $this->hasOne(PayrollInformation::class);
    }

    public function deductions()
    {
        return $this->hasMany(Deduction::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}
