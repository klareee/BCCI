<?php

namespace App\Traits\ModelRelationships;

use App\Models\User;

trait EmploymentDetailRelationships
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }
}
