<?php
include 'Frontend/header.php';
if(!isset($_SESSION['login'])){
    header("Location: login.php");
}
?>
<section>
    <form>
        <input type="search" name="q" id="search">
        <input type="button" value="Cerca">
    </form>
    <span id="response"></span>
</section>
<section id="video">

</section>
<?php
include 'Frontend/footer.php';
?>
