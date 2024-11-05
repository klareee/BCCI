<?php

namespace App\Http\Controllers;

use App\Classes\PaySlipCalculator;
use App\Classes\Semaphore;
use App\Enums\PayModeEnum;
use App\Models\Entry;
use App\Models\Payslip;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index() {
        Semaphore::send('09178781045', 'Hyers');

        dd('complete');
    }
}
