<?php
include 'Frontend/header.php';
?>
<section>
    <form action="" method="POST">
        <input type="text" placeholder="Nome" name="nome">
        <input type="text" placeholder="Cognome" name="cognome">
        <input type="text" placeholder="Nickname" name="nickname">
        <input type="text" placeholder="Password" name="pwd">
        <input type="text" placeholder="Conferma Password" name="pwd_confirm">
        <input type="email" placeholder="E-Mail" name="email" id="">
        <input type="submit" value="Registrati">
    </form>
</section>
<?php
include 'Frontend/footer.php';
?>