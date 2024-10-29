<?php

namespace App\Http\Controllers;

use App\Actions\User\{UserClocksIn, UserClocksOut};
use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entries = Entry::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);

        return view('entries.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $entry = Entry::create();

        return $entry;
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

    public function tardiness()
    {
        $time    = sprintf('%02d:00:00', (int) config('app.clock_in'));
        $entries = Entry::where('user_id', Auth::id())
            ->whereRaw('TIME(clock_in) > ?', [$time])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('entries.tardiness', compact('entries'));
    }

    public function undertime()
    {
        $time    = sprintf('%02d:00:00', (int) config('app.clock_out'));
        $entries = Entry::where('user_id', Auth::id())
            ->whereRaw('TIME(clock_out) < ?', [$time])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('entries.undertime', compact('entries'));
    }

    public function clockIn(Request $request, UserClocksIn $clockIn)
    {

        $entry = $clockIn->execute(Auth::user());

        return redirect()->route('dashboard');
    }

    public function clockOut(Request $request, UserClocksOut $clockOut)
    {
        $entry = $clockOut->execute(Auth::user(), ['clock_out' => Carbon::now()]);

        return redirect()->route('dashboard');
    }

    public function checkHasRecord()
    {
        $entry = Entry::whereDate('clock_in', Carbon::today())
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->first();

        $state = (isset($entry) && empty($entry->clock_out)) ? 'clock out' : 'clock in';

        return response()->json(['success' => true, 'state' => $state]);
    }


    public function clockInApi(Request $request, UserClocksIn $clockIn)
    {
        $entry = $clockIn->execute(Auth::user());

        return response()->json(['success' => true, 'entry' => ['clock_in' => $entry->clock_in->format('d-M-Y h:i a'), 'clock_out' => $entry->clock_out?->format('d-M-Y h:i a')]]);
    }

    public function clockOutApi(Request $request, UserClocksOut $clockOut)
    {
        $entry = $clockOut->execute(Auth::user(), ['clock_out' => Carbon::now()]);

        if (!$entry) {
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true, 'entry' => ['clock_in' => $entry->clock_in->format('d-M-Y h:i a'), 'clock_out' => $entry->clock_out?->format('d-M-Y h:i a')]]);
    }
}
