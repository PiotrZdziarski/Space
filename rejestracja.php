<?php 
session_start();
$walidacja = true;
require_once 'connect.php';
try  {
    $polaczenie = new mysqli($host,$userv2,$passv2,$name);
} catch(Exception $e) {
    $_SESSION['komunikat'] = "Serwis niedostępny przepraszamy!";
}
if(isset($polaczenie) && isset($_POST['r_user']) && isset($_POST['r_haslo']) && isset($_POST['r_haslo2']) && isset($_POST['r_email'])) 
{
    $user = $_POST['r_user'];
    $haslo = $_POST['r_haslo'];
    $haslo2 = $_POST['r_haslo2'];
    $email = $_POST['r_email'];

    $user = $polaczenie->real_escape_string($user);
    $haslo = $polaczenie->real_escape_string($haslo);
    $haslo2 = $polaczenie->real_escape_string($haslo2);
    $email = $polaczenie->real_escape_string($email);

    $userLength = strlen($user);
    $passLength = strlen($haslo);
    
    //pobieranie usera
    $query = "SELECT user from uzytkownicy where user='$user'";
    $result = $polaczenie->query($query);
    $row = $result->fetch_row();   
    $db_user = $row[0];
   
    //pobieranie emailu
    $query2 = "SELECT email from uzytkownicy where email='$email'";
    $result2 = $polaczenie->query($query2);
    $row2 = $result2->fetch_row();
    $db_email = $row2[0];

    //walidacja nicku
    if($userLength < 3 || $userLength > 20 || $userLength == 0) {
        $walidacja = false;
        $_SESSION['e_login'] = "Login musi mieć od 3 do 20 znaków!";
    }
    if($user == $db_user && $user != '') {
        $walidacja = false;
        $_SESSION['e_login'] = "Login jest już zarejestrowany!";
    }
    
    //walidacja emailu
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $walidacja = false;
        $_SESSION['e_email'] = "Proszę podać poprawny email!";
    }
    if($email == $db_email && $email != '') {
        $walidacja = false;
        $_SESSION['e_email'] = "Adres email jest już zarejestrowany!";
    }

    //walidacja hasla
    if($passLength < 6 || $passLength > 40) {
        $walidacja = false;
        $_SESSION['e_haslo'] =  "Hasło musi mieć od 6 do 40 znaków!";
    }
    if($haslo != $haslo2) {
        $walidacja = false;
        $_SESSION['e_haslo2'] = "Hasła nie są zgodne!";
    }

    //walidacja regulaminu
    if(!isset($_POST['regulamin'])) {
        $walidacja = false;
        $_SESSION['e_regulamin'] = "Proszę zaakceptować regulamin!";
    }

    //walidacja recaptcha
    $sekret = '6LcopkoUAAAAAHndJ7tRXJF5XEl1NuqC3X34RS6h';
    $sprawdz = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$sekret.'&response='.$_POST['g-recaptcha-response']);
    $odpowidz = json_decode($sprawdz);

    if($odpowidz->success == false) {
        $walidacja = false;
        $_SESSION['e_bot'] = "Proszę potwierdzć, że nie jesteś botem!";
    }
    //wszsystko spoko
    if($walidacja == true){
        $_SESSION['spoko'] = 'dziekujemy';
        $haslo_db = password_hash($haslo, PASSWORD_DEFAULT);
        $queryv3 = "INSERT into uzytkownicy values(null,'$user', '$haslo_db', '$email', 1,2,3,4,0)";
        try {
            $polaczenie->query($queryv3);
        } catch(Exception $p) {
            exit('Nastąpił błąd przepraszamy!');
        }
        header('Location: dziekuje.php');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rejestracja</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/main.css" />
    <script src="main.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body style="font-size: 26px;">
<div id="loggingv2" style="border: 1px dashed white; padding: 8px; padding-top:20px; padding-bottom:20px; padding-left:50px; padding-right:-50px; width: 260px;margin-top:50px; margin-left:auto; margin-right:auto;background-color: #333333; margin-bottom: 50px;">
<form method="POST" action="rejestracja.php">
    Login: 
    <br>
    <?php if(isset($_SESSION['e_login'])) echo'<span style="color: red; font-size: 16px;">'. $_SESSION['e_login'].'</span>'; unset($_SESSION['e_login']); ?>
    <input type="text" name="r_user" style="margin-left: -5px;margin-bottom: 10px; font-size: 18px;">
    <br>
     Email:
    <br>
    <?php if(isset($_SESSION['e_email'])) echo'<span style="color: red; font-size: 16px;">'. $_SESSION['e_email'].'</span>'; unset($_SESSION['e_email']); ?>
    <input type="text" name="r_email" style="margin-left: -5px;margin-bottom: 10px; font-size: 18px;">
    <br>
    Hasło: 
    <br>
    <?php if(isset($_SESSION['e_haslo'])) echo'<span style="color: red; font-size: 16px;">'. $_SESSION['e_haslo'].'</span>'; unset($_SESSION['e_haslo']); ?>
    <input type="password" name="r_haslo" style="margin-left: -5px;margin-bottom: 10px; font-size: 18px;">
    <br>
    Powtórz hasło: 
    <br>
    <?php if(isset($_SESSION['e_haslo2'])) echo'<span style="color: red; font-size: 16px;">'. $_SESSION['e_haslo2'].'</span>'; unset($_SESSION['e_haslo2']); ?>
    <input type="password" name="r_haslo2" style="margin-left: -5px;font-size: 18px;margin-bottom: 10px;">
    <br>
    <label>
        <input type="checkbox" name="regulamin"> <span style="font-size: 18px">Akceptuję regulamin</span>
    </label>
    <br>
    <?php if(isset($_SESSION['e_regulamin'])) echo'<span style="color: red; font-size: 16px;">'. $_SESSION['e_regulamin'].'</span>'; unset($_SESSION['e_regulamin']); ?>
    
    <!-- WSTAWIANIE RECAPTCHA -->
    <div class="g-recaptcha" data-sitekey="6LcopkoUAAAAAJBrRj6Q3R3uYOaiq_rccA4Tw8fV" style="margin-left: -40px; posistion:relative;margin-top: 15px; margin-right:100px; margin-bottom: 10px;"></div>
    <?php if(isset($_SESSION['e_bot'])) echo'<span style="color: red; font-size: 16px;">'. $_SESSION['e_bot'].'<br>'.'</span>'; unset($_SESSION['e_bot']); ?>
    <!-- KONIEC RECAPTCHY -->
    
    <input type="submit" value ="Zarejestruj" id="b_logowanie" style="font-size: 20px;padding: 4px;margin-top: 10px;margin-bottom: 10px;">
</form>
<a href="index.php" style="text-decoration: underline;font-size: 18px;">Powrót do strony głównej</a><br>
<a href="logowanie.php" style="text-decoration: underline;font-size: 18px;">Powrót do strony logowania</a>
</div>
</body>
</html>