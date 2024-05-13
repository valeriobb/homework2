<?php echo "<?xml version=\"1.0\" encoding =\"UTF-8\"?>"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <link rel="icon" href="images/download.png"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=deide-width,initial-scale=1.0"/>
    <title>One Piece Fandom - Post</title>
    <link rel="stylesheet" type="text/css" href="risultati_ricerca.css"/>
</head>

<body>

    <div class="container">
        <?php
        // Inizia la sessione
        session_start();

        // Verifica se ci sono risultati di ricerca memorizzati nella sessione
        if(isset($_SESSION['risultati_ricerca'])) {
            // Recupera i risultati di ricerca dalla sessione
            $risultati_ricerca = $_SESSION['risultati_ricerca'];
            $parolacercata = $_SESSION['parola_cercata'];

            echo "<div class='message'>Questi sono i post che contengono: '$parolacercata'</div>";

            // Visualizza i risultati della ricerca
            foreach($risultati_ricerca as $data) {
                echo "<div class='post'>";
                echo "<h2>" . $data["titolo"] . "</h2>";
                echo "<p>Autore: " . $data["autore"] . "</p>";
                // Puoi aggiungere altri campi del post se necessario
                echo "<a href='readsearchpost.php?id=" . $data["id"] . "'>Leggi</a>";
                echo "</div>";
            }

            // Aggiungi un link per tornare alla pagina blog.php
            echo "<a class='back-link' href='blog.php'>Torna alla pagina del blog</a>";

            // Pulisci i risultati della ricerca dalla sessione
            unset($_SESSION['risultati_ricerca']);
        } else {
            // Se non ci sono risultati di ricerca memorizzati nella sessione, mostra un messaggio di avviso
            echo "<div class='message'>Nessun risultato trovato.</div>";
        }
        ?>
    </div>

</body>


</html>