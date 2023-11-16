<?php

namespace App\Providers;

//use Illuminate\Support\Facades\Gate;

use App\Models\Amministratore;
use App\Models\potereUtente;
use App\Models\ruoloUtente;
use App\Models\Utente;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    //protected $policies = [
    //
    //];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();


        if (app()->environment() !== 'testing') {
            //gate basato su un ruoli
            ruoloUtente::all()->each(
                function (ruoloUtente $ruolo) {
                    //print_r($ruolo);
                    //echo "RUOLO:" . $ruolo->ruolo;

                    Gate::define($ruolo->ruolo, function (Utente $utente) use ($ruolo) {
                        print_r($utente);
                        return $utente->ruolli->contains('ruolo', $ruolo->ruolo);
                    });
                }
            );

            //gate basato su molteplici ruolli (potere)
            potereUtente::all()->each(function (potereUtente $potere) {
                Gate::define($potere->potere, function (Utente $utente) use ($potere) {

                    $check = false;
                    foreach ($utente->ruolli as $item) {
                        if ($item->potere->contains('potere', $potere->potere)) {
                            $check = true;

                            break;
                        }
                    }
                    return $check;
                });
            });
        }
    }
}
