<?php
include 'Frontend/header.php';
if(!isset($_SESSION['login'])){
    header("Location: login.php");
}
?>
<section class="collections">
    <form id="addRaccolta" method="POST">
        <input type="search" name="r" id="create">
        <input type="submit" value="Crea">
    </form>
    <span id="response"></span>

</section>
<section id="video">
    
</section>
<script>
document.addEventListener('DOMContentLoaded', function (e){
    const elem = document.querySelector('#video');
    if(elem) addListVideo(elem);
    let element = document.querySelector('#addRaccolta');
    element.addEventListener('submit', function (e){
        e.preventDefault();
        creaRaccolta(e);
    });
});


</script>
<?php
include 'Frontend/footer.php';
?>