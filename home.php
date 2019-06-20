<?php
include 'Frontend/header.php';
if(!isset($_SESSION['login'])){
    header("Location: login.php");
}
?>
<section class="collections">
    <form>
        <input type="search" name="r" id="create">
        <input type="button" value="Crea">
    </form>
    <span id="response"></span>

</section>
<section id="video">
    
</section>
<?php
include 'Frontend/footer.php';
?>