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
    <link rel="stylesheet" type="text/css" href="deluserindex.css"/> 
</head>

<body>

    <div class="container">

        <a href="../onepiece.php">Torna alla Home del FANDOM</a>
        <br>
        <a href="adminindex.php">Torna Alla Home dell'Admin</a>
        <table>
            <thead>
                <tr>
                    <th style="width:15%;">Username</th>
                    <th style="width:15%;">Post pubblicati</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
    <?php
    include('../connection.php');
    $sqlSelectUser = "SELECT user.id, user.username, COUNT(post.id) AS num_post
                      FROM user
                      LEFT JOIN post ON user.id = post.id_user
                      WHERE user.email != 'admin@gmail.com'
                      GROUP BY user.id";
    $result = mysqli_query($conn, $sqlSelectUser);

    while ($data = mysqli_fetch_array($result)) {
        // Verifica se l'ID dell'utente è presente prima di utilizzarlo
        if (isset($data["id"])) {
            $userIdToDelete = $data["id"]; // Salva l'id dell'utente da cancellare
        }
    ?>
        <tr>
            <td><?php echo $data["username"] ?></td>
            <td><?php echo $data["num_post"] ?></td>
            <td>
                <?php if (isset($userIdToDelete)): ?>
                    <a class="ban" href="deleteuser.php?id=<?php echo $userIdToDelete ?>">Delete user</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php } ?>
</tbody>

        </table>
        

    </div>
</body>
</html>