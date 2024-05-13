<?php require_once("requireadmin.php"); ?>

<?php
$id = $_GET["id"];
if($id){
include("../connection.php");
$sqlDelete = "DELETE FROM post WHERE id = $id";
if(mysqli_query($conn, $sqlDelete)){
    session_start();
    $_SESSION["delete_PA"] = "Post deleted successfully";
    header("Location:blogadminindex.php");
}else{
    die("Something is not write. Data is not deleted");
}
}else{
    echo "Post not found";
}
?>