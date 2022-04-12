<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Vote;
use App\Models\User;
use App\Models\Movie;
use App\Models\Ticket;
use App\Charts\MovieChart;
use DB;

class AdminHomeController extends Controller
{
	 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $countUser = User::count();
        $countMovie = Movie::count();
        $countTicket = Ticket::count();
        $totalMoney = Bill::sum('total');
        $movies = Movie::where('status', config('const.showing_movie_status'))
            ->with(['showtimes' => function ($query) {
                $query->withCount('tickets');
            }])
            ->get();
        //Create array color.
        $rgbColor = [];
        $arrColor = [];
        for ($i = 0; $i < count($movies); $i++) {
            // foreach(array('r', 'g', 'b') as $color){
            //     //Generate a random number between 0 and 255.
            //     $rgbColor[$color] = mt_rand(0, 255);
            // }
            $r = rand(1,255);
            $b = rand(1,255);
            $g = rand(1,255);
            $a = 'rgb(' . $r . ', ' . $b . ', ' . $g . ', 0.7)';
            array_push($arrColor, $a);
        }
        //dataset chart rating
        $votes = $movies;
        foreach ($votes as $key => $value) {
            $votes[$key]->avgPoint = $value->votes->avg('point');
        }
        $labels = $votes->pluck('name');
        $values = $votes->pluck('avgPoint');
        $rating = new MovieChart();
        $rating->labels($labels);
        $rating->dataset(__('label.chart_rate'), 'bar', $values)->backgroundcolor($arrColor);
        //dataset chart ticket & vote
        // dd($votes);
        foreach ($votes as $key => $showtimes) {
            $votes[$key]->countVotes = count($showtimes->votes);
            $votes[$key]->countTicket = collect($showtimes->showtimes->sum('tickets_count'))[0];
        }

        $values = $votes->pluck('countVotes');
        $values2 = $votes->pluck('countTicket');
        $tav = new MovieChart();
        $tav->labels($labels);
        $tav->dataset(__('label.chart_vote'), 'bar', $values)->backgroundcolor($arrColor);
        $tav->dataset(__('label.chart_ticket'), 'line', $values2)->color('red');

        return view('admin.homepages.home', compact('countUser', 'countMovie', 'countTicket', 'totalMoney', 'tav', 'rating'));
    }
}
