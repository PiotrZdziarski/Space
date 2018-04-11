<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pl">
<head>

	<meta charset="utf-8">
	<title>Galeria zdjęć</title>
	<meta name="description" content="Piękne miejsca na Ziemi">
	<meta name="keywords" content="Taktsang, Paro, Bhutan, Arashiyama, Kyoto, Japonia, Bryce Canyon, Utah, USA, Taj Mahal, Agra, Indie, Serengeti, Tanzania, Mu Cang Chai, Yen Bai, Wietnam">
	<meta name="author" content="MZ">
	
	<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
	
	<link rel="stylesheet" href="styles/galeria.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	
	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->
	
</head>
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
			<li><a href="galeria.php" style="color: #cccccc;font-size: 28px; ">Galeria</a></li>
			<li><a href="news.php">Newsy</a></li>
			<li><a href="opinie.php">Opinie</a></li>
			<li style="border-right: white 1px dashed;"><a href="#">Kontakt</a></li>
		</ul>
		<?php if(isset($_SESSION['zalogowany_admin'])): ?>
		<a HREF="admin.php"><input type="button" value="Panel admina" id="b_logowanie" style="float:left; margin-bottom: 100px; margin-left: -250px; position:absolute; background-color:rebeccapurple; margin-top: 15px;"></a>
		<?php endif; ?>
</nav>
<body>
	
	<main>
	
		<article>
		
			<div class="container">
			
				<header>
					<h2>Ciekawe miejsca w kosmosie</h1>
				</header>
			
				<div class="postcard">
				
					<div class="photo1"> 
						<a href="#"><img width="450" height="278" src="img/mgławicakraba.jpg" alt="Taktsang"></a>
					</div>
					<p>Mgławica Kraba</p>
					
				</div>
				
				<div class="postcard">
				
					<div class="photo2"> 
						<a href="#"><img width="450" height="278" src="img/drogamleczna.jpg" alt="Arashiyama"></a>
					</div>
					<p>Droga Mleczna, nasz dom</p>
					
				</div>
				
				<div class="postcard">
				
					<div class="photo3"> 
						<a href="#"><img src="img/andromeda.jpg" width="450" height="278" alt="Bryce Canyon"></a>
					</div>
					<p>Andromeda</p>
					
				</div>
				
				<div class="postcard">
				
					<div class="photo4"> 
						<a href="#"><img src="img/kwazar.jpg" alt="Taj Mahal" width="450" height="278"></a>
					</div>
					<p>Kwazar</p>
					
				</div>				
				

				<div class="postcard">
				
					<div class="photo5"> 
						<a href="#"><img src="img/sirius.jpg" alt="Serengeti" width="450" height="278"></a>
					</div>
					<p>Sirius A, Sirius B</p>
					
				</div>

				<div class="postcard">
				
					<div class="photo6"> 
						<a href="#"><img src="img/dis.jpg" alt="Mu Cang Chai" width="450" height="278"></a>
					</div>	
					<p>Norbert Gierczak</p>
				</div>				
	
			</div>

		</article>
	
	</main>
	<div id="footer"> Wszelkie prawa zastrzeżone &copy Piotr Zdziarski</div>
</body>
</html>