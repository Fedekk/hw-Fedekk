<?php
include 'Frontend/header.php';
if(!isset($_SESSION['login'])){
    header("Location: login.php");
}
?>
<section class="collections">
<input type="hidden" id="idRaccolta" name="idRaccolta" data-titolo='<?php echo $_GET['titolo']; ?>' data-thumb="<?php echo $_GET['src']; ?>" value="<?php echo $_GET['raccolta'];?>">
    <span id="response"></span>
</section>
<section id="content">
    
</section>
<script>
document.addEventListener('DOMContentLoaded', function (e){
    const elem = document.querySelector('#content');
    if(elem) addListContent(elem);
});
</script>
<?php
include 'Frontend/footer.php';
?>