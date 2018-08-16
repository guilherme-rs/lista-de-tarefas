<?php

namespace App\Providers;

use App\Tarefa;
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
        view()->composer('tarefas.index', function($view){
            $tarefas = Tarefa::get();
            $view->with('tarefas', $tarefas);
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
