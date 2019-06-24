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
        $raccolta = new Raccolta();
        $raccolta->titolo = $request['r'];
        $raccolta->imgurl = $request['imgurl'];
        $raccolta->idUtente = $request['idUtente'];
        $raccolta->save();
    }
    public static function update($request, $id){
        $raccolta = new Raccolta();
        $raccolta->imgurl = $request['imgurl'];
        $raccolta->id = $id;
        $raccolta->up();
    }
    public static function delete($id){
        $raccolta = new Raccolta();
        $raccolta->id = $id;
        $raccolta->remove();
    }
}

?>