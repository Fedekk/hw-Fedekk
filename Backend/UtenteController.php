<?php
namespace Backend;

require './Model/Utente.php';
use Backend\Model\Utente;

class UtenteController extends Utente{

    public static function index(){
        $Utente = new Utente();
        $Utente::All();
    }
}

?>