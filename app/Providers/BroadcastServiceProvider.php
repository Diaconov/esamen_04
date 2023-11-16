<?php

namespace App\Providers;

use App\Models\Amministratore;
use App\Models\Utenti;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    protected $policies = [];
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Broadcast::routes();

        require base_path('routes/channels.php');

        //$this->register();

        // Gate::define("leggere", function (Utenti $utenti) {
        //   return $utenti->idUtente === 1;
        //});
    }
}
