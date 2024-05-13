<?php 
    session_start();

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
    <title>One Piece Fandom - Mappa</title>
    <link rel="stylesheet" type="text/css" href="mappa.css"/>    
</head>

<body>
    <div class="header">
        <img src="images/one_piece_logo.png" alt="One Piece Logo" width="300" height="100"></img> 

        <div class="navbar">
            <ul>
                <li><a href="onepiece.php" style="--i:1;" class="active">Home</a></li>
                <li>
                    <a href="saghe.php" style="--i:2;" class="actual">Saghe/Episodi </a>
                </li>
                <li><a href="personaggi.php" style="--i:3;">Personaggi </a>
                </li>
                <li><a href="citazioni.php" style="--i:4;">Citazioni</a></li>
                <li><a href="blog.php" style="--i:5;">Blog</a></li>
            </ul>
        </div>
    </div>

    

    <div class="page">

       <!-- <div class="video">
            <iframe width="1000px" height="1000px" src="images/Opening One Piece - Gold Roger.mp4" allow="autoplay; controls;" frameborder="0" allowfullscreen>
                <source src="images/Opening-One-Piece-Gold-Roger.webm"/>
                <source src="images/Opening One Piece - Gold Roger.mp4"/>
            </iframe>
        </div>-->

        <div>
          <h1> MAPPA INTERATTIVA </h1>
          <h2> "clicca sulle isole o sui mari per sapere di più sul viaggio della ciurma dei Mugiwara" </h2>
        </div>
    <div class="mapimg">

        <div class="nami">
            <img src="images/nami.png" alt="nami img" width="370px"></img>
        </div>
        
        <map name="sagheop" id="mappa">
          <area shape="circle" coords="394,334,70" alt="Saga dell'East Blue" href="saghe.php#eastBlue" title="Saga dell'East Blue"/>
          <area shape="circle" coords="310,510,48" alt="Saga di Alabasta" href="saghe.php#alaba" title="Saga di Alabasta"/>
          <area shape="circle" coords="444,550,48" alt="Saga di Skypea" href="saghe.php#sky" title="Saga di Skypea"/>
        </map>
        <img src="images/map.jpg" class="bordimappa" alt="Mappa di One Piece" usemap="#sagheop"/>
        
        

        

    </div>
  
</div>

</body>
</html>
