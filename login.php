<?php
    // Verifica che l'utente sia già loggato, in caso positivo va direttamente alla home
   require_once 'auth.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }


    if (!empty($_POST["username"]) && !empty($_POST["password"]) )
    {
        // Se username e password sono stati inviati
        // Connessione al DB
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        $username = mysqli_real_escape_string($conn, $_POST['username']); //real_escape assicura che i caratteri speciali present nella stringa isano tratti come dati letterali e non come parti di un'istruzione sql
        // ID e Username per sessione, password per controllo
        $query = "SELECT * FROM users WHERE username = '".$username."'";
        
        // Esecuzione
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        
        if (mysqli_num_rows($res) > 0) {
            // Ritorna una sola riga, il che ci basta perché l'utente autenticato è solo uno
            $entry = mysqli_fetch_assoc($res);
            
            if (password_verify($_POST['password'], $entry['password'])) {
                
              
                 $_SESSION["_eternity_username"] = $entry['username'];
                 $_SESSION["_eternity_user_id"] = $entry['id'];
                 header("Location: home.php");
                 mysqli_free_result($res);
                 mysqli_close($conn);
                 exit;
                  // Imposto una sessione dell'utente
            }
            
                
        }
        // Se l'utente non è stato trovato o la password non ha passato la verifica
        $error = "Username e/o password errati.";
        
    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
        // Se solo uno dei due è impostato
        $error = "Inserisci username e password.";
    }

?>

<!DOCTYPE html>
<html>

    <head>
        <link rel='stylesheet' href='login.css'>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Accedi - Eternity</title>
    </head>
    <body>
        <div id="logo">
        <img src="eternity.png" >
        <script>
            document.getElementById("logo").addEventListener("click", function() {
            window.location.href = "index.php";
         });
        </script>
        </div>
        <main class="login">
        <section class="main">
            <h5>Per continuare, accedi a Eternity.</h5>
            <?php
                // Verifica la presenza di errori
                if (isset($error)) {
                    echo "<p class='error'>$error</p>";
                }
                
            ?>

            <form name='login' method='post'>
                <!-- Seleziono il valore di ogni campo sulla base dei valori inviati al server via POST -->
                <div class="username">
                    <label for='username'>Username</label>
                    <input type='text' id="username" name='username' autocomplete="username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                </div>
                <div class="password">
                    <label for='password'>Password</label>
                    <input type='password' id="password" name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                </div>
                <div class="remember">
                    <input type='checkbox' id="remember" name='remember' >
                    <label for='remember'>Ricorda l'accesso</label>
                </div>
                <div class="submit-container">
                    <div class="login-btn">
                        <input href="home.php" type='submit' name="accedi" value="ACCEDI" id="accedi-btn">
                    </div>
                    
                </div>
            </form>
            <div class="signup"><h4>Non hai un account?</h4></div>
            <div class="signup-btn-container"><a class="signup-btn" href="signup.php">ISCRIVITI A ETERNITY</a></div>
        </section>
        </main>
    </body>
</html>