<?php

namespace App\Actions\Employee;

use App\Models\{Entry, Overtime, User};

class EmployeeCancelsOvertime
{
    public function execute(Overtime $overtime): void
    {
        $overtime->delete();
    }
}
