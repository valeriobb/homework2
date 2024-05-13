<?php
session_start();

// Verifica se l'utente sta cercando di accedere direttamente a install.php
if (basename($_SERVER["SCRIPT_FILENAME"]) === 'install.php') {
    // Reindirizza l'utente a onepiece.php
    header("Location: onepiece.php");
    exit();
}

// Connessione al database
$servername = "localhost"; // Nome del server del database
$username = "root"; // Nome utente del database
$password = ""; // Password del database
$database = "onepiece"; // Nome del database

$conn = new mysqli($servername, $username, $password);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Controllo se il database esiste già
$result = $conn->query("SHOW DATABASES LIKE '$database'");
if ($result->num_rows == 0) {
    // Se il database non esiste, lo creiamo
    $sql_create_db = "CREATE DATABASE $database";
    if ($conn->query($sql_create_db) === TRUE) {
        echo "Database creato con successo<br>";
    } else {
        echo "Errore durante la creazione del database: " . $conn->error . "<br>";
    }
}

// Ricollegamento al database specificato
$conn->select_db($database);

// Controllo se le tabelle esistono già
$tables_exist = $conn->query("SHOW TABLES LIKE 'citazioni'")->num_rows > 0 && $conn->query("SHOW TABLES LIKE 'user'")->num_rows > 0;
if (!$tables_exist) {
    // Se le tabelle non esistono, le creiamo
    $sql_create_table_citazioni = "CREATE TABLE `citazioni` (
                                      `id` int(11) NOT NULL AUTO_INCREMENT,
                                      `nome_pers` varchar(255) NOT NULL,
                                      `cit` varchar(2047) NOT NULL,
                                      `img` varchar(255) DEFAULT NULL,
                                      PRIMARY KEY (`id`)
                                    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

    $sql_create_table_user = "CREATE TABLE `user` (
                                `id` int(8) NOT NULL AUTO_INCREMENT,
                                `username` varchar(255) NOT NULL,
                                `email` varchar(255) NOT NULL,
                                `password` varchar(255) NOT NULL,
                                PRIMARY KEY (`id`),
                                UNIQUE KEY `username` (`username`),
                                UNIQUE KEY `email` (`email`)
                              ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

    $sql_create_table_post = "CREATE TABLE `post` (
        `id` int(8) NOT NULL AUTO_INCREMENT,
        `titolo` varchar(255) NOT NULL,
        `autore` varchar(255) NOT NULL,
        `testo` varchar(2047) NOT NULL,
        `data_publ` date NOT NULL,
        `id_user` int(8) NOT NULL,
        `img` varchar(255) DEFAULT NULL,
        PRIMARY KEY (`id`),
        KEY `id_user` (`id_user`)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $sql_create_table_recensioni = "CREATE TABLE `recensione` (
        `id_review` int(8) NOT NULL AUTO_INCREMENT,
        `id_user` int(8) NOT NULL,
        `id_saga` int(8) NOT NULL,
        `review` int(8) NOT NULL,
        PRIMARY KEY (`id_review`),
        KEY `id_saga` (`id_saga`),
        KEY `recensione_ibfk_2` (`id_user`)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $sql_create_table_saga ="CREATE TABLE `saga` (
        `id` int(8) NOT NULL AUTO_INCREMENT,
        `nome` varchar(255) NOT NULL,
        `ep_iniziale` int(8) NOT NULL,
        `ep_finale` int(8) NOT NULL,
        `trama` varchar(2047) NOT NULL,
        `img` varchar(255) DEFAULT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `nome` (`nome`)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    if ($conn->query($sql_create_table_citazioni) === TRUE && $conn->query($sql_create_table_user) === TRUE && $conn->query($sql_create_table_post) === TRUE && $conn->query($sql_create_table_recensioni) === TRUE && $conn->query($sql_create_table_saga) === TRUE) {
        echo "Tabelle create con successo<br>";
        
        // Definizione della password hash
        $password_hash1 = '$2y$10$c6q4YekuNd7hGsIZ0KoEZ.3DdM0kNnQ4NENHCp/rj/dxd6tgE3Voa';
        $password_hash2 = '$2y$10$8Nb562yettrgPzZpRABs4.0Ff.Vld7TGjmn0FJWxxcF5NkglFTrQC';
        $password_hash3 = '$2y$10$9K8ohTEQmNEDhnr8wFWAxOFcX.WY6lJIMFra66/iKIAidSN5e.n22';
        $password_hash4 = '$2y$10$YWyM2R5jjmp.fBhu3CdUnOOKUsUxgAnm08BRzQDAVYvwiboNJsgQu';

        // Inserimento dei dati di esempio per l'utente
        $sql_insert_user = "INSERT INTO `user` (`id`, `username`, `email`, `password`) VALUES
                            (1, 'admin', 'admin@gmail.com', '$password_hash1'),
                            (2, 'Antonio', 'anto@gmail.com', '$password_hash2'),
                            (3, 'Valerio', 'vale@gmail.com', '$password_hash3'),
                            (4, 'Professore', 'prof@gmail.com', '$password_hash4')";



        if ($conn->query($sql_insert_user) === TRUE) {
            echo "Utenti inseriti con successo<br>";
        } else {
            echo "Errore durante l'inserimento dei dati utente: " . $conn->error . "<br>";
        }

        //Inserimento dei dati delle citazioni
        $sql_insert_cit = "INSERT INTO `citazioni` (`id`, `nome_pers`, `cit`, `img`) VALUES 
                           (1, 'Monkey D. Luffy', 'Io diventerò il Re dei Pirati!', 'images/luffy.jpeg'),
                           (2, 'Gol D. Roger', 'Ci sono cose che non si possono fermare: la volontà ereditata, i sogni della gente, lo scorrere del tempo. Finché le persone avranno sete di libertà, queste cose dureranno per sempre.', 'images/roger.jpeg'),
                           (3, 'Kobi', 'Adesso basta! Piantiamola di combattere, tutti quanti! Non possiamo buttare al vento tutte queste vite. Avete già compiuto la vostra missione, eppure vi ostinate a inseguire dei pirati che non hanno intenzione di farvi male! Stiamo abbandonando uomini che potrebbero essere salvati!', 'images/kobi.jpeg') ";

        if ($conn->query($sql_insert_cit) === TRUE) {
            echo "Citazioni inserite con successo<br>";
        } else {
            echo "Errore durante l'inserimento della citazione: " . $conn->error . "<br>";
        }


        //Inserimento dei dati delle saghe
        $sql_insert_saga_east_blue = "INSERT INTO `saga` (`id`, `nome`, `ep_iniziale`, `ep_finale`, `trama`, `img`) VALUES 
        (1, 'East Blue', 1, 61, '" . mysqli_real_escape_string($conn, "La saga del mare orientale è la prima grande saga della serie.
                         Rufy è un bambino del mare orientale che fa la conoscenza di Shanks.
                         È qui che l'avventura ha inizio ed è qui che il ragazzo recluta i primi membri della sua ciurma.
                         La saga inizia con un flashback riguardante l'esecuzione di Gol D. Roger.
                         Prima di morire il re dei pirati incitò i presenti ad andare alla ricerca del suo leggendario tesoro.
                         Questo diede il via all'epoca d'oro della pirateria, nella quale numerosissimi uomini presero il mare per andare alla ricerca dello One Piece.
                         Durante questa saga, Rufy si dirige verso la Rotta Maggiore e si circonda di compagni: Zoro, Nami, Usop e Sanji.
                         Nel frattempo si guadagna anche una taglia di 30.000.000 di Berry.") . "' , 'images/e1.jpg') ";

        $sql_insert_saga_alabasta = "INSERT INTO `saga` (`id`, `nome`, `ep_iniziale`, `ep_finale`, `trama`, `img`) VALUES
        (2, 'Alabasta', 62, 135, '" . mysqli_real_escape_string($conn, "Nel corso della battaglia scoprono che uno dei membri del gruppo criminale, Miss Wednesday, è in realtà Bibi,
                        la principessa di Alabasta. Bibi si è infiltrata nella Baroque Works per indagare sul coinvolgimento della 
                        banda nello scoppio della guerra civile ad Alabasta. Il capo della Baroque Works che ha scoperto il suo doppio gioco è nientemeno che...
                        Il grande Sir Crocodile, un membro della Flotta dei sette, pirati riconosciuti dal Governo Mondiale.
                        Affinché la pace possa tornare ad Alabasta, Crocodile deve essere fermato.
                        Rufy accetta la richiesta di Bibi e la riporta ad Alabasta. Dopo una serie di avventure a Little Garden e nel Regno di Drum,
                        Chopper si unisce alla ciurma in qualità di medico di bordo.
                         In seguito, la Merry approda ad Alabasta.
                         I Pirati di Cappello di paglia giungono nel regno desertico di Alabasta con l'intento di aiutare la principessa Bibi 
                        a raggiungere il prima possibile la capitale Alubarna per fermare l'imminente guerra civile che stava per scoppiare 
                        tra i ribelli guidati da Kosa e l'esercito reale comandato da Chaka. Tuttavia il vero istigatore della guerra, Mr. Zero,
                        e i suoi agenti della Baroque Works faranno di tutto per ostacolarli.
                         Il regno di Alabasta si trova a Sandy, la quarta isola che Rufy e compagni incontrano nella Rotta Maggiore;
                        è un vasto regno desertico governato dal re Nefertari Cobra.") . "' , 'images/ala.jpg')";

        $sql_insert_saga_skypea = "INSERT INTO `saga` (`id`, `nome`, `ep_iniziale`, `ep_finale`, `trama`, `img`) VALUES
        (3, 'Skypea', 136, 206, '" . mysqli_real_escape_string($conn, "La ciurma riesce a raggiungere il mare del cielo e, poco dopo il suo arrivo, viene a contatto coi suoi abitanti:
                        un gruppo ostile di persone apparentemente primitive prima, ed i più amichevoli e civilizzati abitanti di Angel Island poi,
                        mentre il gruppo si intrattiene con questi ultimi, imparando la storia del posto e le tecnologie che lo caratterizzano,
                        Nami esplora il mare bianco. La ragazza riesce a raggiungere Skypiea, ma si rende conto che l'arrivo della ciurma è
                        stato giudicato illegale e che i suoi componenti sono ricercati. Nonostante riescano a sfuggire all'iniziale tentativo di arresto,
                        la nave e parte dell'equipaggio vengono portati nel cuore di Skypiea, dove verranno giudicati da Ener, l'attuale Dio.
                         Nel tentativo di liberare i loro compagni, Rufy, Sanji ed Usop si dirigono a Skypiea.
                         Entrando a Skypiea, Rufy, Sanji e Usop causano l'ira dei quattro sacerdoti di Ener.
                         Mentre i tre affrontano uno dei sacerdoti, il resto della ciurma ne affronta un altro.
                        Questi ultimi vengono salvati dal precedente Dio, Gan Forr, il quale, nonostante venga sconfitto,
                        riesce a mettere in fuga il sacerdote. Intanto, Rufy riesce a sconfiggere l'altro sacerdote ed il suo gruppo si riunisce col resto della ciurma.
                         Una volta guarito, Gan Forr informa i pirati che, da qualche parte a Skypiea, è nascosta una città dorata.
                         Mentre sono alla ricerca della città, i pirati si ritrovano in mezzo ad una battaglia tra Ener ed i suoi sottoposti e gli Shandia, i nativi di Skypiea.") . "' , 'images/skypea.jpg') ";                

        if ($conn->query($sql_insert_saga_east_blue) === TRUE && $conn->query($sql_insert_saga_alabasta) === TRUE && $conn->query($sql_insert_saga_skypea) === TRUE) {
        echo "Saghe inserite con successo<br>";
        } else {
        echo "Errore durante l'inserimento della saga: " . $conn->error . "<br>";
        }

        //Inserimento post
        $sql_insert_post_1 = "INSERT INTO `post` (`id`, `titolo`, `autore`, `testo`, `data_publ` , `id_user` , `img`) VALUES
                            (1, 'Cosa è il One Piece', 'Antonio' , '" . mysqli_real_escape_string($conn, "Il grande tesoro ha ormai raggiunto proporzioni colossali nelle teorie dei fan, una leggenda che tutti vogliono vedere svelata.
                             Si dice sia di valore inestimabile, e grazie alla sua esistenza centinaia di pirati sono partiti per trovarlo.
                             E milioni di lettori hanno fatto la stessa cosa, continuando a sfogliare le pagine del manga per tutti questi anni.") . "' , '2024-05-08' , 2 , 'images/mugiwara.jpg'  )  ";

        $sql_insert_post_2 = "INSERT INTO `post` (`id`, `titolo`, `autore`, `testo`, `data_publ` , `id_user` , `img`) VALUES
        (2, 'Joy Boy e Nika', 'Valerio' , '" . mysqli_real_escape_string($conn, "Parlando di persone ed esseri leggendari, c'è poi la questione di Joy Boy e Nika, il dio del sole.
         Joy Boy ha a che fare con i Cento anni di vuoto, e sembra si reincarni in Rufy, stando a quanto dice Zunisha dopo la sua sconfitta con Kaido.
         E Nika? Risvegliando il suo frutto, Rufy diventa praticamente una versione di questo Dio del sole, ma Nika e Joy Boy possono essere la stessa entità?
         Ci sono altre divinità da cui i possessori del frutto del diavolo possono attingere?") . "' , '2024-05-07' , 3 , 'images/nika.jpg'  )  "; 
         
         
        $sql_insert_post_3 = "INSERT INTO `post` (`id`, `titolo`, `autore`, `testo`, `data_publ` , `id_user` , `img`) VALUES
        (3, 'Laugh Tale', 'Antonio' , '" . mysqli_real_escape_string($conn, "Avvicinandoci a quella che dovrebbe essere la fine del viaggio troviamo Raftel.
         O, come Oda ha poi rivelato, Laugh Tale, l'ultima isola. Roger ci è arrivato e lì ha trovato lo One Piece, ma ci sono ancora tantissimi misteri che aleggiano sull'isola.
         Dove si trova esattamente, come raggiungerla, anche come è fatta. Anche perché Roger ha riso, citando Joy Boy e il fatto che avrebbe voluto vivere nel suo stesso periodo.
         Manca comunque ancora un Road Poignee Griffe da scovare prima di poter localizzare l'isola.") . "' , '2024-05-06' , 2 , 'images/roger.jpeg'  )  "; 


        $sql_insert_post_4 = "INSERT INTO `post` (`id`, `titolo`, `autore`, `testo`, `data_publ` , `id_user` , `img`) VALUES
        (4, 'Lo strano  caso di Barbanera', 'Valerio' , '" . mysqli_real_escape_string($conn, "Potrebbe essere il personaggio chiave per gli eventi finali di One Piece.
         È l'unico attualmente a possedere due frutti del diavolo e non è chiaro il perché.
         Nel corso della saga si fa riferimento al suo corpo unico ma la mia teoria potrebbe essere quella che all'interno di Barbanera ci siano ben 3 persone.
         Assurdo? Uno dei primi dialoghi con Zoro e Rufy è abbastanza eclatante, dove entrambi i pirati si riferiscono a Barbanera, parlando con Nami, come a “loro” e non “lui”.
         Inoltre trasporta tre pistole nella cintura, oltre che il suo Jolly Roger è composto da tre teschi.
         Secondo questa teoria avrebbe ancora spazio per un altro frutto del diavolo.
         Sappiamo che voleva quello di Boa ma che poi ha desistito.
         Attualmente è probabilmente il personaggio più forte, quale sarà il prossimo frutto che mangerà?") . "' , '2024-05-05' , 3 , 'images/barba.jpeg'  )  ";          


        if ($conn->query($sql_insert_post_1) === TRUE && $conn->query($sql_insert_post_2) === TRUE && $conn->query($sql_insert_post_3) === TRUE && $conn->query($sql_insert_post_4) === TRUE) {
        echo "Post inseriti con successo<br>";
        } else {
        echo "Errore durante l'inserimento della saga: " . $conn->error . "<br>";
        }

    } else {
        echo "Errore durante la creazione delle tabelle: " . $conn->error . "<br>";
    }
}

$conn->close();
?>
