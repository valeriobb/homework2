<?php
$id = $_GET["id"];
if($id){
include("connection.php");
$sqlDelete = "DELETE FROM post WHERE id = $id";
if(mysqli_query($conn, $sqlDelete)){
    session_start();
    $_SESSION["deleteP"] = "Post deleted successfully";
    header("Location:userindex.php");
}else{
    die("Something is not write. Data is not deleted");
}
}else{
    echo "Post not found";
}
?>