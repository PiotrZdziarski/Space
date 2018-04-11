<?php session_start();
if(isset($_SESSION['zalogowany'])) {
    header('Location: index.php');
} ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Logowanie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/main.css" />
    <script src="main.js"></script>
</head>
<body style="font-size: 30px;">
    <div id="loggingv2" style="border: 1px dashed white; padding: 25px; width: 300px;transform: translate(-50%, -50%);left: 50%; top: 50%;position:absolute; background-color: #333333;">
        <form method="post" action="login.php">
            Hasło: 
            <input type="text" name="user" style="font-size: 18px;">
            <br>
            Login: 
            <input type="password" name="haslo" style="font-size: 18px;">
            <br>
            <?php if(isset($_SESSION['komunikat'])) 
            echo '<span style="font-size: 16px; color: red">'.$_SESSION['komunikat'].'</span><br>'; 
            unset($_SESSION['komunikat']); ?>
            <input type="submit" value ="Zaloguj" id="b_logowanie" style="font-size: 20px;padding: 4px;margin-top: 10px;">
        </form>
        <a href="rejestracja.php" style="text-decoration: underline;font-size: 18px;margin:0;padding:0;">Rejestracja</a>
        <a href="index.php" style="text-decoration: underline;font-size: 18px;">Powrót do strony głównej</a>
    </div>
</body>
</html>