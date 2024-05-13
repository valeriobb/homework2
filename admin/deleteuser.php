<?php
require_once("requireadmin.php");
include('../connection.php');

function deleteUserAndPosts($userId) {
    global $conn;

    // Elimina i post dell'utente
    $sqlDeletePosts = "DELETE FROM post WHERE id_user = $userId";
    mysqli_query($conn, $sqlDeletePosts);

    // Elimina l'utente
    $sqlDeleteUser = "DELETE FROM user WHERE id = $userId";
    mysqli_query($conn, $sqlDeleteUser);

    if(mysqli_affected_rows($conn) > 0) {
        // Se l'eliminazione è andata a buon fine, impostiamo il messaggio di successo
        session_start();
        $_SESSION['delete'] = "L'utente è stato eliminato con successo.";
    }
}

// Verifica se è stato inviato l'ID dell'utente da cancellare
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Ottieni l'id dell'utente dalla query string
    $userId = $_GET['id'];

    // Chiama la funzione per cancellare l'utente e i suoi post
    deleteUserAndPosts($userId);

    // Redirect o qualsiasi altra azione dopo la cancellazione
    header("Location: deluserindex.php");
    exit(); // Assicura che lo script termini dopo il reindirizzamento
}
?>