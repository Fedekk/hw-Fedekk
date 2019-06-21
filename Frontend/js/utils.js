function addListVideo(elem){
    let url = 'http://localhost/hw-Fedekk/Backend/Request.php?table=raccolte';
    const dataMarkup = {
        titolo: '',
        image: ''
    }
    const markup = 
`<div class="element-video">
    <h2>${dataMarkup.titolo}</h2>
    <img src="${dataMarkup.image}" alt="${dataMarkup.titolo}">
</div>`;
    
}

document.addEventListener('DOMContentLoaded', function(e){
    const elem = document.querySelector('#video');
    if(elem)
    addListVideo(elem);
});