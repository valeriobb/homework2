<?php 
    $id = $_GET['id'];
    if($id){
        include("connection.php");
        $sqlEdit = "SELECT * FROM saga WHERE id= $id";
        $result = mysqli_query($conn,$sqlEdit);
    }else{
        echo "Nessuna saga trovata";
    }

?>

<?php 
session_start();
if(isset($_SESSION["id_user"])){
    $id_user=$_SESSION["id_user"];
}
?>


<?php
    if (isset($_SESSION["createV"])) {
?>
    <div class="alert-success">
<?php 
    echo $_SESSION["createV"];
?>
    </div>
<?php
    unset($_SESSION["createV"]);
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
    if (isset($_SESSION["error"])) {
?>
    <div class="alert-danger">
<?php 
    echo $_SESSION["error"];
    ?>
    </div>
<?php
    unset($_SESSION["error"]);
    }
?>



<?php echo "<?xml version=\"1.0\" encoding =\"UTF-8\"?>"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <link rel="icon" href="images/download.png"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=deide-width,initial-scale=1.0"/>
    <title>One Piece Fandom - Saga</title>
    <link rel="stylesheet" type="text/css" href="viewsaga.css"/>
</head>

<body>
<div class="container">
    <?php while($data = mysqli_fetch_array($result)): ?>
        <h1><?php echo $data["nome"] ?></h1>
        <h2>Trama:</h2>
        <?php echo html_entity_decode($data["trama"]); ?>
        <h2>Episodi: <?php echo $data["ep_iniziale"] ?> - <?php echo $data["ep_finale"] ?></h2>
    <?php endwhile; ?>
</div>

    <div class="rating-container">
        <form action="admin/crudsaga.php" method="post" class="form-container">
            <?php if(!isset($_SESSION['user'])): ?>
                <p>Se vuoi valutare la saga devi prima fare il Login!</p>
            <?php else: ?>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                <?php if($_SESSION["email"]!= 'admin@gmail.com'){ ?>
                <p>Valutazione: da 1 a 5</p>
                <input type="number" name="value" min="1" max="5">
                <input type="submit" value="Invio" name="voto">
                <?php } ?>
            <?php endif; ?>
        </form>
    </div>

    <a href="saghe.php" class="back-link">Torna alle Saghe</a>
</body>


</html>