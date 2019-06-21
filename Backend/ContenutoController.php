<?php
namespace Backend;

require_once __DIR__.'./Model/Contenuto.php';
use Backend\Model\Contenuto;

class ContenutoController extends Contenuto{

    public static function index($request){
        $contenuto = new Contenuto();
        // $contenuto::findArg($id);
    }

    public static function store($request){
        $contenuto = new Contenuto();
        $contenuto->risorsa = $request['risorsa'];
        $contenuto->save();
    }
}

?>