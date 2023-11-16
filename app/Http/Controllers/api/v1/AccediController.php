<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\AccessoUtente;
use App\Models\Configurazione;
use App\Models\ContattoAuth;
use App\Models\PasswordUtente;
use App\Models\SessioneUtente;
use Illuminate\Http\Request;

class AccediController extends Controller
{
    //----- PUBLIC -------
    /**
     * cerco l'hash dello user nel db
     * 
     * @param string $utente
     * @param string $hash
     * 
     * @return AppHelpers\ritornoCustom
     */
    public function searchMail($utente)
    {
        $tmp = (ContattoAuth::esisteUtente($utente)) ? true : false;
        return AppHelpers::rispostaCustom($tmp);
    }

    //----------------------------------------------------------------------------------------------------------------   

    /**
     * Display the specified resource.
     */
    public function show($utente, $hash = null)
    {
        if ($hash == null) {
            return AccediController::controlloUtente($utente);
        } else {
            return AccediController::controlloPassword($utente, $hash);
        }
    }

    //----------------------------------------------------------------------------------------------------------------

    /**  Crea il token per sviluppo
     *
     * @return AppHelpers\rispostaCustom
     */

    public static function testToken()
    {
        $utente = hash("sha512", trim("Admin@Utente"));
        $password = hash("sha512", trim("Password123!"));
        $sale = hash("sha512", trim("Sale"));
        $sfida = hash("sha512", trim("Sfida"));
        $secretJWT = hash("sha512", trim("Secret"));
        $auth = ContattoAuth::where('user', $utente)->firstOrFail();
        if ($auth != null) {
            $auth->inizioSfida = time();
            //$auth->sfida = $sfida;
            $auth->secretJWT = $secretJWT;
            $auth->save();
            $recordPassword = PasswordUtente::passwordAttuale($auth->idUtente);
            if ($recordPassword != null) {
                $recordPassword->sale = $sale;
                $recordPassword->psw = $password;
                $recordPassword->save();
                //$cipher = AppHelpers: : creaPasswordCifrata($password, $sale, $sfida);
                $cipher = AppHelpers::nascondiPassword($password, $sale);
                $tk = AppHelpers::creaTokenSessione($auth->idUtente, $secretJWT);
                $dati = array("token" => $tk, "xLogin" => $cipher);
                $sessione = SessioneUtente::where("idUtente", $auth->idUtente)->firstOrfail();
                $sessione->token = $tk;
                $sessione->inizioSessione = time();
                $sessione->save();
                return AppHelpers::rispostaCustom($dati);
            }
        }
    }

    //----------------------------------------------------------------------------------------------------------------

    /**   Crea il token per sviluppo
     * @param string $utente
     * @return AppHelper\rispostaCustom
     */
    public static function testLogin($hashUtente, $hashPassword)
    {

        //$hashPassword = "025d4ef7bf0f6d67a558d98dfdafb5a630c86dc47bdbfeafd88574238ce14282221748cf7ef5b76ca799be6ee9b7cb2f67d40ccc107b7b0e3401d821814b288d"; //lo crea artisan tinker e lo metto nel db
        //$hashUtente = "e6c83b282aeb2e022844595721cc00bbda47cb24537c1779f9bb84f04039e1676e6ba8573e588da1052510e3aa0a32a9e55879ae22b0c2d62136fc0a3e85f8bb"; //lo crea artisan tinker
        //$hashSale = "95152e9691fc83283b811c9ce903cb603685ed5ea3c67a876a3985a2879446a75d2858f0bbbd78381a65faba31ad4bd8610ba704c09ed1b1190459862329900a"; //lo prendo dal db elo copio qui
        //$passwordNascosta = AppHelpers::nascondiPassword($hashPassword, $hashSale);
        return AccediController::controlloPassword($hashUtente, $hashPassword);
        //print_r(AccediController::controlloPassword($hashUtente, $hashPassword));
    }

    //----------------------------------------------------------------------------------------------------------------

