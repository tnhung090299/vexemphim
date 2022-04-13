<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Movie;

use App\Http\Requests\MovieRequest;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Cache;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Movie::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" class="edit btn btn-primary btn-sm editMovie"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" class="btn btn-danger btn-sm deleteMovie"><i class="fas fa-trash-alt"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.cinema.movie');
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
    public function store(MovieRequest $request)
    {
        $query = [
            'name' => $request->name,
            'time' => $request->duration,
            'country' => $request->country,
            'directors' => $request->director,
            'type' => $request->type,
            'producer' => $request->producer,
            'cast' => $request->actor,
            'day_start' => $request->day_start,
            'content' => $request->content,
            'status' => $request->status,
            'trailer' => $request->trailer,
        ];
        if ($request->hasFile('image'))
        {
            $file_name = $request->image->getClientOriginalName();
            $request->image->move('upload/cover_movie/',$file_name);
            $query = array_merge($query, ['image' => $file_name]);
        }
        Movie::updateOrCreate(
        [
            'id' => $request->movie_id,
        ], $query);
        Cache::forget('newHead');
        Cache::forget('soonHead');
        Cache::forget('movie' . $request->movie_id);

        return response()->json(['success' => __('label.movieSave')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::findOrFail($id);

        return response()->compact($movie);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cinema = Movie::findOrFail($id);

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
        Movie::findOrFail($id)->delete();

        return response()->json(['success' => __('label.movieDel')]);
    }
}
