<?php
if(isset($_POST["create"])) {
    include("../connection.php");

    // Utilizza prepared statements per inserire i dati nel database
    $sqlInsert = "INSERT INTO saga (nome, ep_iniziale, ep_finale, trama, img) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sqlInsert);

    // Verifica se la preparazione della query è avvenuta con successo
    if($stmt) {

    // Imposta il percorso dell'immagine su NULL di default
    $img_path = NULL;

    // Controlla se è stata fornita un'immagine
    if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
            // Cartella di destinazione per l'upload delle immagini
            $upload_dir = "../images/";
            $upload_img = "images/";
            // Genera un nome univoco per il file
            $img_name = $_FILES['img']['name'];
            $img = $upload_img . $_FILES['img']['name'];
            

            // Percorso completo dell'immagine
            $img_path = $upload_dir . $img_name;

            // Controlla se l'immagine esiste già nella cartella
            if(!file_exists($img_path)) {
                // Sposta il file temporaneo nella cartella di destinazione solo se non esiste già
                move_uploaded_file($_FILES['img']['tmp_name'], $img_path);
            }
            
    }

        // Associa i parametri della query ai valori delle variabili
        mysqli_stmt_bind_param($stmt, "sssss", $_POST["nome"], $_POST["ep_iniziale"], $_POST["ep_finale"], $_POST["trama"], $img);

        // Esegui la query
        if(mysqli_stmt_execute($stmt)) {
            session_start();
            $_SESSION["create"] = "Post added successfully";
            header("Location: sagaindex.php");
            exit(); // Termina lo script dopo il reindirizzamento
        } else {
            die("Data is not inserted!");
        }
        // Chiudi lo statement
        mysqli_stmt_close($stmt);
    } else {
        // Se la preparazione della query fallisce, mostra un messaggio di errore
        die("Error in preparing the statement!");
    }
}
?>

<?php 
if(isset($_POST["update"])) {
    include("../connection.php");

    // Utilizza prepared statements per l'aggiornamento nel database
    $sqlUpdate = "UPDATE saga SET nome=?, ep_iniziale=?, ep_finale=?, trama=?, img=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sqlUpdate);

    // Verifica se la preparazione della query è avvenuta con successo
    if($stmt) {

        // Controlla se è stata fornita una nuova immagine
        if(isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            // Cartella di destinazione per l'upload delle immagini
            $upload_dir = "../images/";
            $upload_img = "images/";
            // Genera un nome univoco per il file
            $img_name = $_FILES['img']['name'];
            $img = $upload_img . $_FILES['img']['name'];
            
            // Percorso completo dell'immagine
            $img_path = $upload_dir . $img_name;

            // Controlla se l'immagine esiste già nella cartella
            if(!file_exists($img_path)) {
                // Sposta il file temporaneo nella cartella di destinazione solo se non esiste già
                move_uploaded_file($_FILES['img']['tmp_name'], $img_path);
            }
        } else {
            // Se non è stata fornita una nuova immagine, mantieni l'immagine precedente
            $sqlSelectImg = "SELECT img FROM saga WHERE id=?";
            $stmtImg = mysqli_prepare($conn, $sqlSelectImg);
            mysqli_stmt_bind_param($stmtImg, "i", $_POST["id"]);
            mysqli_stmt_execute($stmtImg);
            mysqli_stmt_bind_result($stmtImg, $img);
            mysqli_stmt_fetch($stmtImg);
            mysqli_stmt_close($stmtImg);
        }

        // Associa i parametri della query ai valori delle variabili
        mysqli_stmt_bind_param($stmt, "sssssi", $_POST["nome"], $_POST["ep_iniziale"], $_POST["ep_finale"], $_POST["trama"], $img, $_POST["id"]);

        // Esegui l'aggiornamento nel database
        if(mysqli_stmt_execute($stmt)) {
            session_start();
            $_SESSION["update"] = "Post updated successfully";
            header("Location: sagaindex.php");
            exit(); // Termina lo script dopo il reindirizzamento
        } else {
            die("Data is not updated!");
        }
        // Chiudi lo statement
        mysqli_stmt_close($stmt);
    } else {
        // Se la preparazione della query fallisce, mostra un messaggio di errore
        die("Error in preparing the statement!");
    }
}
?>

