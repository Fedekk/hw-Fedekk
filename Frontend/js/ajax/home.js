function showRaccolte(elem){
    let idRaccolta = elem.dataset.videoId;
    let src = elem.dataset.thumb;
    let titolo = elem.dataset.titolo;
    location.href = `http://localhost/hw-Fedekk/collection.php?raccolta=${idRaccolta}&src=${src}&titolo=${titolo}`;
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
            `<div onclick='showRaccolte(this)' data-titolo='${dataMarkup.titolo}' data-thumb='${dataMarkup.image}' class="element-video" data-video-id='${dataMarkup.idRaccolta}'>
                <h2>${dataMarkup.titolo}</h2>
                <img width='300px' height='200px' src="${dataMarkup.image}" alt="${dataMarkup.titolo}">
            </div>`;
            if(elem) elem.innerHTML += markup;
        }
    });
}

function creaRaccolta(event){
    event.preventDefault();
    let imgDefault = `https://www.beavertontkd.com/wp-content/uploads/2017/04/default-image.jpg`;
    let url = "http://localhost/hw-Fedekk/api/raccolte";
    let titolo = event.target.children.r.value;
    var form = new FormData(event.target);
    form.append("imgurl", imgDefault);
    form.append("idUtente", document.querySelector('#idUser').value);
    fetch(url, {
      method: "POST",
      body: form
    })
      .then(function(resp){
          return resp.text();
      })
      .then(function(text){
          console.log(text);
          let elem = document.querySelector('#video');
          elem.innerHTML = "";
          addListVideo(elem);
      });
}

export {
    showRaccolte,
    addListVideo,
    creaRaccolta
};