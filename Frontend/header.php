<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homework 1</title>
    <script type="text/javascript" src="Frontend/js/validate.js" defer></script>
    <script type="text/javascript" src="Frontend/js/utils.js" ></script>
</head>
<body>
<main id="page">
<?php if(isset($_COOKIE['login']) || isset($_SESSION['login'])) : ?>

</h1>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="search.php">Ricerca</a></li>
            <li><a href="raccolta.php">Raccolte</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <input type="hidden" id="idUser" value="<?php echo $_SESSION['login']['id']; ?>" />
<?php endif; ?>