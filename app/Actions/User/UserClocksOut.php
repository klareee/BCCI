<?php

namespace App\Actions\User;

use App\Models\{Entry, User};
use Illuminate\Support\Carbon;

class UserClocksOut
{
    public function execute(User $causer, array $attributes = []): Entry
    {
        $entry = Entry::whereDate('clock_in', Carbon::today())
            ->whereNull('clock_out')
            ->first();

        abort_unless(empty($entry->clock_out), 403);

        $entry->update([
            ...$attributes,
            'updated_by' => $causer->id,
        ]);

        return $entry;
    }
}
