/*
*
*   Home.php
*
*/
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

/*
*
*
*   Search.php
*
*/

function sostituisciImmagine(fields){
    let url = `http://localhost/hw-Fedekk/api/raccolte/${fields.idRaccolta}`;
    fetch(url, {
        method: "PATCH",
        headers:{
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: {
            imgurl: fields.imgurl
        }
      })
        .then(function(resp){
            return resp.json();
        })
        .then(function(text){
            console.log(text);
        })
        .catch(function(error){
            console.log(error);
        });
}
function addRaccoltaAjax(elem, section){
    elem.dataset.click = "stay";
    let element = document.querySelector('#choose');
    let fields = {
        idVideo: elem.dataset.videoId,
        titolo: elem.children.titolo.textContent,
        description: elem.children.description.textContent,
        imgurl: elem.children.imgurl.src,
        pubblicazione: elem.children.pubblicazione.textContent,
        idRaccolta: element.value
    }
    let form = new FormData();
    form.append("risorsa", JSON.stringify(fields));
    let url = `http://localhost/hw-Fedekk/api/contenuti`;
    fetch(url, {
        method: "POST",
        body: form
      })
        .then(function(resp){
            return resp.text();
        })
        .then(function(text){
            let _elem = document.querySelector('#response');
            _elem.textContent = "";
            _elem.textContent = text;
            element.remove();
            section.remove();
            elem.dataset.click= "falso";
            elem.innerHTML += text;
            sostituisciImmagine(fields);
        })
        .catch(function(error){
            console.log(error);
        });
        
}
function riempiSelect(_elem,choose){
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
            let option = document.createElement('option');
            option.text = dataMarkup.titolo;
            option.value = dataMarkup.idRaccolta;
            choose.add(option);
        }
    })
    .then(function(){
        let form = document.querySelector('#formRaccolta');
        form.addEventListener('submit', function(e){
            e.preventDefault();
            addRaccoltaAjax(_elem, document.querySelector('#secFormRaccolta'));
        });
    })
    .catch(error => console.log(error));
}
function addToRaccolta(_elem){
    if(_elem.dataset.click.includes("falso")){
    let markup = `
    <section id="secFormRaccolta">
    <form id="formRaccolta" method="GET" >
        <select id="choose" name="choose">
        </select>
        <input type="submit"  value="Aggiungi" name="send" />
    </form>
    </section>
    `;
    _elem.innerHTML += markup;
    let choose = document.querySelector('#choose');
    riempiSelect(_elem,choose);
    

    _elem.dataset.click = "vero";
    }
    else{
        let sec = document.querySelector('#secFormRaccolta');
        sec.remove();
        _elem.dataset.click = "falso";
    }
}

function loadVideos(elem){
    let element = document.querySelector('#videos');
    element.innerHTML = "";
    let string = `doSearch.php?q=${elem.q.value}`;
    let url = `http://localhost/hw-Fedekk/Backend/cURL/${encodeURI(string)}`;
    fetch(url)
    .then(resp => resp.json())
    .then(function(data){
        if(data.error != null) alert('limite ricerche raggiunto :-(');
        else{
        for(let i=0;i<data.items.length;i++){
            let dataMarkup = {
                idVideo: data.items[i].id.videoId,
                titolo: data.items[i].snippet.title,
                description: data.items[i].snippet.description,
                publishedAt: data.items[i].snippet.publishedAt,
                imgurl: data.items[i].snippet.thumbnails.medium.url
            }
            let markup = 
            `<div  data-click='falso' class="element-video" data-video-id='${dataMarkup.idVideo}'>
                <h2 name="titolo">${dataMarkup.titolo}</h2>
                <img onclick='addToRaccolta(this.parentNode)' name="imgurl" src="${dataMarkup.imgurl}" alt="${dataMarkup.titolo}">
                <p name="description">Descrizione breve: ${dataMarkup.description}</p>
                <p name="pubblicazione">Pubblicazione: ${dataMarkup.publishedAt}</p>
            </div>`;
            element.innerHTML += markup;
        }
    }
    });
}

/*
*
*
*Collection.php
*
*/

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
                idVideo: risorsa.idVideo,
                titolo: risorsa.titolo,
                description: risorsa.description,
                publishedAt: risorsa.pubblicazione,
                imgurl: risorsa.imgurl,
                idRaccolta: risorsa.idRaccolta
            }
            if(dataMarkup.idRaccolta == elemHidden.value){
                let markup = 
                `<div class="element-video" data-video-id='${dataMarkup.idVideo}'>
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
