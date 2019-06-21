<?php
namespace Backend;

require_once __DIR__.'./Model/Utente.php';
use Backend\Model\Utente;

class UtenteController extends Utente{

    public static function index($request){
        $Utente = new Utente();
        $Utente::All();
    }
    public static function login($username, $password){
        $utente = new Utente();
        $data = $utente::login($username, $password);
        return $data;
    }
}

?>