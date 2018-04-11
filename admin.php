<?php session_start(); 
if(!isset($_SESSION['zalogowany_admin'])) {
    header('Location:index.php');
    exit();
}
require_once 'connect.php';
try {
    $polaczenieAktualizacja = new mysqli($host,$userv2,$passv2,$name);
    mysqli_set_charset($polaczenieAktualizacja, 'utf8');
} catch(Exception $g) { 
    $komunikat = "Błąd serwera!";
}
$query = "SELECT Naglowek from news";
$result = $polaczenieAktualizacja->query($query);
$resultusun = $polaczenieAktualizacja->query($query);
if (isset($_POST['naglowki'])) {
   $naglowekzformularza = $_POST['naglowki']; 
   $_SESSION['akt_naglowek'] = $naglowekzformularza;
$query2 = "SELECT Tresc, sciezka from news where Naglowek = '$naglowekzformularza'";
$result2 = $polaczenieAktualizacja->query($query2);
$fetch2 = $result2->fetch_assoc();
$trescdoformularza = $fetch2['Tresc'];
$sciezkadoformularza = $fetch2['sciezka'];
}


if(isset($_SESSION['zapisanynaglowek']) && isset($_SESSION['zapisanytekst'])) {
    $naglowekzformularza = $_SESSION['zapisanynaglowek'];
    $trescdoformularza = $_SESSION['zapisanytekst'];
    unset($_SESSION['zapisanynaglowek']);
    unset($_SESSION['zapisanytekst']);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admins Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/admin.css" />
    <script src="main.js"></script>
</head>
<body>
<header>
        <div id="headerv1">
            <div id="title">
                <h1 id="tytul">Space</h1>              
            </div>
            <div class="logging" style="float:left;">
            <?php if(!isset($_SESSION['zalogowany'])): ?>    
            <a href="logowanie.php">
                    <input type="button" value="Logowanie" id="b_logowanie" style="float:left; margin-top:25px;">
                </a>
            <?php endif; if(isset($_SESSION['zalogowany'])):?>
            <a href="logout.php">
                    <input type="button" value="Wyloguj" id="b_logowanie" style="float:left; margin-top:25px;">
                </a>
            <?php endif;?>
                    <a href="rejestracja.php">         
                        <input type="button" value="Rejestracja" id="b_logowanie" style="margin-top: 25px; margin-left: 20px;">
                    </a>
                <span style="font-size: 20px;">
                    <br><?php if(isset($_SESSION['zalogowany'])) {
                        echo ' Zalogowany jako: '.$_SESSION['zalogowany'];
                    } else {
                        echo 'Nie zalogowano';
                    }           
                    ?>
                </span>
            </div>
        </div>
    </header>
    <nav id="topnav">
             <ul class="menu">
                <li><a href="index.php">Strona główna</a></li>
                <li><a href="galeria.php">Galeria</a></li>
                <li><a href="news.php">Newsy</a></li>
                <li><a href="opinie.php">Opinie</a></li>
                <li style="border-right: white 1px dashed;"><a href="#">Kontakt</a></li>
            </ul>
            <?php if(isset($_SESSION['zalogowany_admin'])): ?>
            <a HREF="admin.php"><input type="button" value="Panel admina" id="b_logowanie" style="float:left; margin-bottom: 100px; margin-left: -250px; position:absolute; background-color:purple; color:#cccccc; margin-top: 10px;"></a>
            <?php endif; ?>
     </nav>
<main>

 <!--   DODAWANIE
 ---------------------------------------
---------------------------------------
  -->
     
     
     <?php if(isset($_SESSION['n_komunikat'])): ?>
     <div style="margin-top: 10px; margin-left: 115px; padding:0; font-size:22px;color: dodgerblue;"><?=$_SESSION['n_komunikat']?></div>
                <?php unset($_SESSION['n_komunikat']); endif; ?>
     <div id ="container2" class="container2" style=" width: 480px; border: 1px solid whitesmoke; padding: 10px; margin-bottom: 20px; padding-bottom: 20px; background-color:#444444; padding-top: 15px;">
      <form method = "POST" action="newnews.php" enctype="multipart/form-data" name="formularz1" id="formularz1">
            Nagłówek:    
        <input type="text" maxlength="45" name="naglowek" style=" width: 350px;font-size: 28px; color:dodgerblue; background-color:#222222;" 
        <?php 
            if(isset($_SESSION['new_naglowek'])): ?>
            value = <?=$_SESSION['new_naglowek'] ?>> <?php unset($_SESSION['new_naglowek']); endif; ?>    
 
         <br><p>
        <textarea form="formularz1" cols="35" name="tresc" maxlength="750" type="textarea" style ="width: 410px; height: 350px;font-size: 18px; margin-left:34px; background-color:#222222; color:#cccccc;"><?php if(isset($_SESSION['new_tresc'])) echo $_SESSION['new_tresc']; unset($_SESSION['new_tresc']);?></textarea>
        <br>
        <div style="margin-left: 20px;"> Zdjęcie:
        <input type="file" name="zdjecie" style="font-size: 20px; margin-top:5px; ">
        <input type="submit" id="b_logowanie" style="margin-top: 20px; background-color: crimson; float:left;" value="Wyślij newsa">
        </div>
    </div>
    </div>
      </form>


 <!--   AKUTALIZACJA
 ---------------------------------------
---------------------------------------
  -->

           <?php if(isset($_SESSION['nn_komunikat'])): ?>
     <div style=" margin-left: 730px; padding:0; margin-bottom: 0px; margin-top: 10px;center;padding:0; font-size:22px;color: dodgerblue;"><?=$_SESSION['nn_komunikat']?></div>
                <?php unset($_SESSION['nn_komunikat']); endif; ?>
     <div id ="container2" class="container2" style=" width: 480px; border: 1px solid whitesmoke; margin-bottom: 20px; padding: 10px; padding-bottom: 20px; background-color:#444444; padding-top: 15px;">

<form method="POST" action="admin.php" name="formularz3">
<select name="naglowki" id="naglowki" multiple="multiple" style="margin-left: 20px;width: 350px; color:#eeeeee; background-color:#222222;">

<?php while ($row = $result->fetch_assoc()): ?>

<option value="<?php echo $row['Naglowek'];?>"><?=$row['Naglowek']?></option>

<?php endwhile; ?>
</select>

<input type="submit" name="Wybierz"  id="b_logowanie" style="font-size: 18px; padding: 4px; margin-left: 15px; margin-top: 50px; position: absolute;" value="Wybierz">
</form>
     <form method = "POST" action="aktualizacja.php" enctype="multipart/form-data"  name="formularz2" id="formularz2">
   <?php if(isset($naglowekzformularza)) : ?>
    Nagłówek:    
            <input type="text" maxlength="45" name="naglowek2" value="<?php if(isset($naglowekzformularza)) echo $naglowekzformularza;?>" style="margin-top: 10px; width: 350px;font-size: 28px; color:dodgerblue; background-color:#222222;">  
                <div id="clear:both;"></div>
            <br>
            <textarea form="formularz2" cols="35" name="tresc2" maxlength="760" type="textarea"  style ="width: 410px; height: 350px;font-size: 18px; margin-left:34px; color: #cccccc; background-color:#222222;"><?php if(isset($trescdoformularza)) echo $trescdoformularza;?></textarea>
            <br>
            <div style="margin-left: 20px;"> Zdjęcie: 
             <input type="file" name="zdjecie2" style="font-size: 20px; margin-top:20px; "></div>
                <?php endif; ?>
            <input type="submit" id="b_logowanie" style="margin-top: 20px;background-color: crimson; float:left;" value="Aktualizuj newsa">
    </form>
 </div>


 <!-- USUWANIE
 ---------------------------------------
---------------------------------------
  -->
 
    <div id="container2"  class="container2" style=" width: 480px; border: 1px solid whitesmoke; position: relative; padding: 10px; padding-bottom: 20px; background-color:#444444; padding-top: 15px;">
        <form method="POST" action="delete.php" name="formularz4">
            
            <?php if(isset($_SESSION['usun_komunikat'])) : ?>
                <div style="color: #cccccc;"><?=$_SESSION['usun_komunikat']?></div>
            <?php unset($_SESSION['usun_komunikat']); endif; ?>
            
            <select name="naglowkiusuwane" id="naglowki" multiple="multiple" style="margin-left: 20px;width: 350px;color:#eeeeee; background-color:#222222; ">

                <?php while ($rowusun = $resultusun->fetch_assoc()): ?>

                <option value="<?php echo $rowusun['Naglowek'];?>" ><?=$rowusun['Naglowek']?></option>

                <?php endwhile; ?>
            </select>

                <input type="submit" name="usun"  id="b_logowanie" style="background-color: red; font-size: 18px; padding: 4px; margin-left: 15px; margin-top: 50px; position: absolute;" value="Usuń">
        </form>
    </div>
</main>
</body>
</html>