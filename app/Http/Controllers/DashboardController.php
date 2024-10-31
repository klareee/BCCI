<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $entry = Entry::whereDate('clock_in', Carbon::today())
            ->where('user_id', Auth::id())
            ->orderBy('clock_in', 'desc')
            ->first();

        $state              = (isset($entry) && empty($entry->clock_out)) ? 'clock out' : 'clock in';
        $hasClockedOutToday = !empty($entry->clock_out);

        return view('dashboard', compact('entry', 'state', 'hasClockedOutToday'));
    }
}
