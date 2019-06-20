
function checkUsername(e){
    let input = e.value;
    let url = "http://localhost/hw-Fedekk/Backend/Request.php?table=utenti";
    fetch(url)
    .then(resp => resp.json())
    .then(function(e){

    });
}