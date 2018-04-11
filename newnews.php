<?php
session_start();
$uploaddir = 'D:/XAMPP/htdocs/news/img/';
require_once 'connect.php';
$polaczenie = new mysqli($host,$userv2,$passv2,$name);
mysqli_set_charset($polaczenie, 'utf8');
if(isset($_POST['naglowek']) && isset($_POST['tresc'])) {
    $naglowek = $_POST['naglowek'];
    $tresc = $_POST['tresc'];
    $data = date("Y-m-d H:i:s");

    $_SESSION['new_naglowek'] = $naglowek;
    $_SESSION['new_tresc'] = $tresc;
}

if($_FILES['zdjecie']['error'] == UPLOAD_ERR_OK) {
    $new_name = $uploaddir.$_FILES['zdjecie']['name'];
    $temp_name =$_FILES['zdjecie']['tmp_name'];
    if(move_uploaded_file($temp_name, $new_name)) {
        echo 'Plik został załadowany.';
        $sciezkadozdjecia = 'img/'.$_FILES['zdjecie']['name'];
    } else {
        echo "Nieprawidłowy plik";
    }
}
else {
    echo 'Wystąpił błąd: ';
    switch ($_FILES['zdjecie']['error']) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
             echo 'Przekroczono maksymalny rozmiar pliku';
            break;
        case UPLOAD_ERR_PARTIAL:
            echo 'Odebrano tylko część pliku!';
            break;
        case UPLOAD_ERR_NO_FILE:
            echo 'Plik nie został pobrany!';
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            echo 'Brak dostępu do katalogu tymczasowego!';
            break;
        case UPLOAD_ERR_CANT_WRITE :
            echo 'Nie udało się zapisać plu na dysku serwera!';
            break;
        case UPLOAD_ERR_EXTENSION :
            echo 'Ładowanie pliku przerwane przez rozrszerzenie PHP';
            break;        
        default:
            echo 'Nieznany typ błędu';
            break;
    }
}
if(isset($data) && isset($tresc) && isset($naglowek) && isset($sciezkadozdjecia)) {
    $query = "INSERT into news values(null, 1, '$naglowek' , '$tresc', '$data', '$sciezkadozdjecia')";
    if($polaczenie->query($query)) {
        $_SESSION['n_komunikat'] = "Udało się dodać newsa!";
    } else {
        $_SESSION['n_komunikat'] = "Wystąpił błąd przy dodawaniu newsa!";
    }
} else $_SESSION['n_komunikat'] = "Proszę uzupełnić wszystkie pola i załadować zdjęcie!";
$polaczenie->close();
header('Location: admin.php');
?>
