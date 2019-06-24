/*
*
*   Home.php
*
*/
var host = "http://localhost/hw-Fedekk";

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
    let _headers = new Headers();
    let _form = new FormData();
    _form.append('imgurl', fields.imgurl);
    _headers.append('Content-Type', 'application/x-www-form-urlencoded');
    fetch(url, {
        method: "PATCH",
        headers: _headers,
        body: `imgurl=${fields.imgurl}`
      })
        .then(function(resp){
            return resp.text();
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
    let element = document.querySelector('#video');
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

function rimuoviVideo(elem, id, table){
    console.log(id);
    let url = `${host}/api/${table}/${id}`;
    fetch(url, {
        method: "DELETE"
      })
        .then(function(resp){
            return resp.text();
        })
        .then(function(resp){
            console.log(resp);
            elem.remove();
            // location.href = "home.php";
        })
        .catch(function(error){
            console.log(error);
        });
}

function gestisciBottone(e, contenuti) {
    buttonRaccolta = `
    <input type="button" name='delRaccolta' class="delete-raccolta" value="Cancella raccolta"/>
    `;
    check = document.querySelector('.element-raccolta').children.delRaccolta;
    if(document.querySelector('.element-raccolta').children.delRaccolta){
        document.querySelector('.element-raccolta').children.delRaccolta.remove();
    }
    else{
        let tmp = document.querySelector('.element-raccolta');
        tmp.innerHTML+= buttonRaccolta;
        let raccolta = document.querySelector('#sparisci');
        raccolta.addEventListener('click', gestisciBottone);
        elem = document.querySelector('.delete-raccolta');
        elem.addEventListener('click', function(e){
            let elementi = document.querySelectorAll('.element-video');
            for(let i=0;i<contenuti.length;i++)
            rimuoviVideo(elementi[i], contenuti[i], "contenuti");
            rimuoviVideo(tmp, tmp.dataset.tableId, "raccolte");
        });
        
    }
}
function addListContent(elem){
    // Var
    let id = document.querySelector('.collections > input');
    let titolo = id.dataset.titolo;
    let src = id.dataset.thumb;
    let idRaccolta = id.value;

    // Rappresento la raccolta
    let element = document.querySelector('#content');
    let buttonRaccolta = `
    <input type="button" name='delRaccolta' class="delete-raccolta" value="Cancella raccolta"/>
    `;
    element.innerHTML = "";
    let markup = 
    `<div class="element-raccolta" data-table-id='${idRaccolta}' >
        <h2>${titolo}</h2>
        <img width='300px' id="sparisci" height='200px' src="${src}" alt="${titolo}">
    </div>`;
    element.innerHTML += markup;

    let url = `http://localhost/hw-Fedekk/api/contenuti`;
    fetch(url)
    .then(resp => resp.json())
    .then(function(data){
        let contentsId = [];
        for(let i=0;i<data.length;i++){
            let elemHidden = document.querySelector('#idRaccolta');
            let id = data[i].id;
            let risorsa = data[i].risorsa;
            risorsa = JSON.parse(risorsa);
            contentsId.push(data[i].id);
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
                `<div class="element-video" data-table-id='${id}' data-video-id='${dataMarkup.idVideo}'>
                    <h2 name="titolo">${dataMarkup.titolo}</h2>
                    <img name="imgurl" style="display:none;" src="${dataMarkup.imgurl}" alt="${dataMarkup.titolo}">
                    <div class="vid">
                    <p name="description">Descrizione breve: ${dataMarkup.description}</p>
                    <p name="pubblicazione">Pubblicazione: ${dataMarkup.publishedAt}</p>
                    <input type="button" name='delete' class="delete-video" value="Cancella video"/>
                    <iframe src="http://www.youtube.com/embed/${dataMarkup.idVideo}" width="300px" height="200px" />
                    </div>
                </div>`;
                element.innerHTML += markup;
            }
        }
        elem = document.querySelector('#sparisci');

        elem.addEventListener('click', function(e){
            gestisciBottone(e,contentsId);
        });
        elem = document.querySelectorAll('.delete-video');
        for(temp of elem){
            temp.addEventListener('click', function (e) {
                rimuoviVideo(e.target.parentNode.parentNode, e.target.parentNode.parentNode.dataset.tableId, "contenuti");
            });
        }
    });
}
