<?php 
session_start();
if(isset($_SESSION["id_user"])){
    $id_user=$_SESSION["id_user"];
}else{
    header("Location:blog.php");
    $_SESSION['errore'] = "Per inserire un nuovo post devi prima loggarti.";
    exit();
}
?>




  




<?php echo "<?xml version=\"1.0\" encoding =\"UTF-8\"?>"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <link rel="icon" href="images/download.png"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=deide-width,initial-scale=1.0"/>
    <title>One Piece Fandom - NewPost</title>
    <link rel="stylesheet" type="text/css" href="nuovopost.css"/>  
</head>

<body>
    <div class="container">
        <h1>Nuovo Post</h1>

        <div class="form-container">
            <form action="admin/crudsaga.php" method="post" enctype="multipart/form-data">
                <div>
                    <input type="text" name="titolo" placeholder="Inserisci titolo">
                    <textarea name="testo" cols="30" rows="10" placeholder="Inserisci il testo"></textarea>
                    <input type="file" name="img">
                    <input type="hidden" name="autore" value="<?php echo $_SESSION["user"] ?>">
                    <input type="hidden" name="data_publ" value="<?php echo date("Y-m-d") ?>">
                    <input type="hidden" name="id_user" value="<?php echo $_SESSION["id_user"] ?>"> 
                    <input type="submit" value="Invio" name="createPost">
                </div>
            </form>
        </div>

        <div class="navigation-links">
            <a href="onepiece.php">Torna alla Home del FANDOM</a>
            <?php
            // Verifica se c'è un URL di riferimento
            if(isset($_SERVER['HTTP_REFERER'])) {
                // Stampa un link per tornare alla pagina precedente
                echo '<a href="' . $_SERVER['HTTP_REFERER'] . '" class="back-link">Torna indietro</a>';
            } else {
                // Se non c'è un URL di riferimento, stampa un messaggio di default
                echo '<p>Non è possibile tornare indietro.</p>';
            }
        ?>
        </div>
    </div>
</body></html>