<?php
session_start();
function login($user, $pass) 
{
    require_once 'connect.php';
    try {
    $polaczenie = new mysqli($host, $userv2 ,$passv2, $name);
    } catch (Exception $e) {
        return 1;
    }

    $user = $polaczenie->real_escape_string($user);
    $pass = $polaczenie->real_escape_string($pass);

    $query = "SELECT pass, admin from uzytkownicy where user='$user'";
    if(!$result= $polaczenie->query($query)) {
        $polaczenie->close();
        return 2;
    }
    if($result->num_rows <> 1) {
        $result = 2;
    } else {
        $row = $result->fetch_row();
        $pass_db = $row[0];
        //sparwdzenie czy admin
        if($row[1] == 'admin') {
            $_SESSION['adminek'] = true;
        }
        if(crypt($pass, $pass_db) != $pass_db) {
            $result = 2;
        } else $result = 0;
    }
    $polaczenie->close();
    return $result;
}

$userv1 = $_POST['user'];
$passv1  = $_POST['haslo'];

$wynik = login($userv1, $passv1);

switch ($wynik) {
    case 1:
        $_SESSION['komunikat'] = "Błąd serwera. Przepraszamy!";
        header('Location: logowanie.php');
        break;
    case 2:
        $_SESSION['komunikat'] = "Błędny login lub hasło!";
        header('Location: logowanie.php');
        break;
    case 0:
        $_SESSION['zalogowany'] = $userv1;
        if(isset($_SESSION['adminek'])) {
            $_SESSION['zalogowany_admin'] = true;
            unset($_SESSION['adminek']);
        }
        header('Location: index.php');
        break;
    default:
        break;
}
?>