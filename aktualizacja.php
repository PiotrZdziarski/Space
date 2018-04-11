<?php 
session_start();
require_once 'connect.php';
$uploaddir = 'D:/XAMPP/htdocs/news/img/';
try {
    $polaczenieAktualizacja = new mysqli($host,$userv2,$passv2,$name);
    mysqli_set_charset($polaczenieAktualizacja, 'utf8');
} catch(Exception $g) { 
    $komunikat = "Błąd serwera!";
}
if(isset($_POST['naglowek2']) && isset($_POST['tresc2'])) {
    $naglowek = $_POST['naglowek2'];
    $tresc = $_POST['tresc2'];
    $data = date("Y-m-d H:i:s");
}

$_SESSION['zapisanynaglowek'] = $_POST['naglowek2'];
$_SESSION['zapisanytekst'] = $_POST['tresc2'];


if($_FILES['zdjecie2']['error'] == UPLOAD_ERR_OK) {
    $new_name = $uploaddir.$_FILES['zdjecie2']['name'];
    $temp_name =$_FILES['zdjecie2']['tmp_name'];
    if(move_uploaded_file($temp_name, $new_name)) {
        echo 'Plik został załadowany.';
        $sciezkadozdjecia2 = 'img/'.$_FILES['zdjecie2']['name'];
        $_SESSION['test'] = $sciezkadozdjecia2;
    } else {
        $_SESSION['nn_komunikat'] = "Nieprawidłowy plik";
    }
}
else {
    echo 'Wystąpił błąd: ';
    switch ($_FILES['zdjecie2']['error']) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
             $_SESSION['nn_komunikat'] =  'Przekroczono maksymalny rozmiar pliku';
            break;
        case UPLOAD_ERR_PARTIAL:
        $_SESSION['nn_komunikat'] = 'Odebrano tylko część pliku!';
            break;
        case UPLOAD_ERR_NO_FILE:
        echo 'Plik nie został pobrany!';
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
        $_SESSION['nn_komunikat'] = 'Brak dostępu do katalogu tymczasowego!';
            break;
        case UPLOAD_ERR_CANT_WRITE :
        $_SESSION['nn_komunikat'] = 'Nie udało się zapisać plu na dysku serwera!';
            break;
        case UPLOAD_ERR_EXTENSION :
        $_SESSION['nn_komunikat'] = 'Ładowanie pliku przerwane przez rozrszerzenie PHP';
            break;        
        default:
        $_SESSION['nn_komunikat'] = 'Nieznany typ błędu';
            break;
    }
}
$akt_naglowek = $_SESSION['akt_naglowek'];
if(isset($data) && isset($tresc) && isset($naglowek) && isset($sciezkadozdjecia2)) {
    
    //Pobieranie aktualnego id
    $queryId= "SELECT Id from news where Naglowek='$akt_naglowek'";
     $result = $polaczenieAktualizacja->query($queryId);
     $row= $result->fetch_row();
     $poprawneId = $row[0];
   
     //aktualizacja
     $query = "UPDATE news set Id = '$poprawneId', UserId = 1, Naglowek = '$naglowek', Tresc = '$tresc', Data = '$data',  sciezka = '$sciezkadozdjecia2' where Naglowek = '$akt_naglowek'";
    if($polaczenieAktualizacja->query($query)) {
        $_SESSION['nn_komunikat'] = "Udało się zaaktualizować newsa!";
    } else {
        $_SESSION['nn_komunikat'] = "Wystąpił błąd przy aktualizacji newsa!";
    }
} else $_SESSION['nn_komunikat'] = "Proszę uzupełnić wszystkie pola i załadować zdjęcie!";
header('Location: admin.php');

?>