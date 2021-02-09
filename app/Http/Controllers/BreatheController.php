<?php

namespace App\Http\Controllers;

use App\Helpers\Time;
use App\Models\Breathe;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BreatheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $breathe = Breathe::latest()->first();
        if ($breathe) {
            if ($breathe->status == 0) {
                $hour = $breathe->Start_time->diffInHours(Carbon::now());
                $min = ($breathe->Start_time->diffinMinutes(Carbon::now())) % 60;
                $sec = ($breathe->Start_time->diffinseconds(Carbon::now())) % 60;

                return view('dashboard')->with('hour', $hour)->with('min', $min)->with('sec', $sec);
            }
        }

        return view('dashboard')->with('hour', 0)->with('min', 0)->with('sec', 0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $Start_time = Carbon::now();

        Breathe::create([
            'Start_time' => Carbon::now(),
            'status' => 0

        ] + $request->all());

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Breathe  $breathe
     * @return \Illuminate\Http\Response
     */
    public function show(Breathe $breathe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Breathe  $breathe
     * @return \Illuminate\Http\Response
     */
    public function edit(Breathe $breathe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Breathe  $breathe
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Breathe  $breathe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Breathe $breathe)
    {
        //
    }


    public function updateStop()
    {

        $breathe =  Breathe::latest()->first();

        $timer = Time::hour();

        $breathe->update([
            'hour' => $timer->hours,
            'min'  => $timer->minutes,
            'sec'  => $timer->seconds

        ]);

        return response()->json(['success' => 'Ajax request submitted successfully']);
    }

    public function updateStart()
    {
        $breathe =  Breathe::latest()->first();

        $breathe->update([
            'Start_time' => Carbon::now()
        ]);

        return response()->json(['success' => 'Ajax request submitted successfully']);
    }

    public function end()
    {

        $breathe =  Breathe::latest()->first();
        $timer = Time::hour();

        $breathe->update([
            'hour' => $timer->hours,
            'min'  => $timer->minutes,
            'sec'  => $timer->seconds,
            'status' => 1
        ]);
        return redirect('/');
    }
}
