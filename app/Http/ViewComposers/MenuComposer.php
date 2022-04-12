<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Models\Movie;

use Illuminate\Support\Facades\Cache;

class MenuComposer
{
    /**
     * Create a new profile composer.
     *
     * @return  void
     */
    public function __construct()
    {
        //
    }

    /**
     * Bind data to the view.
     *
     * @param    View  $view
     * @return  void
     */
    protected function movie()
    {
        $movie = Movie::with('votes')
                    ->orderBy('day_start', 'DESC')
                    ->take(config('const.menu_movie'));

        return $movie;
    }
    public function compose(View $view)
    {
        if (Cache::has('newHead')) {
            $new = Cache::get('newHead');
        } else {
            $new = $this->movie()->where('status', 1)->get();
            Cache::put('newHead', $new);
        }
        if (Cache::has('soonHead')) {
            $soon = Cache::get('soonHead');
        } else {
            $soon = $this->movie()->where('status', 2)->get();
            Cache::put('soonHead', $soon);
        }
        
        $view->with('new', $new);
        $view->with('soon', $soon);
    }
}
