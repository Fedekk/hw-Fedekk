<?php
namespace Backend;


require_once __DIR__.'./Model/Raccolta.php';
use Backend\Model\Raccolta;

class RaccoltaController extends Raccolta{

    public static function index(){
        $Raccolta = new Raccolta();
        $Raccolta::All();
    }
}

?>