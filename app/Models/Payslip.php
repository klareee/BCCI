<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "start_date",
        "end_date",
        "total_earn",
        "total_deductions",
        "overall_total",
        "status",
    ];
}
