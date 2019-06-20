<?php
include 'Frontend/header.php';
?>
<section>
    <form action="" method="POST">
        <input type="text" required placeholder="Nome" name="nome">
        <input type="text" required placeholder="Cognome" name="cognome">
        <input type="text" required onblur="checkUsername(this)" placeholder="Nickname" name="nickname">
        <input type="text" required placeholder="Password" name="pwd">
        <input type="text" required placeholder="Conferma Password" name="pwd_confirm">
        <input type="email" required placeholder="E-Mail" name="email">
        <input type="submit" value="Registrati">
    </form>
</section>
<?php
include 'Frontend/footer.php';
?>