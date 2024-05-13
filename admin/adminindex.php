<?php require_once("requireadmin.php"); ?>

<?php
        if (isset($_SESSION["create"])) {
        ?>
        <div class="alert alert-success">
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
        <div class="alert alert-success">
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
        <div class="alert alert-success">
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
    <link rel="stylesheet" type="text/css" href="admin.css"/> 
</head>

<body>

    <div class="container">
        <a href="../onepiece.php" class="back-home">Torna alla Home</a>    

        <div class="options">
            <div class="option">
                <a href="sagaindex.php">Modifica saghe</a>
            </div>
            <div class="option">
                <a href="citindex.php">Modifica citazioni</a>
            </div>
            
            <div class="option">
                <a href="blogadminindex.php">Modifica blog</a>
            </div>

            <div class="option">
                <a href="deluserindex.php">Elimina utente</a>
            </div>

        </div>
    </div>

</body>

</html>