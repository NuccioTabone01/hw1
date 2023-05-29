<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>



<?php
$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

$userid = mysqli_real_escape_string($conn, $userid);

// Recupero delle informazioni dell'utente
$query = "SELECT * FROM users WHERE id = $userid";
$res_1 = mysqli_query($conn, $query);
$userinfo = mysqli_fetch_assoc($res_1);
$username = $userinfo['username'];
$firstName = $userinfo['name'];
$lastName = $userinfo['surname'];


if (isset($_POST['comment'])) {
    $content = mysqli_real_escape_string($conn, $_POST['comment']);


    // Inserimento del post nel database
    $query = "INSERT INTO posts (id, username, firstName, lastName, commentText, likes, time)
          VALUES ( 1, '$username', '$firstname', '$lastName', '$content', 0, NOW())";
          
    $stmt = mysqli_query($conn, $query);

    if (mysqli_stmt_execute($stmt)) {
        // Inserimento riuscito
        echo "Post salvato con successo.";
    } else {
    // Errore durante l'inserimento
    echo "Si è verificato un errore durante il salvataggio del post.";
    }   
}
// Chiusura delle risorse
mysqli_close($conn);
?>

<html>  
<head>
    <title>Eternity</title>
    <link rel="stylesheet" href="home.css">
    <script src="index.js" defer="true"></script>
    <script src="home.js" defer="true"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300;400&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <nav>
           <div id="logo">
                <img src="eternity.png">
            </div>
            <div id="links">
                <a>HOME</a>
                <a>CONTATTI</a>
                <a>BIBBIA</a>
                <div id="separator"></div>
                <a href='profile.php'>PROFILO</a>
                <a href='logout.php' class='button'>LOGOUT</a>
            </div>
        </nav>
        <h1> Benvenuto/a  <?php echo $_SESSION['_eternity_username']?> </h1> 
        <p> questa è la parte social di ETERNITY dove puoi commentare le parti della bibbia che più ti colpiscono e condividerle con i tuoi amici</p>
    </header>

            


<main class="main-left">
    <div class="search-bar">
        <form class="search_word" id="search_word">
            <input type="text" id="searchInput" placeholder="Cerca nella Bibbia..." />
            <input type="submit" value="Cerca" />
        </form>
    </div>
    
    <form name= 'bible-content' id='bible-content' ">
            <div id="bibbia">
             <select name="type" id="type" onchange="updateOptions()">

               <option value=" " >  </option>
               <option value="GEN" > Genesi </option>
               <option value="EXO"> Esodo </option>
               <option value="LEV" > Levitico </option>
               <option value="NUM"> Numeri </option>
               <option value="DEU" > Deuteronomio </option>
               <option value="JOS"> Giosuè </option>
               <option value="JDG" > Giudici </option>
               <option value="RUT"> Rut </option>
               <option value="1SA" > 1Samuele </option>
               <option value="2SA"> 2Samuele </option>
               <option value="1KI" > 1Re </option>
               <option value="2KI"> 2Re </option>
               <option value="1CH" > 1Cronache </option>
               <option value="2CH"> 2Cronache </option>
               <option value="EZR" > Esdra </option>
               <option value="NEH"> Neemia </option>
               <option value="EST" > Ester </option>
               <option value="JOB"> Giobbe </option>
               <option value="PSA" > salmi </option>
               <option value="PRO"> Proverbi </option>
               <option value="ECC" > Ecclesiaste </option>
               <option value="SNG"> Cantico dei Cantici </option>
               <option value="ISA" > Isaia </option>
               <option value="JER"> Geremia </option>
               <option value="LAM" > Lamentazioni </option>
               <option value="EZK"> Ezechiele </option>
               <option value="DAN" > Daniele </option>
               <option value="HOS"> Osea </option>
               <option value="JOL" > Gioele </option>
               <option value="AMO"> Amos </option>
               <option value="OBA" > Abdia </option>
               <option value="JON"> Giona </option>
               <option value="MIC" > Michea </option>
               <option value="NAM"> Naum </option>
               <option value="HAB" > Abacuc </option>
               <option value="ZEP"> Sofonia </option>
               <option value="HAG" > Aggeo </option>
               <option value="ZEC"> Zaccaria </option>
               <option value="MAL" > Malachia </option>
               <option value="MAT"> Matteo </option>
               <option value="MRK" > Marco </option>
               <option value="LUK"> Luca </option>
               <option value="JHN" > Giovanni </option>
               <option value="ACT"> Atti degli Apostoli </option>
               <option value="ROM" > Romani </option>
               <option value="1CO"> 1Corinzi </option>
               <option value="2CO" > 2Corinzi </option>
               <option value="GAL"> Galati </option>
               <option value="EPH" > Efesini </option>
               <option value="PHP"> Filippesi </option>
               <option value="COL" > Colossesi </option>
               <option value="1TH"> 1Tessalonicesi </option>
               <option value="2TH" > 2Tessalonicesi </option>
               <option value="1TI"> 1Timoteo </option>
               <option value="2TI" > 2Timoteo </option>
               <option value="TIT"> tito </option>
               <option value="PHM" > Filemone </option>
               <option value="HEB"> Ebrei </option>
               <option value="JAS" > Giacomo </option>
               <option value="1PE"> 1Pietro </option>
               <option value="2PE"> 2Pietro </option>
               <option value="1JN" > 1Giovanni </option>
               <option value="2JN"> 2Giovanni </option>
               <option value="3JN" > 3Giovanni </option>
               <option value="JUD"> Giuda </option>
               <option value="REV" > Apocalisse </option>
             </select>
             &nbsp; <label for="options">chap:</label>
             <select id="options">
            </select>
            <input class="submit" value='cerca' type="submit">
            </div> 
            
               
    </form>
    <section id="bible-view"  >
               
    </section>  
</main>

    <main id="comment-view">
        <form name ="post" method="post"  >
             <textarea id="comment" rows="4" cols ="50" name='comment' placeholder="quale parte della Bibbia ti ha colpito oggi?"> </textarea>
             <input type="submit" id="submitComment" value="posta">
        </form>

        <section id="posts">

        </section>
    </main>

    

    <footer>
        &copy; 2023 Il tuo sito. Tutti i diritti riservati.
    </footer>
</body>

</html>
