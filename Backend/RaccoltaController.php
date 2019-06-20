<?php
namespace Backend;

require './Model/Raccolta.php';
use Backend\Model\Raccolta;

class RaccoltaController extends Raccolta{

    public static function index(){
        $Raccolta = new Raccolta();
        $Raccolta::All();
    }
}

?>