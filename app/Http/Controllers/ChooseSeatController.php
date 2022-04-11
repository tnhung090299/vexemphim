<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;
use App\Models\Seat_col;
use App\Models\Seat_row;
use App\Models\Showtime;

use Pusher\Pusher;
use Session;
use Auth;
use LRedis;

class ChooseSeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function takeSeat($id)
    {
        $seatFilter = function ($query) use ($id) {
            $query->where('id', $id);
        };

        return Seat_Row::with(['seatCols', 'room.showtimes' => $seatFilter])
        ->whereHas('room.showtimes', $seatFilter)
        ->withCount('seatCols')
        ->get();
    }
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
        $id = $request->showtime_id;

        $seatSelected = [];
        $allShowtime = $this->scanAllForMatch('showtimeByUser*');
        foreach ($allShowtime as $key) {
            $a = json_decode(LRedis::get($key));
            if ($a[0] == $id && $a[1] != Auth::id()) {
                foreach ($a[2] as $value) {
                    array_push($seatSelected, $value);
                }
            }
        }
        $seatSelected = json_encode($seatSelected);
        $seatRow = $this->takeSeat($id);
        $max = $seatRow[0]->seat_cols_count;
        // $seatCount = $this->takeSeat($id);
        // $max = 0;
        // foreach ($seatCount as $seat)
        // {
        //     if ($seat->seatCols->count() > $max) {
        //         $max = $seat->seatCols->count();
        //     }
        // }
        $seatCol = $this->getSeatPrice($id);
        // dd($seatCol[0]);
        session(['checkPayment' => true]);

        return view('frontend.booking.choose-seat', compact('id', 'seatRow', 'seatCol', 'max', 'seatSelected'));
    }
    //search redis by key
    public function scanAllForMatch ($pattern, $cursor=null, $allResults=array()) {

        // Zero means full iteration
        if ($cursor==="0") {
            return $allResults;
        }

        // No $cursor means init
        if ($cursor===null) {
            $cursor = "0";
        }

        // The call
        $result = LRedis::scan($cursor, 'match', $pattern);

        // Append results to array
        $allResults = array_merge($allResults, $result[1]);

        // Recursive call until cursor is 0
        return $allResults;
    }
    private function getSeatPrice($id)
    {
        $showtime = Showtime::findOrFail($id);
        $roomTypeId = $showtime->room->roomType->id;
        $showtime_id = $showtime->id;
        $roomId = $showtime->room->id;
        //Filter
        $seatFilter = function ($query) use ($roomTypeId) {
            $query->where('room_type_id', $roomTypeId);
        };
        $stFilter = function ($query) use ($showtime_id) {
            $query->where('id', $showtime_id);
        };
        $seat = Seat_Row::with(['room.showtimes' => $stFilter])
            ->whereHas('room.showtimes', $stFilter)
            ->with(['seatType.seatPrices' => $seatFilter])
            ->whereHas('seatType.seatPrices', $seatFilter)
            ->with(['seatCols' => function ($query) use ($id) {
                $query->withCount(['tickets' => function ($query) use ($id) {
                    $query->where('showtime_id', $id);
                }]);
            }])
            ->get();

        return $seat;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function postSend(Request $request)
    {
        $options = [
            'cluster' => 'ap1',
            'useTLS' => true,
        ];
        $pusher = new Pusher(
            'ce71fbaacd844a8dda04',
            'e9cc9421710fce179d9c',
            '792535',
            $options
        );
        LRedis::set('showtimeByUser' . Auth::id(), json_encode([$request->showtime, Auth::id(), $request->seats]), 'EX', 600);
        $data['seats'] = $request->seats;
        $data['showtime'] = $request->showtime;
        $data['user'] = Auth::id();
        $pusher->trigger('queue', 'mess', $data);
    }
}
