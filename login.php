<?php
session_start();
if (isset($_SESSION["user"])) {
        header("Location: onepiece.php");
}?>


<?php echo "<?xml version=\"1.0\" encoding =\"UTF-8\"?>"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <link rel="icon" href="images/download.png"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=deide-width,initial-scale=1.0"/>
    <title>One Piece Fandom - Login</title>
    <link rel="stylesheet" type="text/css" href="login.css"/>
</head>

<body>

<div class="container">
    <div class="login-form">
        <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "connection.php";
            $sql = "SELECT * FROM user WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["email"] = $user["email"];
                    $_SESSION["user"] = $user["username"];
                    $_SESSION["id_user"] = $user["id"];
                    if($_SESSION["email"]=='admin@gmail.com'){
                        header("Location: admin/adminindex.php");
                    }else{
                    header("Location: onepiece.php");
                    die();}
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>
        <div class="form-wrapper">
            <form action="login.php" method="post">
                <div class="form-group">
                    <input type="email" placeholder="Enter Email:" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Enter Password:" name="password" class="form-control">
                </div>
                <div class="form-btn">
                    <input type="submit" value="Login" name="login" class="btn btn-primary">
                </div>
            </form>
        </div>
        <div class="signup-link">
            <p>Not registered yet? <a href="signin.php">Register Here</a></p>
        </div>
        <div class="back-home">
        <a href="onepiece.php">Torna alla Home</a>
        </div>
        
    </div>
</div>

</body>

</html>