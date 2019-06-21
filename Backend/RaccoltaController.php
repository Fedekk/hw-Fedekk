<?php
namespace Backend;


require_once __DIR__.'./Model/Raccolta.php';
use Backend\Model\Raccolta;

class RaccoltaController extends Raccolta{

    public static function index($request){
        $Raccolta = new Raccolta();
        $Raccolta::All();
    }
    public static function store($request){
        $contenuto = new Raccolta();
        $contenuto->titolo = $request['r'];
        $contenuto->imgurl = $request['imgurl'];
        $contenuto->idUtente = $request['idUtente'];
        $contenuto->save();
    }
}

?>