<?php
session_start();
if(isset($_POST["voto"])){
    include("../connection.php");
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $id_user = mysqli_real_escape_string($conn, $_POST["id_user"]);
    $votazione = mysqli_real_escape_string($conn, $_POST["value"]);

    // Verifica se il valore della valutazione è valido
    if ($votazione < 1 || $votazione > 5) {
        // Mostra un messaggio di errore o esegui un'altra azione
        $_SESSION["error"] = "La valutazione deve essere compresa tra 1 e 5.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    // Query per verificare se esiste già una recensione per questo utente e questa saga
    $sqlCheck = "SELECT id_review FROM recensione WHERE id_user = ? AND id_saga = ?";
    $stmtCheck = mysqli_prepare($conn, $sqlCheck);
    mysqli_stmt_bind_param($stmtCheck, "ii", $id_user, $id);
    mysqli_stmt_execute($stmtCheck);
    mysqli_stmt_store_result($stmtCheck);

    if(mysqli_stmt_num_rows($stmtCheck) > 0) {
        // Se esiste già una recensione, aggiorna invece di inserire
        $sqlUpdate = "UPDATE recensione SET review = ? WHERE id_user = ? AND id_saga = ?";
        $stmtUpdate = mysqli_prepare($conn, $sqlUpdate);
        mysqli_stmt_bind_param($stmtUpdate, "iii", $votazione, $id_user, $id);
        if(mysqli_stmt_execute($stmtUpdate)) {
            // Recensione aggiornata con successo
            $_SESSION["update"] = "review update successfully";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        } else {
            // Errore durante l'aggiornamento della recensione
            $_SESSION["update"] = "ERROR";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        }
    } else {
        // Se non esiste una recensione, inserisci una nuova
        $sqlInsert = "INSERT INTO recensione (id_user, id_saga, review) VALUES (?, ?, ?)";
        $stmtInsert = mysqli_prepare($conn, $sqlInsert);
        mysqli_stmt_bind_param($stmtInsert, "iii", $id_user, $id, $votazione);
        if(mysqli_stmt_execute($stmtInsert)) {
            // Recensione inserita con successo
            $_SESSION["createV"] = "review insert successfully";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        } else {
            // Errore durante l'inserimento della recensione
            $_SESSION["createV"] = "ERROR";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        }
    }

    mysqli_stmt_close($stmtCheck);
    mysqli_close($conn);
}

?>

<?php
if(isset($_POST["citCreate"])) {
    include("../connection.php");

    // Utilizza prepared statements per l'inserimento nel database
    $sqlInsert = "INSERT INTO citazioni (nome_pers, cit, img) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sqlInsert);

    // Verifica se la preparazione della query è avvenuta con successo
    if($stmt) {
         // Imposta il percorso dell'immagine su NULL di default
         $img_path = NULL;

         // Controlla se è stata fornita un'immagine
         if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
                 // Cartella di destinazione per l'upload delle immagini
                 $upload_dir = "../images/";
                 $upload_img = "images/";
                 // Genera un nome univoco per il file
                 $img_name = $_FILES['img']['name'];
                 $img = $upload_img . $_FILES['img']['name'];
                 
     
                 // Percorso completo dell'immagine
                 $img_path = $upload_dir . $img_name;
     
                  // Controlla se l'immagine esiste già nella cartella
                 if(!file_exists($img_path)) {
                     // Sposta il file temporaneo nella cartella di destinazione solo se non esiste già
                     move_uploaded_file($_FILES['img']['tmp_name'], $img_path);
                 }
                 
         }

        // Associa i parametri della query ai valori delle variabili
        mysqli_stmt_bind_param($stmt, "sss", $_POST["nome_pers"], $_POST["cit"], $img);

        // Esegui l'inserimento nel database
        if(mysqli_stmt_execute($stmt)) {
            session_start();
            $_SESSION["create"] = "Post added successfully";
            header("Location: citindex.php");
            exit(); // Termina lo script dopo il reindirizzamento
        } else {
            die("Data is not inserted!");
        }
        // Chiudi lo statement
        mysqli_stmt_close($stmt);
    } else {
        // Se la preparazione della query fallisce, mostra un messaggio di errore
        die("Error in preparing the statement!");
    }
}
?>


<?php 
if(isset($_POST["citUpdate"])) {
    include("../connection.php");

    // Utilizza prepared statements per l'aggiornamento nel database
    $sqlUpdate = "UPDATE citazioni SET nome_pers=?, cit=?, img=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sqlUpdate);

    // Verifica se la preparazione della query è avvenuta con successo
    if($stmt) {

        // Controlla se è stata fornita una nuova immagine
        if(isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            // Cartella di destinazione per l'upload delle immagini
            $upload_dir = "../images/";
            $upload_img = "images/";
            // Genera un nome univoco per il file
            $img_name = $_FILES['img']['name'];
            $img = $upload_img . $_FILES['img']['name'];
            
            // Percorso completo dell'immagine
            $img_path = $upload_dir . $img_name;

            // Controlla se l'immagine esiste già nella cartella
            if(!file_exists($img_path)) {
                // Sposta il file temporaneo nella cartella di destinazione solo se non esiste già
                move_uploaded_file($_FILES['img']['tmp_name'], $img_path);
            }
        } else {
            // Se non è stata fornita una nuova immagine, mantieni l'immagine precedente
            $sqlSelectImg = "SELECT img FROM citazioni WHERE id=?";
            $stmtImg = mysqli_prepare($conn, $sqlSelectImg);
            mysqli_stmt_bind_param($stmtImg, "i", $_POST["id"]);
            mysqli_stmt_execute($stmtImg);
            mysqli_stmt_bind_result($stmtImg, $img);
            mysqli_stmt_fetch($stmtImg);
            mysqli_stmt_close($stmtImg);
        }

        // Associa i parametri della query ai valori delle variabili
        mysqli_stmt_bind_param($stmt, "sssi", $_POST["nome_pers"], $_POST["cit"], $img, $_POST["id"]);

        // Esegui l'aggiornamento nel database
        if(mysqli_stmt_execute($stmt)) {
            session_start();
            $_SESSION["update"] = "Post updated successfully";
            header("Location: citindex.php");
            exit(); // Termina lo script dopo il reindirizzamento
        } else {
            die("Data is not updated!");
        }
        // Chiudi lo statement
        mysqli_stmt_close($stmt);
    } else {
        // Se la preparazione della query fallisce, mostra un messaggio di errore
        die("Error in preparing the statement!");
    }
}
?>

