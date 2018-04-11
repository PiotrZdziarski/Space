<?php 
session_start(); 
require_once 'connect.php';
try {
    $polaczanieOpinie = new mysqli($host, $userv2, $passv2, $name);
    mysqli_set_charset($polaczanieOpinie, 'utf8');
} catch (Exception $e) {
    echo 'Błąd serwera';
}
$query = "SELECT Tresc, Autor, Id from opinie order by Id DESC ";
 $result = $polaczanieOpinie->query($query);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Opinie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/opinie.css" />
    <script src="main.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
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
			<li><a href="opinie.php" style="color: #cccccc;font-size: 28px; ">Opinie</a></li>
			<li style="border-right: white 1px dashed;"><a href="#">Kontakt</a></li>
		</ul>
		<?php if(isset($_SESSION['zalogowany_admin'])): ?>
		<a HREF="admin.php"><input type="button" value="Panel admina" id="b_logowanie" style="float:left; margin-bottom: 100px; margin-left: -250px; position:absolute; background-color:rebeccapurple; margin-top: 10px;"></a>
		<?php endif; ?>
</nav>
<main>

    <?php if(!isset($_SESSION['zalogowany'])) : ?>
        <div class="powiadomienie">
            <span class="powiadomienie">Aby dodać opinię musisz się zalogować</span>
        </div>
    <?php endif; ?>

    <?php if(isset($_SESSION['o_komunikat'])) : ?>
        <div class="powiadomienie">
            <span class="powiadomienie"><?=$_SESSION['o_komunikat']?></span>
        </div>
    <?php unset($_SESSION['o_komunikat']); endif; ?>

    <?php if(isset($_SESSION['zalogowany'])): ?>
        
        <form method="POST" action="dodajopinie.php" id="opinia">
            <div class="komentarz">
                
                <div class="divautor">
                    <p class="nazwaautora"><?php echo $_SESSION['zalogowany'] ?></p>
                </div>
                
                <div class="divkomentarz">
                    <span class="komentarzautora">
                        <textarea form="opinia" name="tekstopinii" maxlength="200" class="tekstopinii"></textarea>
                    </span>
                </div>
            
                <div style="clear:both;"></div>
            </div>

            <input type="submit" value="Dodaj" class="dodajbutton">

        </form>

        <div class="cienkalinia"></div>

    <?php endif;?>


    <!--
        -------------------------------------------------
        ------------------------------------------------
    -->    


    <?php while($fetch = $result->fetch_assoc()): ?>
        <div class="komentarz">
            
            <div class="divautor">
                <p class="nazwaautora"><?php if(isset($fetch['Autor'])) echo $fetch['Autor']; ?></p>
            </div>
            
            <div class="divkomentarz">
                <span class="komentarzautora"><?php if(isset($fetch['Tresc'])) echo $fetch['Tresc']; ?></span>
            </div>
        
            <div style="clear:both;"></div>
        </div>
    <?php endwhile; ?>

    <div id="footer"> Wszelkie prawa zastrzeżone &copy Piotr Zdziarski</div>
</main>
</body>
</html>