    /**Verifica il token ad ogni chiamata
     * @param string $token
     * @return object
     */
    public static function verificaToken($token)
    {
        $rit = null;
        $sessione = SessioneUtente::datiSessione($token);
        if ($sessione != null) {
            $inizioSessione = $sessione->inizioSessione;
            $durataSessione = Configurazione::leggiValore("durataSessione");
            $scadenzaSessione = $inizioSessione + $durataSessione;
            // echo ("PUNTO 1<br>");
            if (time() < $scadenzaSessione) {
                // echo ("PUNTO 2<br>");
                $auth = ContattoAuth::where('idUtente', $sessione->idUtente)->first();
                if ($auth != null) {
                    // echo ("PUNTO 3<br>");
                    $secretJWT = $auth->secretJWT;
                    //  echo($secretJWT);
                    $payload = AppHelpers::validaToken($token, $secretJWT, $sessione); //qua è l'errore
                    if ($payload != null) {
                        //  echo ("PUNTO 4<br>") ;
                        $rit = $payload;
                        //print_r($payload) ;
                    } else {
                        abort(403, 'TK_0006');
                    }
                } else {
                    abort(493, 'TK_0005');
                }
            } else {
                abort(403, 'TK_0004');
            }
        } else {
            abort(403, 'TK_0003');
        }
        return $rit;
    }



    //----PROTECTED--------------------------------



    /**   Controllo validità utente
     * @param string $utente
     * @return AppHelpers\rispostacustom
     */
    protected static function controlloUtente($utente)
    {
        // $sfida - hash("sha512", trim(Str::random (200)));
        //$sale = hash("sha512", trim(Str::random(200)));
        $sale = hash("sha512", trim("Ciao!"));
        if (ContattoAuth::esisteUtenteValidoPerLogin($utente)) {
            //esiste
            $auth = ContattoAuth::where('user', $utente)->first();

            // $auth-›sfida = $sfida;
            $auth->secretJWT = hash("sha512", trim(Str::random(200)));
            $auth->inizioSfida = time();
            $auth->save();

            $recordPassword = PasswordUtente::passwordAttuale($auth->idUtente);
            $recordPassword->sale = $sale;
            $recordPassword->save();
        } else {
            //non esiste, quindi invento sfida e sale per confondere le idee
        }
        // $dati = array ("sfida" => $sfida, "sale" => $sale); 
        $dati = array("sale" => $sale);
        return AppHelpers::rispostaCustom($dati);
    }

    //-------------------------------------------------------------------------------------------------------

    /**
     *    Punto di ingresso del login
     * 
     * @param string $utente
     * @param string $hash
     * @return apphelpers\rispostacustom
     */

    protected static function controlloPassword($utente, $hashUtente)
    {
        if (ContattoAuth::esisteUtenteValidoPerLogin($utente)) {
            //esiste
            $auth = ContattoAuth::where('user', $utente)->first();


            //$sfida = $auth-›sfida;
            $secretJWT = $auth->secretJWT;
            $inizioSfida = $auth->inizioSfida;
            echo ("Inizio: " . $auth->inizioSfida . "<br>");
            $durataSfida = Configurazione::leggiValore("durataSfida");
            $maxTentativi = Configurazione::leggiValore("maxLoginErrati");
            $scadenzaSfida = $inizioSfida + $durataSfida;
            echo ("DURATA: " . $durataSfida . " - Inizio: " . $auth->inizioSfida . "<br>");
            if (time() < $scadenzaSfida) {

                $tentativi = AccessoUtente::contaTentativi($auth->idUtente);
                if ($tentativi < $maxTentativi - 1) {

                    // proseguo
                    $recordPassword = PasswordUtente::passwordAttuale($auth->idUtente);

                    $password = $recordPassword->psw;
                    $sale = $recordPassword->sale;
                    //$hashFinaleDB = AppHelper::creaPasswordCifrata($password, $sale, $sfida);
                    $passwordNascosta = AppHelpers::nascondiPassword($password, $sale);
                    //passwordClient = AppHelper::decifra($hashClient, $secretJWT);
                    if ($hashUtente == $passwordNascosta) {

                        //login corretto quindi creo token
                        $tk = AppHelpers::creaTokenSessione($auth->idUtente, $secretJWT);
                        AccessoUtente::eliminaTentativi($auth->idUtente);
                        $accesso = AccessoUtente::aggiungiAccesso($auth->idUtente);

                        SessioneUtente::eliminaSessione($auth->idUtente);
                        SessioneUtente::aggiornaSessione($auth->idUtente, $tk);

                        $dati = array("tk" => $tk);

                        return AppHelpers::rispostaCustom($dati);
                    } else {
                        AccessoUtente::aggiungiTentativoFallito($auth->idUtente);
                        abort(403, "Login fallito");
                    }
                } else {
                    abort(403, "Tentativi esauriti");
                }
            } else {
                AccessoUtente::aggiungiTentativoFallito($auth->idUtente);
                abort(403, "Tempo esaurito");
            }
        } else {
            abort(403, "utente non esiste");
        }
    }
}
