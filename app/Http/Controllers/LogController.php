<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Logbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Logbook  $logbook
     * @return \Illuminate\Http\Response
     */
    public function index(Logbook $logbook)
    {
        Gate::authorize('modify-logbook', $logbook);

        return view('pages.logs.index', [
            'logs' => $logbook->logs->sortByDesc('date'),
            'logbook' => $logbook
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Logbook  $logbook
     * @return \Illuminate\Http\Response
     */
    public function create(Logbook $logbook)
    {
        Gate::authorize('modify-logbook', $logbook);

        return view('pages.logs.create', [
            'logbook' => $logbook
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logbook  $logbook
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Logbook $logbook)
    {
        $attributes = $request->validate([
            'name' => 'required|min:4|max:255',
            'date' => 'required|date',
            'description' => ''
        ]);

        Gate::authorize('modify-logbook', $logbook);

        $logbook_id = $logbook->id;
        $attributes['logbook_id'] = $logbook_id;

        Log::create($attributes);

        return redirect("/logbooks/$logbook_id/logs")->with('create_success', 'Log creation successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logbook  $logbook
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(Logbook $logbook, Log $log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logbook  $logbook
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function edit(Logbook $logbook, Log $log)
    {
        Gate::authorize('modify-log', [$logbook, $log]);

        return view('pages.logs.edit', [
            'logbook' => $logbook,
            'log' => $log
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logbook  $logbook
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logbook $logbook, Log $log)
    {
        $attributes = $request->validate([
            'name' => 'required|min:4|max:255',
            'date' => 'required|date',
            'description' => ''
        ]);

        Gate::authorize('modify-log', [$logbook, $log]);

        $log->name = $attributes['name'];
        $log->date = $attributes['date'];
        $log->description = $attributes['description'] ?? '';
        $log->save();

        $logbook_id = $logbook->id;
        return redirect("/logbooks/$logbook_id/logs")->with('update_success', 'Log update successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logbook  $logbook
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logbook $logbook, Log $log)
    {
        Gate::authorize('modify-log', [$logbook, $log]);

        $log->delete();

        $logbook_id = $logbook->id;

        return redirect("/logbooks/$logbook_id/logs")->with('delete_success', 'Log deletion successful!');
    }
}
