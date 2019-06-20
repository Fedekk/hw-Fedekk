<?php
namespace Backend;

spl_autoload_register(function ($class) {
    require '../'.$class . '.php';
});
$table = "";
// $table = $_GET['table'];
if(isset($_GET['table'])){
    $table = $_GET['table'];
if($table){
    switch($table){
        case "contenuti": ContenutoController::index(); break;
        case "multimedia": MultimediaController::index(); break;
        case "utenti": UtenteController::index(); break;
        case "raccolte": RaccoltaController::index(); break;
    }
}

}

// elseif(isset($_GET['table'])){
//     if($_GET['table'] == "utenti")
//     ArgomentoController::index();
//     elseif($_GET['table'] == "risultato")
//     RisultatoController::index();
// }
else{
    $resp = array(
        'status' => 'formato non corretto'
    );
    echo json_encode($resp);
}
?>