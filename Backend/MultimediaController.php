<?php
namespace Backend;


require_once __DIR__.'./Model/Multimedia.php';
use Backend\Model\Multimedia as Multimedia;

class MultimediaController extends Multimedia{

    public static function index(){
        $Multimedia = new Multimedia();
        $Multimedia::randomRow();
    }
}
