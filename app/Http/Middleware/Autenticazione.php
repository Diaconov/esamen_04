<?php

namespace App\Http\Middleware;

use App\Http\Controllers\api\v1\AccediController;
use App\Models\Amministratore;
use App\Models\Utente;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Autenticazione
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next) //, $regola): Response //next è il parametro per far uscire i dati
    {
        //codice di controllo per l'autenticazione
        //$token = $_SERVER['PHP_AUTH_PW'];

        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $token = $_SERVER['HTTP_AUTHORIZATION'];
            $token = trim(str_replace("Bearer", "", $token));
            // Il codice sopra necessita di modifiche al server Apache
            // $token = $_SERVER['PHP_AUTH_PW'];

            $payload = AccediController::verificaToken($token);

            if ($payload != null) {
                $utente = Utente::where("idUtente", $payload->data->idUtente)->firstOrFail();
                if ($utente->idStato == 1) {
                    Auth::login($utente);

                    $request["ruoliUtente"] = $utente->ruoli->pluck('ruolo')->toArray();
                    // print_r($request ['ruoliUtente']);
                    //echo 'siamo qua';
                    return $next($request);
                } else {
                    abort(403);
                }
            } else {
                abort(403);
            }
        } else {
            abort(403);
        }
    }
}
