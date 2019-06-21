/*
*
*   Home.php
*
*/
function showRaccolte(e){
    console.log(e);
}

function addListVideo(elem){
    let url = 'http://localhost/hw-Fedekk/api/raccolte';
    fetch(url)
    .then(resp => resp.json())
    .then(function(data){
        for(let i=0;i<data.length;i++){
            let dataMarkup = {
                idRaccolta: data[i].id,
                titolo: data[i].titolo,
                image: data[i].imgurl
            }
            let markup = 
            `<div onclick='showRaccolte(this)' class="element-video" data-video-id='${dataMarkup.idRaccolta}'>
                <h2>${dataMarkup.titolo}</h2>
                <img src="${dataMarkup.image}" alt="${dataMarkup.titolo}">
            </div>`;
            elem.innerHTML += markup;
        }
    });
}

document.addEventListener('DOMContentLoaded', function (e){
    const elem = document.querySelector('#video');
    if(elem) addListVideo(elem);
});

function creaRaccolta(elem){
    let userInput = elem.children.r.value;
    let imgDefault = `https://www.beavertontkd.com/wp-content/uploads/2017/04/default-image.jpg`;
    let url = "http://localhost/hw-Fedekk/api/raccolte";
    
}

/*
*
*
*   Search.php
*
*/

function addToRaccolta(elem){
    let fields = {
        idVideo: elem.dataset.videoId,
        titolo: elem.children.titolo.textContent,
        description: elem.children.description.textContent,
        imgurl: elem.children.imgurl.src,
        pubblicazione: elem.children.pubblicazione.textContent
    }
    let form = new FormData();
    form.append("multimedia", JSON.stringify(fields));
}

function loadVideos(elem){
    let element = document.querySelector('#videos');
    element.innerHTML = "";
    let string = `doSearch.php?q=${elem.q.value}`;
    let url = `http://localhost/hw-Fedekk/Backend/cURL/${encodeURI(string)}`;
    fetch(url)
    .then(resp => resp.json())
    .then(function(data){
        for(let i=0;i<data.items.length;i++){
            let dataMarkup = {
                idVideo: data.items[i].id.videoId,
                titolo: data.items[i].snippet.title,
                description: data.items[i].snippet.description,
                publishedAt: data.items[i].snippet.publishedAt,
                imgurl: data.items[i].snippet.thumbnails.medium.url
            }
            let markup = 
            `<div onclick='addToRaccolta(this)' class="element-video" data-video-id='${dataMarkup.idVideo}'>
                <h2 name="titolo">${dataMarkup.titolo}</h2>
                <img name="imgurl" src="${dataMarkup.imgurl}" alt="${dataMarkup.titolo}">
                <p name="description">Descrizione breve: ${dataMarkup.description}</p>
                <p name="pubblicazione">Pubblicazione: ${dataMarkup.publishedAt}</p>
            </div>`;
            element.innerHTML += markup;
        }
    });
}