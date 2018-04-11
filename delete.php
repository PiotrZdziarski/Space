<?php
session_start();
require_once 'connect.php';
try {
    $polaczenieUsuwanie = new mysqli($host,$userv2,$passv2,$name);
    mysqli_set_charset($polaczenieUsuwanie, 'utf8');
} catch(Exception $g) { 
    $komunikat = "Błąd serwera!";
}
$usuwanynaglowek = $_POST['naglowkiusuwane'];
echo $usuwanynaglowek;

$query = "DELETE from news where Naglowek =  '$usuwanynaglowek'";

if($polaczenieUsuwanie->query($query)) {
    $_SESSION['usun_komunikat'] = "Udało się usunąć newsa!";
} else {
    $_SESSION['usun_komunikat'] = "Wystąpił błąd przy usuwanie newsa!";
}


$polaczenieUsuwanie->close();
header('Location:admin.php');
?>