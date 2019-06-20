<?php
namespace Backend;

define('__ROOT__', dirname(dirname(__FILE__))); 
require_once __ROOT__.'/Backend/Model/Utente.php';

use Backend\Model\Utente;

class UtenteController extends Utente{

    public static function index(){
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