<?php 
session_start();
if(isset($_POST["createPost"])) {
    include("../connection.php");

    // Utilizza prepared statements per l'inserimento nel database
    $sqlInsert = "INSERT INTO post (titolo, autore, testo, data_publ, id_user, img) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sqlInsert);

    // Verifica se la preparazione della query è avvenuta con successo
    if($stmt) {
        // Imposta il percorso dell'immagine su NULL di default
        $img_path = NULL;

        // Controlla se è stata fornita un'immagine
        if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
                // Cartella di destinazione per l'upload delle immagini
                $upload_dir = "../images/";
                $upload_img = "images/";
                // Genera un nome univoco per il file
                $img_name = $_FILES['img']['name'];
                $img = $upload_img . $_FILES['img']['name'];
                
    
                // Percorso completo dell'immagine
                $img_path = $upload_dir . $img_name;
    
                 // Controlla se l'immagine esiste già nella cartella
                if(!file_exists($img_path)) {
                    // Sposta il file temporaneo nella cartella di destinazione solo se non esiste già
                    move_uploaded_file($_FILES['img']['tmp_name'], $img_path);
                }
                
        }

        // Associa i parametri della query ai valori delle variabili
        mysqli_stmt_bind_param($stmt, "ssssis", $_POST["titolo"], $_POST["autore"], $_POST["testo"], $_POST["data_publ"], $_POST["id_user"], $img);

        // Esegui l'inserimento nel database
        if(mysqli_stmt_execute($stmt)) {
            $_SESSION["createP"] = "Post added successfully";
            header("Location:../userindex.php");
            exit(); // Termina lo script dopo il reindirizzamento
        } else {
            die("Data is not inserted!");
        }
        // Chiudi lo statement
        mysqli_stmt_close($stmt);
    } else {
        // Se la preparazione della query fallisce, mostra un messaggio di errore
        die("Error in preparing the statement!");
    }
}
?>

<?php
session_start();
if(isset($_POST["editPost"])) {
    include("../connection.php");

    // Utilizza prepared statements per l'aggiornamento nel database
    $sqlUpdate = "UPDATE post SET titolo=?, autore=?, testo=?, data_publ=?, id_user=?, img=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sqlUpdate);

    // Verifica se la preparazione della query è avvenuta con successo
    if($stmt) {
        // Controlla se è stata fornita una nuova immagine
        if(isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            // Cartella di destinazione per l'upload delle immagini
            $upload_dir = "../images/";
            $upload_img = "images/";
            // Genera un nome univoco per il file
            $img_name = $_FILES['img']['name'];
            $img = $upload_img . $_FILES['img']['name'];
            
            // Percorso completo dell'immagine
            $img_path = $upload_dir . $img_name;

            // Controlla se l'immagine esiste già nella cartella
            if(!file_exists($img_path)) {
                // Sposta il file temporaneo nella cartella di destinazione solo se non esiste già
                move_uploaded_file($_FILES['img']['tmp_name'], $img_path);
            }
        } else {
            // Se non è stata fornita una nuova immagine, mantieni l'immagine precedente
            $sqlSelectImg = "SELECT img FROM post WHERE id=?";
            $stmtImg = mysqli_prepare($conn, $sqlSelectImg);
            mysqli_stmt_bind_param($stmtImg, "i", $_POST["id"]);
            mysqli_stmt_execute($stmtImg);
            mysqli_stmt_bind_result($stmtImg, $img);
            mysqli_stmt_fetch($stmtImg);
            mysqli_stmt_close($stmtImg);
        }

        // Associa i parametri della query ai valori delle variabili
        mysqli_stmt_bind_param($stmt, "ssssisi", $_POST["titolo"], $_POST["autore"], $_POST["testo"], $_POST["data_publ"], $_POST["id_user"], $img, $_POST["id"]);

        // Esegui l'aggiornamento nel database
        if(mysqli_stmt_execute($stmt)) {
            $_SESSION["updateP"] = "Post updated successfully";
            header("Location:../userindex.php");
            exit(); // Termina lo script dopo il reindirizzamento
        } else {
            die("Data is not updated!");
        }
        // Chiudi lo statement
        mysqli_stmt_close($stmt);
    } else {
        // Se la preparazione della query fallisce, mostra un messaggio di errore
        die("Error in preparing the statement!");
    }
}
?>


