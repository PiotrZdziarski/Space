<?php
session_start();
if(!isset($_SESSION['zalogowany'])) {
    exit();
}
require_once 'connect.php';
$polaczenie = new mysqli($host, $userv2, $passv2, $name);
mysqli_set_charset($polaczenie, 'utf8');

if(isset($_POST['tekstopinii']) && $_POST['tekstopinii'] != '') {
    $tekst = $_POST['tekstopinii'];
    $uzytkownik = $_SESSION['zalogowany'];
    $query = "INSERT into opinie values(null, '$tekst', '$uzytkownik')";
    if(!$polaczenie->query($query)) {
        $_SESSION['o_komunikat'] = "Nie udało się dodać opinii!";
    } else {
        $_SESSION['o_komunikat'] = "Dziękujemy za przesłanie opinii!";
    }
} else $_SESSION['o_komunikat'] = "Pole opinii jest puste!";

$polaczenie->close();
header('Location: opinie.php');
?>