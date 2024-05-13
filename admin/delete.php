<?php require_once("requireadmin.php"); ?>

<?php
$id = $_GET["id"];
if($id){
include("../connection.php");
$sqlDelete = "DELETE FROM saga WHERE id = $id";
if(mysqli_query($conn, $sqlDelete)){
    session_start();
    $_SESSION["delete"] = "Post deleted successfully";
    header("Location:sagaindex.php");
}else{
    die("Something is not write. Data is not deleted");
}
}else{
    echo "Post not found";
}
?>