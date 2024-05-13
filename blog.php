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
    <title>One Piece Fandom - Blog</title>
    <link rel="stylesheet" type="text/css" href="blog.css"/>
</head>

<body>


<div class="header">
    <div class="logo-container">
        <img src="images/one_piece_logo.png" alt="One Piece Logo" width="300" height="100"/>
    </div>
    <div class="navbar-container">
        <div class="navbar">
            <ul>
                <li><a href="onepiece.php" style="--i:1;" >Home</a></li>
                <li><a href="saghe.php" style="--i:2;" >Saghe/Episodi</a></li>
                <li><a href="personaggi.php" style="--i:3;" >Personaggi</a></li>
                <li><a href="citazioni.php" style="--i:4;">Citazioni</a></li>
                <li><a href="blog.php" style="--i:5;" class="active">Blog</a></li>
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

<?php

// Recupera il messaggio di errore dalla sessione
if(isset($_SESSION['errore'])) {
    $messaggio_errore = $_SESSION['errore'];
    // Rimuovi il messaggio di errore dalla sessione per evitare di visualizzarlo nuovamente
    unset($_SESSION['errore']);
}

// Visualizza il messaggio di errore se presente  //da spostare vicino la form
if(isset($messaggio_errore)) {
    ?> <div class="messerror"> 
        <?php  echo "<p>$messaggio_errore</p>"; ?> <a href="blog.php">X</a> 
    </div>
   
<?php }
?>



<div class="home">
    <div class="search-container">
        <h2>Inserisci la parola da cercare:</h2>
        <form action="ricerca.php" method="GET">
            <input type="text" name="parola" placeholder="Search">
            <button type="submit">Cerca</button>
        </form>
    </div>
    <?php if(isset($_SESSION["email"]) && $_SESSION["email"] != 'admin@gmail.com'){ ?>
    <a href="nuovopost.php" class="add-post-link">Aggiungi nuovo post</a>
    <?php } ?>
    <p class="recente">Post più recente</p>
    <div class="post-container">
    <?php
        include('connection.php');
        $sqlSelect = "SELECT * FROM post ORDER BY data_publ DESC LIMIT 1";
        $result = mysqli_query($conn,$sqlSelect);
        
        // Controlla se ci sono post disponibili e se il risultato della query è valido
        if($result && mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_array($result);
    ?>
    <div class="post">
        <div class="post-image">
            <img src="<?php echo $data['img']; ?>" alt="Immagine">
        </div>
        <div class="post-details">
            <h2 class="post-title"><?php echo $data["titolo"]?></h2>
            <p class="post-text">"<?php 
                $maxLength = 40;
                $text = $data["testo"];
                if (strlen($text) > $maxLength) {
                    $shortText = substr($text, 0, $maxLength);
                    // Trova l'ultima occorrenza dello spazio prima del 40° carattere
                    $lastSpace = strrpos($shortText, ' ');
                    if ($lastSpace !== false) {
                        $shortText = substr($shortText, 0, $lastSpace) . '...';
                    } else {
                        // Se non ci sono spazi prima del 40° carattere, taglia comunque la stringa
                        $shortText .= '...';
                    }
                } else {
                    $shortText = $text;
                }
                echo $shortText;
            ?>"</p>
            <p class="post-author">by <?php echo $data["autore"]?></p>
            <p class="post-date"><?php
                                // Supponendo che $data["data_publ"] contenga la data nel formato YYYY-MM-DD
                                $data_publ = $data["data_publ"];

                                // Formattazione della data nel formato italiano (GG/MM/YYYY)
                                $data_formattata = date("d/m/Y", strtotime($data_publ));

                                // Output della data formattata
                                echo $data_formattata;
                                ?></p>
            <a class="read-more" href="readsearchpost.php?id=<?php echo $data["id"]?>">Read More</a>
        </div>
    </div>
    <?php
        } else {
            echo "<p>Non ci sono ancora post nel blog.</p>";
        }
    ?>
</div>


    <p class="allpost">Tutti i post:</p>


    <div class="additional-posts-container">
        <?php
            $sqlSelect = "SELECT * FROM post ORDER BY data_publ DESC LIMIT 9 OFFSET 1"; // Recupera i successivi 9 post, escludendo il più recente
            $result = mysqli_query($conn,$sqlSelect);
            while ($data = mysqli_fetch_array($result)) {
        ?>
        <div class="additional-post">
            <!-- Immagine a sinistra -->
            <div class="post-image">
                <img src="<?php echo $data['img']; ?>" alt="Immagine">
            </div>
        
            <!-- Dettagli del post a destra -->
            <div class="post-details">
                <h2 class="post-title"><?php echo $data["titolo"]?></h2>
                <p class="post-text"><?php 
                    $maxLength = 40;
                    $text = $data["testo"];
                    if (strlen($text) > $maxLength) {
                        $shortText = substr($text, 0, $maxLength);
                        // Trova l'ultima occorrenza dello spazio prima del 40° carattere
                        $lastSpace = strrpos($shortText, ' ');
                        if ($lastSpace !== false) {
                            $shortText = substr($shortText, 0, $lastSpace) . '...';
                        } else {
                            // Se non ci sono spazi prima del 40° carattere, taglia comunque la stringa
                            $shortText .= '...';
                        }
                    } else {
                        $shortText = $text;
                    }
                    echo $shortText;
                    ?></p>
                <p class="post-author">by <?php echo $data["autore"]?></p>
                <p class="post-date"><?php
                                    // Supponendo che $data["data_publ"] contenga la data nel formato YYYY-MM-DD
                                    $data_publ = $data["data_publ"];

                                    // Formattazione della data nel formato italiano (GG/MM/YYYY)
                                    $data_formattata = date("d/m/Y", strtotime($data_publ));

                                    // Output della data formattata
                                    echo $data_formattata;
                                    ?></p>
                <a class="read-more" href="readsearchpost.php?id=<?php echo $data["id"]?>">Read More</a>
            </div>
        </div>
        <?php
            }
        ?>
    </div>

</div>

<div  class="footer">
    <p class="copy">&copy;2024 Copyright One Piece Fandom by Antonio Agostini &amp; Valerio Baratella</p>
</div>  

</body>
</html>