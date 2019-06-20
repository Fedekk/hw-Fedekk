<?php
namespace Backend;

require './Model/Risultato.php';
use Backend\Model\Risultato;

class RisultatoController extends Risultato{

    public static function index(){
        $Risultato = new Risultato();
        $Risultato::All();
    }
}

?>