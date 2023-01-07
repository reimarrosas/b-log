<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.logbooks.index', [
            'logbooks' => auth()->user()->logbooks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.logbooks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|min:4|max:255'
        ]);

        $attributes['user_id'] = auth()->user()->id;

        Logbook::create($attributes);

        return redirect('/logbooks')->with('create_success', 'Logbook creation successful!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logbook  $logbook
     * @return \Illuminate\Http\Response
     */
    public function edit(Logbook $logbook)
    {
        Gate::authorize('modify-logbook', $logbook);

        return view('pages.logbooks.edit', [
            'logbook' => $logbook
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logbook  $logbook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logbook $logbook)
    {
        Gate::authorize('modify-logbook', $logbook);

        $attributes = $request->validate([
            'name' => 'required|min:4|max:255'
        ]);

        $logbook->name = $attributes['name'];
        $logbook->save();

        return redirect('/logbooks')->with('update_success', 'Logbook update successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logbook  $logbook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logbook $logbook)
    {
        Gate::authorize('modify-logbook', $logbook);

        $logbook->delete();

        return redirect('/logbooks')->with('delete_success', 'Logbook deletion successful!');
    }
}
