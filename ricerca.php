<?php
// Inizia la sessione
session_start();

// Inizializza la variabile $trovato a false
$trovato = false;

// Verifica se è stata inviata una richiesta GET e se il campo 'parola' non è vuoto
if(isset($_GET['parola']) && !empty(trim($_GET['parola']))) {
    // Ottieni la parola cercata dall'input del modulo
    $parola_cercata = $_GET['parola'];

    // Effettua la ricerca della parola nei post e visualizza i titoli corrispondenti
    include('connection.php');
    $sqlSelect = "SELECT * FROM post";
    $result = mysqli_query($conn,$sqlSelect);

    // Array per memorizzare i risultati della ricerca
    $risultati_ricerca = array();

    while($data = mysqli_fetch_array($result)){
        // Verifica se la parola è presente nel titolo o nel testo del post
        if (stripos($data["titolo"], $parola_cercata) !== false) {
            // Memorizza il risultato della ricerca
            $risultati_ricerca[] = $data;
            // Imposta la variabile di controllo su true poiché almeno una corrispondenza è stata trovata
            $trovato = true;
        }
    }

    // Se nessuna corrispondenza è stata trovata, imposta il messaggio di errore nella sessione
    if (!$trovato) {
        $_SESSION['errore'] = "Nessun post trovato per la parola '$parola_cercata'";
    } else {
        // Memorizza i risultati della ricerca nella sessione
        $_SESSION['risultati_ricerca'] = $risultati_ricerca;
        $_SESSION['parola_cercata'] = $parola_cercata;

        // Reindirizza l'utente alla pagina dei risultati della ricerca
        header("Location: risultati_ricerca.php");
        exit();
    }
} else {
    // Se il campo 'parola' è vuoto, mostra un messaggio di avviso
    $_SESSION['errore'] = "Inserisci una parola per effettuare la ricerca.";
}

// Se non sono stati trovati risultati o non è stata fornita una parola, reindirizza l'utente a blog.php
header("Location: blog.php");
exit();
?>