<?php

    // Verifica se install.php è stato incluso
if (basename($_SERVER['SCRIPT_FILENAME']) != 'install.php') {
    // Se install.php non è incluso, reindirizza a install.php
    require_once("install.php");
}

?>


<?php 
    

    if(isset($_SESSION["user"])){
        $user = $_SESSION["user"];
    }

?>

<?php echo "<?xml version=\"1.0\" encoding =\"UTF-8\"?>"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <link rel="icon" href="images/download.png"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=deide-width,initial-scale=1.0"/>
    <title>One Piece Fandom - Home</title>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>

<body>


<div class="header">
    <div class="logo-container">
        <img src="images/one_piece_logo.png" alt="One Piece Logo" width="300" height="100"/>
    </div>
    <div class="navbar-container">
        <div class="navbar">
            <ul>
                <li><a href="onepiece.php" style="--i:1;" class="active">Home</a></li>
                <li><a href="saghe.php" style="--i:2;">Saghe/Episodi</a></li>
                <li><a href="personaggi.php" style="--i:3;">Personaggi</a></li>
                <li><a href="citazioni.php" style="--i:4;">Citazioni</a></li>
                <li><a href="blog.php" style="--i:5;">Blog</a></li>
            </ul>   
        </div>
    </div>
    <div class="login-container">
        <div class="login">
            <?php if(!isset($_SESSION["user"])){?>
            <a href="login.php" type="submit" class="log"> <?php echo"Login" ?></a>
            <?php }else{ ?>
                <p><?php if($_SESSION["email"]!= 'admin@gmail.com'){
                ?><a href="userindex.php" type="submit" class="profilo"><?php echo $user?></a><br><a href="logout.php" type="submit" class="logout"><?php echo "logout"?></a>
                <?php }else{ ?>
                <a href="admin/adminindex.php" type="submit" class="profilo"><?php echo $user?></a><br><a href="logout.php" type="submit" class="logout"><?php echo "logout"?></a>
                </p>
                <?php } ?>         
                
            <?php } ?> 
        </div>
    </div>
</div>


    <div class="home">
        <div class="intro">
            <p>One Piece è un manga scritto e disegnato da <a href="https://it.wikipedia.org/wiki/Eiichir%C5%8D_Oda" class="link">Eiichirō Oda</a> (Giappone),
                serializzato dal 22 luglio 1997.<br />
                L'edizione italiana è curata da Star Comics che ne ha iniziato la pubblicazione il 1º luglio 2001.<br /><br />
                La storia segue le avventure di Monkey D. Rufy, un ragazzo il cui corpo ha assunto le proprietà della gomma,<br />
                dopo aver inavvertitamente ingerito un frutto del diavolo.<br />
                Reclutando compagni per formare una ciurma, Rufy esplora la Rotta Maggiore in cerca del leggendario tesoro,<br />
                e inseguendo il sogno di diventare il nuovo Re dei pirati.<br /><br />
                One Piece è adattato in una serie televisiva anime, prodotta da Toei Animation<br />
                L'edizione italiana è andata in onda su Italia 1 per poi continuare su Italia 2;<br />
                Svariate compagnie ne hanno tratto merchandise di vario genere: colonne sonore, videogiochi e giocattoli.<br />
                One Piece ha goduto di uno straordinario successo. È poi il manga ad avere venduto di più al mondo,<br />
                con oltre 500 milioni di copie in circolazione al 2022, anno del record.</p>
            </div>
        <div class="home-content">
            <h1>One Piece Experience.</h1>
            <h3>Salpa per il "Grande Blue" come un vero pirata,<br /> e scopri il mondo di One Piece!</h3>
            <p>clicca su "Esplora la Rotta Maggiore"<br />e ripercorri tutti i luoghi della mitica avventura!</p>
            <a href="mappa.php" class="btn">Esplora la Rotta Maggiore</a>
            <div class="nave">
                <img src="images/goingg.png" alt="nave"></img>
            </div>
        </div> 
    </div>
    <div  class="footer">
        <p class="copy">&copy;2024 Copyright One Piece Fandom by Antonio Agostini &amp; Valerio Baratella</p>
    </div>  
</body>
</html>
