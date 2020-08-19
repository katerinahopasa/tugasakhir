<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
          view()->composer('layouts.app', function($view)
        {
            $notifikasi = DB::table('notifications')
                        ->join('users','users.id','=','notifications.user_id')
                        ->orderBy('notifications.id','desc')
                        ->select('users.name','notifications.*')
                        ->paginate(5);
            // dd($notifikasi);
            $view->with('notifikasi', $notifikasi);
        });
    }
}
