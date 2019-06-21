<?php
namespace Backend;
include 'Frontend/header.php';
if(isset($_SESSION['login']) || isset($_COOKIE['login'])){
    header("Location: home.php");
}
require_once 'Backend/UtenteController.php';
use Backend\UtenteController;

if(isset($_POST['send'])){
    $utente = new UtenteController();
    $nickname = $_POST['nickname'];
    $pwd = $_POST['pwd'];
    $result = $utente::login($nickname, $pwd);
    if($result){
        $_SESSION['login'] = $nickname;
        if(isset($_POST['ricordami']))
        setcookie("login", $nickname);
        header("Location: home.php");
        exit;
    }
    else{
        echo "Impossibile accedere";
    }

}
?>
<section>
    <form action="" method="POST">
        <input type="text" required placeholder="Nickname" name="nickname">
        <input type="text" required placeholder="Password" name="pwd">
        <label for="ricordami"><input type="checkbox" name="ricordami" id="ricordami">Ricordami</label>
        <input type="submit" name="send" onsubmit="checkLogin(this)" value="Accedi">
    </form>
</section>
<?php
include 'Frontend/footer.php';
?>