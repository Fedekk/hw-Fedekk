<?php
namespace Backend;

spl_autoload_register(function ($class) {
    require '../'.$class . '.php';
});
$table = "";
// $table = $_GET['table'];
if(isset($_GET['table']) && isset($_GET['id'])){
    $table = $_GET['table'];
if($table){
    $id = $_GET['id'];
    switch($table){
        case "contenuto": ContenutoController::index($id); break;
        case "domanda": DomandaController::index($id); break;
        case "risultato": RisultatoController::index(); break;
    }
}

}

elseif(isset($_GET['table'])){
    if($_GET['table'] == "argomento")
    ArgomentoController::index();
    elseif($_GET['table'] == "risultato")
    RisultatoController::index();
}
else{
    $resp = array(
        'status' => 'formato non corretto'
    );
    echo json_encode($resp);
}
?>