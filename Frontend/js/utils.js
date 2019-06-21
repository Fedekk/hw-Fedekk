function showRaccolte(e){
    console.log(e);
}

function addListVideo(elem){
    let url = 'http://localhost/hw-Fedekk/Backend/Request.php?table=raccolte';
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
    if(elem)
    addListVideo(elem);
});