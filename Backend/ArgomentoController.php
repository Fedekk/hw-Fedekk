<?php
namespace Backend;

require './Model/Argomento.php';
use Backend\Model\Argomento as Argomento;

class ArgomentoController extends Argomento{

    public static function index(){
        $argomento = new Argomento();
        $argomento::randomRow();
    }
}
