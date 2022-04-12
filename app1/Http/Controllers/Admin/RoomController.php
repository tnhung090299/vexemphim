<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Room;
use App\Models\Room_type;
use App\Models\Cinema;
use App\Models\Showtime;
use App\Models\Movie;

use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RoomRequest;
use Carbon\Carbon;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Room::with('cinema')->with('roomType')->latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" class="edit btn btn-primary btn-sm editRoom"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" class="btn btn-danger btn-sm deleteRoom"><i class="fas fa-trash-alt"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $cinemas = Cinema::all();
        $room_type = Room_type::all();

        return view('admin.cinema.room', compact('cinemas', 'room_type'));
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
    public function store(RoomRequest $request)
    {
        Room::updateOrCreate(
        [
            'id' => $request->room_id,
        ],
        [
            'name' => $request->name,
            'cinema_id' => $request->cinema_id,
            'room_type_id' => $request->room_type_id,
            'note' => $request->note,
        ]);
    
        return response()->json(['success' => __('label.roomSave')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ex = explode('-', $id);
        $time = Movie::findOrFail($ex[0])->time;
        $now = Carbon::now();
        $twoDay = Carbon::now()->addDays(3)->addUnitNoOverflow('hour', 24, 'day');
        $st = Showtime::where('room_id', $ex[1])
            ->where('timestart', '>', $now)
            ->where('timestart', '<', $twoDay)
            ->orderBy('timestart')
            ->get();
        $arr = [];
        $result = [];
        $result['time'] = $time;
        $a = Carbon::now();
        $b = 1000;
        foreach ($st as $key => $value) {
            $l = Carbon::parse($value->timestart);
            $m = Carbon::parse($a)->addMinutes($b);
            $n = Carbon::parse($a)->addMinutes($b)->addMinutes($time);
            $a = $value->timestart;
            $b = $value->movie->time;
            if ($l > $n) 
                $result[$key] = $m . ' => ' . $l;
        }

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cinema = Room::findOrFail($id);

        return response()->json($cinema);
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
        Room::findOrFail($id)->delete();
        
        return response()->json(['success' => __('label.roomDel')]);
    }
}
