<!DOCTYPE html>
<?php 
session_start(); 
require_once 'connect.php';
try {
    $polaczenieNews  = new mysqli($host,$userv2,$passv2,$name);
    mysqli_set_charset($polaczenieNews, 'utf8');
} catch (Exception $k) {
    $blad = "Nie udało się połączyć z bazą danych";
}
$query = "SELECT * from news Order by Id DESC";
$result = $polaczenieNews->query($query);
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>News</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/newscss.css" />
    <script src="main.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="background-color: #191d21">
    <header>
        <div id="headerv1" style="background-color: #191d21">
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
                <li><a href="news.php" style="color: #cccccc;font-size: 28px;">Newsy</a></li>
                <li><a href="opinie.php">Opinie</a></li>
                <li style="border-right: white 1px dashed;"><a href="#">Kontakt</a></li>
            </ul>
            <?php if(isset($_SESSION['zalogowany_admin'])):  ?>
            <a HREF="admin.php"><input type="button" value="Panel admina" id="b_logowanie" style="float:left; margin-bottom: 100px; margin-left: -250px; position:absolute; background-color:rebeccapurple; margin-top: 10px;"></a>
            <?php unset($_SESSION['n_komunikat']); endif; ?>
     </nav>
     <main>
        <?php while ($row = $result->fetch_assoc()) :?>
        <div id="container">
                <div class="title" style="background-color: #222222; color: #39a5f1"><h2><?php echo $row['Naglowek']?></h2></div>
                <div class="picture2" style="height: 301px;"> <img src= <?=$row['sciezka'] ?> class="picture" width=295 height=304>  </div>
                <div style="clear:both;"></div>
                <div class="textnews" style="background-color: #333333; padding-top: 5px; padding-left: 4px;"> <?php echo $row['Tresc']?></div>
        </div>
                    <?php endwhile; $polaczenieNews->close();?>
    </main>
    <div id="footer"> Wszelkie prawa zastrzeżone &copy Piotr Zdziarski</div>
</body>
</html>