<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;
use App\Models\Cinema;
use App\Models\Showtime;
use \Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::where('status', 1)->get();
        $cinemas = Cinema::all();

        return view('frontend.booking.booking', compact('movies', 'cinemas'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movies = Movie::with(['showtimes.room' => function($query) use ($id) {
                $query->where('cinema_id', $id);
            }])->get();

        return response()->json($movies);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Carbon::setLocale('vi');
        $now = Carbon::now();
        $twoDay = Carbon::now()->addDays(2)->addUnitNoOverflow('hour', 24, 'day');
        $arr = explode(",", $id); 
        $cinemaId = $arr[0];
        $movieId = $arr[1];
        $showtimes = Showtime::where('movie_id', $movieId)
            ->where('timestart', '>', $now)
            ->where('timestart', '<', $twoDay)
            ->whereHas('room', function ($query) use ($cinemaId) {
                $query->where('cinema_id', $cinemaId);
            })
            ->orderBy('timestart')
            ->get();
        $arr2 = [];
        foreach ($showtimes as $key => $showtime) {
            $date = Carbon::parse($showtime->timestart)->format('l, d/m/Y');
            $time = Carbon::parse($showtime->timestart)->format('H:i');
            $arr2[$date][$showtime->room->roomType->name][$key]['id'] = $showtime->id;
            $arr2[$date][$showtime->room->roomType->name][$key]['time'] = $time;
        }

        return response()->json($arr2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
