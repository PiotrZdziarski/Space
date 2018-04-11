<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Space</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/main.css" />
    <script src="main.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
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
                <li><a href="#" style="color: #cccccc;font-size: 28px;">Strona główna</a></li>
                <li><a href="galeria.php">Galeria</a></li>
                <li><a href="news.php">Newsy</a></li>
                <li><a href="opinie.php">Opinie</a></li>
                <li style="border-right: white 1px dashed;"><a href="#">Kontakt</a></li>
            </ul>
            <?php if(isset($_SESSION['zalogowany_admin'])): ?>
            <a HREF="admin.php"><input type="button" value="Panel admina" id="b_logowanie" style="float:left; margin-bottom: 100px; margin-left: -250px; position:absolute; background-color:rebeccapurple; margin-top: 10px;"></a>
            <?php endif; ?>
     </nav>
     <main>
         <div id="container"><br><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis elementum velit tincidunt nibh fringilla convallis. In vel augue tortor. Vivamus vel augue interdum, posuere magna bibendum, tincidunt arcu. In bibendum enim efficitur sapien pellentesque condimentum. Nulla fringilla viverra nisl nec pretium. Ut efficitur enim lectus, sed blandit ligula luctus eu. Integer dictum pulvinar mi, id mattis orci venenatis eget. Fusce at erat metus. Suspendisse eu sem pharetra, consectetur enim eu, lobortis enim.<p>

            <p>Duis nec venenatis eros, nec gravida lacus. Vivamus ultrices accumsan auctor. Sed semper ex ligula, sed auctor est tempus nec. Suspendisse a faucibus orci, at cursus mauris. Aliquam cursus arcu eget eleifend posuere. Nunc risus ex, tempor euismod rutrum at, eleifend vel erat. Suspendisse potenti. In erat lectus, interdum nec eros eget, posuere sodales elit. Phasellus et semper lectus. Curabitur non lacinia arcu, in sodales justo. Aliquam erat volutpat.</p>

            <p>Praesent ante tortor, sollicitudin quis consequat ut, porttitor nec magna. Proin gravida ante vel sodales porta. Aenean gravida lorem eros. Nunc elementum magna ligula. Nullam eget nisi vel orci mattis semper. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam condimentum scelerisque ultrices. Fusce ante massa, pretium sit amet libero non, condimentum elementum nisl. Sed ac lectus ut erat viverra malesuada. Nunc vestibulum tortor non augue sollicitudin pellentesque. Fusce blandit, elit in molestie semper, ligula enim faucibus velit, pellentesque aliquet nulla velit eget quam.</p>

            <p>In maximus dolor nunc. Nullam vehicula molestie scelerisque. Morbi varius diam augue, eget ultricies nulla faucibus a. Maecenas eget ex ac lectus tristique dignissim in a tellus. Nulla facilisi. Integer vel tincidunt tortor, quis imperdiet nibh. Nullam ex ex, molestie non augue ac, lacinia posuere arcu. Praesent sed facilisis orci. Donec ac magna at velit suscipit scelerisque vitae a felis. Praesent vel sem ligula. Sed massa est, auctor et tortor sit amet, sagittis aliquet eros. Proin sit amet mauris nec augue pulvinar dignissim vel a tortor. Nam porta, tortor quis aliquam blandit, augue ipsum lacinia eros, egestas rhoncus augue diam ac sapien. In consequat augue in neque volutpat, nec eleifend ipsum consectetur. Integer mauris erat, sagittis ac accumsan ut, rutrum sed enim.</p>

            <p>Quisque porta dolor vel semper pellentesque. Curabitur quis porttitor lacus. Aenean nec malesuada urna. Vivamus tempor fringilla justo sit amet porttitor. Curabitur tempus lacus vel congue finibus. Sed vitae magna quis nulla condimentum pretium sed eget lectus. Cras non leo nisi. Mauris ex massa, pulvinar sit amet dapibus in, condimentum eu urna.</p>
        </div>
    </main>
    <div id="footer"> Wszelkie prawa zastrzeżone &copy Piotr Zdziarski</div>
</body>
</html>