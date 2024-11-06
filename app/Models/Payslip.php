<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function dateRange(): Attribute
    {
        return Attribute::make(
            get: fn() => "{$this->start_date} - {$this->end_date}"
        );
    }
}
