<?php

namespace App\Providers;


use App\Files;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


      view()->composer('admin.layout', function($view){
        $view->with('user', Auth::user());
      });

      view()->composer('layouts.app', function($view){
        $executors = User::where('is_secretary', 1)->get()
            ->filter(function ($value) {
              return $value->id !== Auth::user()->id;
            });
        $view->with('scheduleFile', Files::where('id', '8')->first());
        $view->with('user', Auth::user());
        $view->with('executors', $executors);
      });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
