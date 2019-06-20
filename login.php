<?php
include 'Frontend/header.php';
?>
<section>
    <form action="#" method="POST">
        <input type="text" placeholder="Nickname" name="nickname">
        <input type="text" placeholder="Password" name="pwd">
        <label for="ricordami"><input type="checkbox" name="ricordami" id="ricordami">Ricordami</label>
        <input type="submit" value="Accedi">
    </form>
</section>
<?php
include 'Frontend/footer.php';
?>