<?php 
    session_start();

    if(isset($_SESSION["user"])){
        $user = $_SESSION["user"];
    }

?>


<?php echo "<?xml version=\"1.0\" encoding =\"UTF-8\"?>"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <link rel="icon" href="images/download.png"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=deide-width,initial-scale=1.0"/>
    <title>One Piece Fandom - Personaggi</title>
    <link rel="stylesheet" type="text/css" href="pers.css"/>    
</head>

<body>

<div class="header">
    <div class="logo-container">
        <img src="images/one_piece_logo.png" alt="One Piece Logo" width="300" height="100"/>
    </div>
    <div class="navbar-container">
        <div class="navbar">
            <ul>
                <li><a href="onepiece.php" style="--i:1;" >Home</a></li>
                <li><a href="saghe.php" style="--i:2;" >Saghe/Episodi</a></li>
                <li><a href="personaggi.php" style="--i:3;" class="active">Personaggi</a></li>
                <li><a href="citazioni.php" style="--i:4;">Citazioni</a></li>
                <li><a href="blog.php" style="--i:5;">Blog</a></li>
            </ul>   
        </div>
    </div>
    <div class="login-container">
        <div class="login">
            <?php if(!isset($_SESSION["user"])){?>
            <a href="login.php" type="submit" class="log"> <?php echo"Login" ?></a>
            <?php }else{ ?>
                <p><?php if($_SESSION["email"]!= 'admin@gmail.com'){
                ?><a href="userindex.php" type="submit" class="profilo"><?php echo $user?></a><br><a href="logout.php" type="submit" class="logout"><?php echo "logout"?></a>
                <?php }else{ ?>
                <a href="admin/adminindex.php" type="submit" class="profilo"><?php echo $user?></a><br><a href="logout.php" type="submit" class="logout"><?php echo "logout"?></a>
                </p>
                <?php } ?>         
                
            <?php } ?> 
        </div>
    </div>
