<?php
namespace Backend;
include 'Frontend/header.php';
if(isset($_SESSION['login']) || isset($_COOKIE['login'])){
    header("Location: home.php");
}
require_once 'Backend/UtenteController.php';
use Backend\UtenteController;
function controllaDati() {
if(isset($_POST['send'])){
    $utente = new UtenteController();
    $nickname = $_POST['nickname'];
    $pwd = $_POST['pwd'];
    $result = $utente::login($nickname, $pwd);
    if($result){
        $id = $utente::login($nickname, $pwd);
        $login = array(
            'username' => $nickname,
            'id' => $id
        );
        $_SESSION['login'] = $login;
        if(isset($_POST['ricordami']))
        setcookie("login", $nickname);
        header("Location: home.php");
        exit;
    }
    else{
        echo "Impossibile accedere";
    }

}
}
?>
<section class="container-center">
    <form action="" id="send" method="POST">
        <input type="text" placeholder="Nickname" name="nickname">
        <input type="password"  placeholder="Password" name="pwd">
        <label for="ricordami"><input type="checkbox" name="ricordami" id="ricordami">Ricordami</label>
        <input type="submit"  name="send" value="Accedi">
        <button><a href="signup.php">Registrati</a></button>
    </form>
    <span id="msg">
        <?php
        controllaDati();
        ?>
    </span>
</section>
<script type="text/javascript">
const elem = document.querySelector('#send');
elem.addEventListener('submit', function(e){
    if(!checkLogin(elem)) e.submit();
    else e.preventDefault();
});
</script>
<?php
include 'Frontend/footer.php';
?>