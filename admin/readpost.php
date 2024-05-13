<?php 
    $id = $_GET['id'];
    if($id){
        include("../connection.php");
        $sqlEdit = "SELECT * FROM post WHERE id= $id";
        $result = mysqli_query($conn,$sqlEdit);
    }else{
        echo "Nessuna post trovato";
    }

?>

<?php echo "<?xml version=\"1.0\" encoding =\"UTF-8\"?>"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <link rel="icon" href="images/download.png"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=deide-width,initial-scale=1.0"/>
    <title>One Piece Fandom - Admin</title>
    <link rel="stylesheet" type="text/css" href="readpost.css"/> 
</head>

<body>
    <div class="container">
        <a href="blogadminindex.php" class="back-link">Torna alla visualizzazione di tutti i post</a>
        <div class="post">
            <?php
                while($data = mysqli_fetch_array($result)){
            ?>
            <h1><?php echo $data["titolo"] ?></h1>
            <div class="author-info">
                <h2>Autore:</h2>
                <p><?php echo $data["autore"]?></p>
            </div>
            <div class="post-content">
                <h2>Testo:</h2>
                <p><?php echo $data["testo"] ?></p>
            </div>
            <div class="post-info">
                <p><?php
                        // Supponendo che $data["data_publ"] contenga la data nel formato YYYY-MM-DD
                        $data_publ = $data["data_publ"];

                        // Formattazione della data nel formato italiano (GG/MM/YYYY)
                        $data_formattata = date("d/m/Y", strtotime($data_publ));

                        // Output della data formattata
                        echo $data_formattata;
                    ?></p>
            </div>
            <?php } ?>
        </div>
    </div>
</body></html>