</div>

    <div class="page">
        <div class="back" id="ritorno"></div>
        <h1 class="title" >Tutti i personaggi di One piece</h1>
        <div class="desc_saga">
            Il mondo di One Piece è popolato da umani e da numerose altre razze senzienti:
            come uomini-pesce, visoni (una razza di animali antropomorfi), nani e giganti.
            Il potere è nelle mani del Governo mondiale, che detiene il controllo di 180 paesi del mondo.
            Esso è in continua lotta con i pirati e con l'Armata rivoluzionaria,
            un'organizzazione che opera con l'intento di rovesciare lo status quo.
            La principale forza armata sotto il controllo del Governo mondiale è la Marina,
            che agisce con lo scopo di mantenere la pace e punire i criminali. Per arginare il dilagante problema della pirateria,
            il Governo ha, inoltre, stretto un patto di collaborazione con sette tra i pirati più potenti,
            dando vita alla Flotta dei Sette.
            Nel Nuovo Mondo agiscono invece i Quattro Imperatori, i quattro pirati più forti e influenti
            i quali esercitano il loro potere su flotte immense e interi territori.</div>
        <br/>

    <div class="recap">
        <p class="titoloRecap">Indice:</p>
        <div class="infoRecap">
            <a class="gen" href="#pirati">Pirati:</a>
            <ul>
                <li><a href="#mugiwara" class="link">Ciurma di Cappello di paglia</a></li>
                <li><a href="#shanks" class="link">Ciurma di Shanks</a></li>
                <li><a href="#barba" class="link">Ciurma di Barbanera</a></li>
            </ul>
            <a class="gen" href="#governo">Governo Mondiale:</a>
            <ul>
                <li><a href="#astri" class="link">5 astri di saggezza</a></li>
                <li><a href="#CP0" class="link">CP0</a></li>
                <li><a href="#marina" class="link">Marina</a></li>
            </ul>
            <a class="gen" href="#riv">Rivoluzionari<br /></a>
            <br />
        </div> 
    </div>    
    
    <div class="trama">
        <p class="index" id="pirati">index</p>
        <h1>Ciurme di Pirati:</h1>
        <p>Le ciurme di pirati sono composte da un capitano e dai suoi membri. I pirati possono avere diversi obiettivi:
           saccheggiare città, trovare tesori o semplicemente salpare per il mare alla ricerca di avventure e libertà.</p>
           
        <div class="titlebotton">
            <p class="index" id="mugiwara">index</p>
            <h2>Ciurma di Cappello di Paglia:</h2> 
        </div>
        
           <table>
            <thead>
                <tr>
                    <th>Immagine</th>
                    <th>Nome</th>
                    <th>Ruolo</th>
                    <th>Taglia</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img class="character-img" src="images/luffy.jpeg" alt="Luffy"/></td>
                    <td>Monkey D. Luffy</td>
                    <td>Capitano</td>
                    <td>1,500,000,000 Berries</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/zoroo.jpeg" alt="Zoro"/></td>
                    <td>Roronoa Zoro</td>
                    <td>Spadaccino</td>
                    <td>320,000,000 Berries</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/nami.jpeg" alt="Nami"/></td>
                    <td>Nami</td>
                    <td>Navigatore</td>
                    <td>66,000,000 Berries</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/usopp.jpeg" alt="Usopp"/></td>
                    <td>Usopp</td>
                    <td>Cecchino</td>
                    <td>200,000,000 Berries</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/sanjii.jpeg" alt="Sanji"/></td>
                    <td>Sanji</td>
                    <td>Cuoco</td>
                    <td>330,000,000 Berries</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/chopper.jpeg" alt="Chopper"/></td>
                    <td>Tony Tony Chopper</td>
                    <td>Dottore</td>
                    <td>100 Berries</td>
                </tr>
            </tbody>
        </table>
        <div class="backindex"><a href="#ritorno" class="link">[Ritorna all'indice]</a></div>
        
        <div class="titlebotton">
            <p class="index" id="shanks">index</p>
            <h2>Ciurma di Shanks:</h2> 
        </div>
        
           <table>
            <thead>
                <tr>
                    <th>Immagine</th>
                    <th>Nome</th>
                    <th>Ruolo</th>
                    <th>Taglia</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img class="character-img" src="images/shanks.jpeg" alt="Shanks"/></td>
                    <td>Shanks</td>
                    <td>Capitano</td>
                    <td>4,048,900,000 Berries</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/benn.jpeg" alt="Backman"/></td>
                    <td>Been Backman</td>
                    <td>Vice-Capitano</td>
                    <td>Non rivelata</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/lucky.jpeg" alt="Lucky"/></td>
                    <td>Lucky Roo</td>
                    <td>Timoniere</td>
                    <td>Non rivelata</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/yasop.jpeg" alt="Yasop"/></td>
                    <td>Yasop</td>
                    <td>Cecchino</td>
                    <td>Non rivelata</td>
                </tr>
            </tbody>
        </table> 
        <div class="backindex"><a href="#ritorno" class="link">[Ritorna all'indice]</a></div>

        <div class="titlebotton">
            <p class="index" id="barba">index</p>
            <h2>Ciurma di Barbanera:</h2> 
        </div>
        
           <table>
            <thead>
                <tr>
                    <th>Immagine</th>
                    <th>Nome</th>
                    <th>Ruolo</th>
                    <th>Taglia</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img class="character-img" src="images/barba.jpeg" alt="Barbanera"/></td>
                    <td>Marshall D. Teach</td>
                    <td>Capitano</td>
                    <td>2,247,600,000 Berries</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/burges.jpeg" alt="jesus"/></td>
                    <td>Jesus Burgess</td>
                    <td>Vice-Capitano</td>
                    <td>Non rivelata</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/shiryo.jpeg" alt="Shiryu"/></td>
                    <td>Shiryu</td>
                    <td>Spadaccino</td>
                    <td>Non rivelata</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/Van.jpeg" alt="Van"/></td>
                    <td>Van Ooger</td>
                    <td>Cecchino</td>
                    <td>Non rivelata</td>
                </tr>
            </tbody>
        </table> 
        <div class="backindex"><a href="#ritorno" class="link">[Ritorna all'indice]</a></div>

    </div>

    <div class="trama">
        <p class="index" id="governo">index</p>
        <h1>Governo Mondiale:</h1>
        <p>Il Governo Mondiale è un'organizzazione politica che estende il proprio potere su quasi tutto il mare blu,
            in cui opera utilizzando come forza militare principale la Marina e come servizi segreti la CP0.
            Il Governo Mondiale può essere descritto come totalitario, dato che cerca in ogni modo di restare al potere,
            mantenendo con ogni sforzo possibile l'equilibrio delle tre grandi potenze
            e celando parti della storia del mondo in quanto considerate inenarrabili.</p>
           
        <div class="titlebotton">
            <p class="index" id="astri">index</p>
            <h2>5 astri di saggezza:</h2> 
        </div>
        
           <table>
            <thead>
                <tr>
                    <th>Immagine</th>
                    <th>Nome</th>
                    <th>Ruolo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img class="character-img" src="images/venus.jpeg" alt="venus"/></td>
                    <td>Venus Nusjuro</td>
                    <td>Drago Celeste</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/saturn.jpeg" alt="saturn"/></td>
                    <td>Jaygarcia Saturn</td>
                    <td>Drago Celeste</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/mars.jpeg" alt="mars"/></td>
                    <td>Marcus Mars</td>
                    <td>Drago Celeste</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/jupeter.jpeg" alt="jupeter"/></td>
                    <td>Shepherd Ju-Peter</td>
                    <td>Drago Celeste</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/warcury.jpeg" alt="warcury"/></td>
                    <td>Topman Warcury</td>
                    <td>Drago Celeste</td>
                </tr>
            </tbody>
        </table> 
        <div class="backindex"><a href="#ritorno" class="link">[Ritorna all'indice]</a></div>
        
        <div class="titlebotton">
            <p class="index" id="CP0">index</p>
            <h2>Cyper Pole Zero:</h2> 
        </div>
        
           <table>
            <thead>
                <tr>
                    <th>Immagine</th>
                    <th>Nome</th>
                    <th>Ruolo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img class="character-img" src="images/lucci.jpeg" alt="lucci"/></td>
                    <td>Rob Lucci</td>
                    <td>Agente di punta CP0</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/kaku.jpeg" alt="kaku"/></td>
                    <td>Kaku</td>
                    <td>Agente CP0</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/kalifa.jpeg" alt="kalifa"/></td>
                    <td>Kalifa</td>
                    <td>Agente secondario CP0</td>
                </tr>
            </tbody>
        </table> 
        <div class="backindex"><a href="#ritorno" class="link">[Ritorna all'indice]</a></div>

        <div class="titlebotton">
            <p class="index" id="marina">index</p>
            <h2>Marina militare:</h2> 
        </div>
        
           <table>
            <thead>
                <tr>
                    <th>Immagine</th>
                    <th>Nome</th>
                    <th>Ruolo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img class="character-img" src="images/akainu.jpeg" alt="akainu"/></td>
                    <td>Sakazuki Akainu</td>
                    <td>Grand'Ammiraglio</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/borsalino.jpeg" alt="kizaru"/></td>
                    <td>Kizaru Borsalino</td>
                    <td>Ammiraglio</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/garp.jpeg" alt="garp"/></td>
                    <td>Monkey D. Garp</td>
                    <td>Vice-Ammiraglio</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/kobi.jpeg" alt="kobi"/></td>
                    <td>Kobi</td>
                    <td>Capitano di vascello</td>
                </tr>
            </tbody>
        </table> 
        <div class="backindex"><a href="#ritorno" class="link">[Ritorna all'indice]</a></div>
    </div>

    <div class="trama">
        <p class="index" id="riv">index</p>
        <h1>Rivoluzionari :</h1>
        <p>L'Armata rivoluzionaria è un gruppo di ribelli che punta a cambiare il mondo con azioni che ne minacciano la stabilità,
           opponendosi ai nobili mondiali che manovrano il Governo Mondiale.
           Inizialmente era nota come l'Armata dell'eroica libertà.</p>
           
        <div class="titlebotton">
            <p class="index" id="rivoluzionari">index</p>
            <h2>Armata Rivoluzionaria:</h2> 
        </div>
        
           <table>
            <thead>
                <tr>
                    <th>Immagine</th>
                    <th>Nome</th>
                    <th>Ruolo</th>
                    <th>Taglia</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img class="character-img" src="images/dragon.jpeg" alt=""/></td>
                    <td>Monkey D. Dragon</td>
                    <td>Capo dell'armata </td>
                    <td>Non rivelata</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/sabo.jpeg" alt=""/></td>
                    <td>Sabo</td>
                    <td>Capo di stato Maggiore</td>
                    <td>602,000,000 Berries</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/orso.jpeg" alt=""/></td>
                    <td>Orso Bartholomew</td>
                    <td>Comandante</td>
                    <td>296,000,000 Berries</td>
                </tr>
                <tr>
                    <td><img class="character-img" src="images/koala.jpeg" alt=""/></td>
                    <td>Koala</td>
                    <td>Ufficiale</td>
                    <td>Non rivelata</td>
                </tr>
            </tbody>
        </table> 
        <div class="backindex"><a href="#ritorno" class="link">[Ritorna all'indice]</a></div>
    </div>
</div>

    <div class="footer">
        <p class="copy">&copy;2024 Copyright One Piece Fandom by Antonio Agostini &amp; Valerio Baratella</p>
    </div>   

</body>
</html>    
