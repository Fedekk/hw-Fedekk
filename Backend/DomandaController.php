<?php
namespace Backend;

require './Model/Domanda.php';
use Backend\Model\Domanda;

class DomandaController extends Domanda{

    public static function index($id){
        $Domanda = new Domanda();
        $Domanda::findArg($id);
    }
}

?>