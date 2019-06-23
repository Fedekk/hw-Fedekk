function addListContent(elem){
    // Var
    let id = document.querySelector('.collections > input');
    let titolo = id.dataset.titolo;
    let src = id.dataset.thumb;
    
    // Rappresento la raccolta
    let element = document.querySelector('#content');
    element.innerHTML = "";
    let markup = 
    `<div class="element-video" >
        <h2>${titolo}</h2>
        <img width='300px' height='200px' src="${src}" alt="${titolo}">
    </div>`;
    element.innerHTML += markup;

    let url = `http://localhost/hw-Fedekk/api/contenuti`;
    fetch(url)
    .then(resp => resp.json())
    .then(function(data){
        for(let i=0;i<data.length;i++){
            let elemHidden = document.querySelector('#idRaccolta');
            let risorsa = data[i].risorsa;
            risorsa = JSON.parse(risorsa);
            let dataMarkup = {
                id: data[i].id,
                idVideo: risorsa.idVideo,
                titolo: risorsa.titolo,
                description: risorsa.description,
                publishedAt: risorsa.pubblicazione,
                imgurl: risorsa.imgurl,
                idRaccolta: risorsa.idRaccolta
            }
            if(dataMarkup.idRaccolta == elemHidden.value){
                let markup = 
                `<div class="element-video" data-content-id='${dataMarkup.id}' data-video-id='${dataMarkup.idVideo}'>
                    <h2 name="titolo">${dataMarkup.titolo}</h2>
                    <img name="imgurl" style="display:none;" src="${dataMarkup.imgurl}" alt="${dataMarkup.titolo}">
                    <div class="vid">
                    <iframe src="http://www.youtube.com/embed/${dataMarkup.idVideo}" width="300px" height="200px" />
                    </div>
                    <p name="description">Descrizione breve: ${dataMarkup.description}</p>
                    <p name="pubblicazione">Pubblicazione: ${dataMarkup.publishedAt}</p>
                </div>`;
                element.innerHTML += markup;
            }
        }
    });
}

export {
    addListContent
};