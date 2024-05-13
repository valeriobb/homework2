<?php require_once("requireadmin.php"); ?>
<?php
        if (isset($_SESSION["create"])) {
        ?>
        <div class="alert-success">
            <?php 
            echo $_SESSION["create"];
            ?>
        </div>
        <?php
        unset($_SESSION["create"]);
        }
        ?>
         <?php
        if (isset($_SESSION["update"])) {
        ?>
        <div class="alert-success">
            <?php 
            echo $_SESSION["update"];
            ?>
        </div>
        <?php
        unset($_SESSION["update"]);
        }
        ?>
         <?php
        if (isset($_SESSION["delete"])) {
        ?>
        <div class="alert-danger">
            <?php 
            echo $_SESSION["delete"];
            ?>
        </div>
        <?php
        unset($_SESSION["delete"]);
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
    <link rel="stylesheet" type="text/css" href="citindex.css"/> 
</head>

<body>

    <div class="container">

        <a href="../onepiece.php">Torna alla Home del FANDOM</a>
        <br>
        <a href="adminindex.php">Torna Alla Home dell'Admin</a>
        <div class="cit">
        <form action="crudsaga.php" method="post" enctype="multipart/form-data">
            <div>
                <p>Inserisci una nuova saga:</p>
                <input type="text" name="nome_pers" id="" placeholder="Inserisci Nome:">
                <textarea name="cit" id="" cols="30" rows="10"></textarea>
                <input type="file" name="img" >
                <input type="submit" value="invio" name="citCreate">
            </div>
        </form>

        <br>
        <table>
            <thead>
                <tr>
                    <th style="width:15%;">Nome Personaggio</th>
                    <th style="width:15%;">Citazione</th>
                    <th style="width:15%;">Immagine</th>
                </tr>
            </thead>

            <tbody>

                <?php

                    include('../connection.php');
                    $sqlSelect = "SELECT * FROM citazioni";
                    $result = mysqli_query($conn,$sqlSelect);
                    while($data = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                        <td><?php echo $data["nome_pers"]?></td>
                        <td><?php 
                                // Tronca la citazione se supera i 50 caratteri
                                $citazione = $data["cit"];
                                if (strlen($citazione) > 50) {
                                    $citazione = substr($citazione, 0, 50) . '...';
                                }
                                echo $citazione;?></td>
                        <td>
                        <img src="<?php 
                                    $img = $data["img"];  //siccome ci troviamo in admin dobbiamo aggiungere "../" per visualizzare le img del db
                                    $url =  "../";
                                    $img_fin = $url . $img;
                                    echo $img_fin; ?>" alt="Immagine" style="width: 80px;">
                        </td>
                        <td>
                            <a href="editcit.php?id=<?php echo $data["id"]?>">Edit</a>
                            <a href="deletecit.php?id=<?php echo $data["id"]?>">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                

            </tbody>

        </table>

        </div></div></body></html>