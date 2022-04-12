<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Room;
use App\Models\Cinema;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $id = $request->idFilter;
        $date = $request->dateFilter;
        $movieFilter = function ($query) use ($id, $date) {
            $query->where('movie_id', $id)->where('timestart', 'like', $date . '%')->orderBy('timestart');
        };
        $cinema = Cinema::with(['rooms.showtimes' => $movieFilter])
            ->whereHas('rooms.showtimes', $movieFilter)
            ->get();
        
        return response()->json($cinema);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Cache::has('movie' . $id)) {
            $movie = Cache::get('movie' . $id);
        } else {
            $movie = Movie::findOrFail($id);
            Cache::set('movie' . $id, $movie);
        }

        $v = Vote::where('movie_id', $id)->where('user_id', Auth::id())->first();
        $vote = 0;
        if ($v != null) {
            $vote = $v->point;   
        }
        $movieFilter = function ($query) use ($id) {
            $query->where('movie_id', $id)->orderBy('timestart');
        };
        $cinema = Cinema::with(['rooms.showtimes' => $movieFilter])
            ->whereHas('rooms.showtimes', $movieFilter)
            ->get();

        return view('frontend.movie.movie-detail', compact('movie', 'vote', 'cinema'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    protected function movie(){
        $movie = Movie::all();

        return $movie;
    }
    public function nowShowing()
    {
        $movie = $this->movie()->where('status', 1);

        return view('frontend.movie.now-showing', compact('movie'));
    }
    public function commingSoon()
    {
        $movie = $this->movie()->where('status', 2);

        return view('frontend.movie.comming-soon', compact('movie'));
    }
}
