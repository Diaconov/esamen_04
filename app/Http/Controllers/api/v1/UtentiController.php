<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\ModificaDatiRequest;
use App\Http\Requests\v1\UtentiStoreRequest;
use App\Http\Requests\v1\UtentiUpdateRequest;
use App\Http\Requests\v1\UtenzaRequest;
use App\Http\Resources\v1\UtentiCollection;
use App\Http\Resources\v1\UtentiResource;

use App\Models\Utente;
use App\Models\ContattoAuth;
use App\Models\PasswordUtente;
use App\Models\utente_ruoloUtente;

class UtentiController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return JsonResource
     */
    public function index()
    {
        $risorsa = Utente::all();
        $ritorno = new UtentiCollection($risorsa);
        return $ritorno;
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param Illuminated\Http\Request $request
     * @return Illuminated\Http\Response
     */
    public function store(UtentiStoreRequest $request)
    {
        $dati = $request->validated(); //verificare i dati
        $utente = Utente::create($dati); // creo i dati (model = alla classe del model:metodo per crare i dati) e li metto dentro la variabile
        return new UtentiResource($utente); // ritorna una nuova istanza resource con la risorsa creata
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     * @return Illuminated\Http\Response
     */
    public function show(Utente $utente)
    {

        $risorsa = new UtentiResource($utente);
        return $risorsa;
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param Illuminated\Http\Request $request
     * @param int $id
     * @return Illuminated\Http\Response
     */
    public function update(UtentiUpdateRequest $request, Utente $utente)
    {
        //prelevare i dati -> sono nella $request

        //verificare i dati
        $dati = $request->validated();
        //inserirli nell'oggetto al database preparare model
        $utente->fill($dati);
        //salvarlo
        $utente->save();
        //ritornare la risorsa modificata
        return new UtentiResource($utente);
    }


    public function destroy(Utente $utente)
    {
        $utente->deleteOrFail();
        return response()->noContent();
    }



    public function aggiungiCredito($idUtente, $importo)
    {
        $utente = Utente::findOrFail($idUtente);
        $nuovoCredito = $utente->credito + $importo;
        $utente->credito = $nuovoCredito;
        $utente->save();

        return response()->json(['message' => 'credito aggiunto']);
    }

    public function creaUtente(ModificaDatiRequest $request)
    {
        $utenti = new Utente();

        $hashCdf = hash('sha512', 'codiceFiscale');

        $utenti->idUtente = $request->input('idUtente');
        $utenti->nome = $request->input('nome');
        $utenti->cognome = $request->input('cognome');
        $utenti->sesso = $request->input('sesso');
        $utenti->dataNascita = $request->input('dataNascita');
        $utenti->cittadinanza = $request->input("cittadinanza");
        $utenti->credito = $request->input('credito');
        $utenti->idStato = $request->input('idStato');
        $utenti->codiceFiscale = $hashCdf;
        //    $utenti->email =$request->input(hash("sha512",trim('email')));
        //    $utenti->cellulare =$request->input(hash("sha512",trim('cellulare')));


        $utenti->save();

        return response()->json(['message' => 'Utente creato!', $utenti]);
    }

    public function creaUtenza(UtenzaRequest $request)
    {
        $utenteAuth = new ContattoAuth();
        $password = new PasswordUtente();
        $utente_ruoloUtente = new utente_ruoloUtente();

        $hashUser = hash('sha512', 'user');
        $hashPsw = hash('sha512', 'password');
        $hashSale = hash('sha512', 'sale');


        $utenteAuth->idUtente = $request->input('idUtente');
        $utenteAuth->user = $hashUser;
        $utenteAuth->sfida = $request->input('sfida');
        $utenteAuth->secretJWT = $hashUser;
        $utenteAuth->inizioSfida = $request->input('inizioSfida');
        $utenteAuth->obbligoCambio = $request->input('obbligoCambio');


        $password->idUtente = $request->input('idUtente');
        $password->psw = $hashPsw;
        $password->sale = $hashSale;


        $utente_ruoloUtente->idUtente = $request->input('idUtente');
        $utente_ruoloUtente->idRuoloUtente = $request->input('idRuoloUtente');




        $utenteAuth->save();
        $password->save();
        $utente_ruoloUtente->save();

        return response()->json(['message' => 'Credenziali create!', $utenteAuth]);
    }
}
