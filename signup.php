<?php
namespace Backend;
include 'Frontend/header.php';
if(isset($_SESSION['login']) || isset($_COOKIE['login'])){
    header("Location: home.php");
}
require_once 'Backend/Database/Connection.php';

use Backend\Database\Connection;

if(isset($_POST['send'])){
    $link = new Connection();
    $link->connect();
    $nome = mysqli_real_escape_string($link->conn,$_POST['nome']);
    $cognome = mysqli_real_escape_string($link->conn,$_POST['cognome']);
    $nickname = mysqli_real_escape_string($link->conn,$_POST['nickname']);
    $pwd = mysqli_real_escape_string($link->conn,$_POST['pwd']);
    $pwd_confirm = mysqli_real_escape_string($link->conn,$_POST['pwd_confirm']);
    $email = mysqli_real_escape_string($link->conn,$_POST['email']);

    if($nome == "" && $cognome == "" && $nickname == "" && $pwd == "" && $pwd_confirm == "" && $email == ""){
        echo "Compilare tutti i campi";
    }
    elseif($pwd != $pwd_confirm){
        echo "Le password non coincidono...";
    }
    else{
        $query = "INSERT INTO utenti (`nome`,`cognome`,`nickname`,`pwd`,`email`) VALUES ('$nome', '$cognome', '$nickname', '$pwd', '$email')";
        $result = mysqli_query($link->conn, $query) or die(mysqli_error($link->conn));
        if($result){
            $_SESSION['login']['username'] = $nickname;
            mysqli_free_result($result); 
            
            if(isset($_POST['ricordami'])) setcookie("login", $nickname);
            header("Location: home.php");
        }
        else{
            echo "Errore..".mysqli_error();
        }
    }
    $link->close();
}
?>
<section>
    <form action="" method="POST">
        <input type="text" required placeholder="Nome" name="nome">
        <input type="text" required placeholder="Cognome" name="cognome">
        <input type="text" required onblur="checkUsername(this)" placeholder="Nickname" name="nickname">
        <input type="password" required placeholder="Password" name="pwd">
        <input type="password" required placeholder="Conferma Password" name="pwd_confirm">
        <input type="email" required placeholder="E-Mail" name="email">
        <input type="submit" name="send" onsubmit="checkRegistrazione(this)" value="Registrati">
    </form>
    <span id="msg"></span>
</section>
<?php
include 'Frontend/footer.php';
?>