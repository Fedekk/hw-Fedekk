<?php
namespace Backend;
spl_autoload_register(function ($class) {
    require '../'.$class . '.php';
});

$request = $_SERVER['REQUEST_URI'];
$parts = explode('/', $request);
$resource = $parts[3];
if(isset($parts[4]))
$id = $parts[4];
// Se l'utente inserisce un url del tipo /api/risorsa/id/altro non lo permetto!;
if(!isset($parts[5]) && !isset($id)){

    switch($_SERVER['REQUEST_METHOD']){
        case "GET": 
        switch($resource){
            case "contenuti": ContenutoController::index($_GET); break;
            case "multimedia": MultimediaController::index($_GET); break;
            case "utenti": UtenteController::index($_GET); break;
            case "raccolte": RaccoltaController::index($_GET); break;
        }
        break;
        case "POST": 
        switch($resource){
            case "contenuti": ContenutoController::store($_POST); break;
            case "multimedia": MultimediaController::store($_POST); break;
            case "utenti": UtenteController::store($_POST); break;
            case "raccolte": 
            RaccoltaController::store($_POST); 
            break;
        }
        break;
        case "PATCH": 
        switch($resource){
            case "raccolte": 
            RaccoltaController::update($_POST, $id); 
            break;
        }
        break;
        case "PUT": break;
    }

}
elseif(!isset($parts[5]) && isset($id)){
    switch($_SERVER['REQUEST_METHOD']){
        // case "GET": 
        // switch($resource){
        //     case "contenuti": ContenutoController::index($_GET); break;
        //     case "multimedia": MultimediaController::index($_GET); break;
        //     case "utenti": UtenteController::index($_GET); break;
        //     case "raccolte": RaccoltaController::index($_GET); break;
        // }
        // break;
        // case "POST": 
        // switch($resource){
        //     case "contenuti": ContenutoController::store($_POST); break;
        //     case "multimedia": MultimediaController::store($_POST); break;
        //     case "utenti": UtenteController::store($_POST); break;
        //     case "raccolte": 
        //     RaccoltaController::store($_POST); 
        //     break;
        // }
        // break;
        case "PATCH": 
        parse_str(file_get_contents('php://input'), $_PATCH);
        switch($resource){
            case "raccolte": 
            RaccoltaController::update($_PATCH, $id); 
            break;
        }
        break;
        case "PUT": break;
        case "DELETE": 
        switch($resource){
            case "contenuti":
            ContenutoController::delete($id);
            break;
            case "raccolte":
            RaccoltaController::delete($id);
            break;
        }
        break;
    }
}
else{
    $resp = array(
        'status' => 'formato non corretto'
    );
    echo json_encode($resp);
}
?>