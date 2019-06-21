<?php
namespace Backend;

require_once __DIR__.'./Model/Contenuto.php';
use Backend\Model\Contenuto;

class ContenutoController extends Contenuto{

    public static function index(){
        $contenuto = new Contenuto();
        // $contenuto::findArg($id);
    }
}

?>