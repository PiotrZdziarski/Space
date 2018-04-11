<?php
session_start();
if(isset($_SESSION['zalogowany'])) {
unset($_SESSION['zalogowany']);
}
if(isset($_SESSION['zalogowany_admin'])) {
    unset($_SESSION['zalogowany_admin']);
}
if(isset($_SESSION['adminek'])) {
    unset($_SESSION['adminek']);
}
header('Location: index.php');
?>