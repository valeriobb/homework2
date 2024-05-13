

<?php 
    session_start();
    $id = $_GET['id'];
    if($id){
        include("connection.php");
        $sqlEdit = "SELECT * FROM post WHERE id= $id";
        $result = mysqli_query($conn,$sqlEdit);
    }else{
        echo "Nessun post trovato";
    }

?>




<?php echo "<?xml version=\"1.0\" encoding =\"UTF-8\"?>"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <link rel="icon" href="images/download.png"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=deide-width,initial-scale=1.0"/>
    <title>One Piece Fandom - EditPost</title>
    <link rel="stylesheet" type="text/css" href="admin/edit.css"/> 
</head>

<body>

    <div class="container">
        <div class="saghe">
        <p>MODIFICA:</p>
        <br>

        <form action="admin/crudsaga.php" method="post" enctype="multipart/form-data">
            <?php
                while($data = mysqli_fetch_array($result)){
                    ?>
                
            <div>
                <input type="text" name="titolo" id="" placeholder="Modifica titolo:" value="<?php echo $data["titolo"] ?>">
                <input type="hidden" name="autore" id="" value="<?php echo $_SESSION["user"] ?>">
                <textarea name="testo" id="" cols="30" rows="10" placeholder="Modifica il testo:"><?php echo $data["testo"] ?></textarea>
                <input type="file" name="img">
                <input type="hidden" name="data_publ" value="<?php echo date("Y-m-d") ?>" >
                <input type="hidden" name="id_user" id="" value="<?php echo $_SESSION["id_user"] ?>"> 
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" value="invio" name="editPost">
            </div>
            <?php } ?>
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
</body>
</html>