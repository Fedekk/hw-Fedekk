
function checkUsername(e){
    let input = e;
    let url = "http://localhost/hw-Fedekk/Backend/Request.php?table=utenti";
    fetch(url)
    .then(resp => resp.json())
    .then(function(data){
        let check = false;
        for(let temp of data){
            if(temp.nickname == input.value){
                check = true;
            }
        }
        let component = document.querySelector('#msg');
        if(check== true) component.textContent = "Username gia' presente";
    });
}

function checkRegistrazione(e){
    let response = document.querySelector('#msg');
    let elem = e.parentNode.children;
    let check = false;
    for(let i=0;i<elem.length-1;i++){
        if(elem[i].value == ""){
        response.textContent = "Compilare tutti i campi"
        check = true;
        }
    }
    if(check==false) { response.textContent = ""; e.submit();}
}

function checkLogin(e){
    let response = document.querySelector('#msg');
    let elem = e.children;
    let check = false;
    for(let i=0;i<elem.length-1;i++){
        if(elem[i].value == ""){
        response.textContent = "Compilare tutti i campi"
        check = true;
        }
    }
    if(check == true){
        return true;
    }
    else
    if(check==false) { response.textContent = ""; return false;}
}