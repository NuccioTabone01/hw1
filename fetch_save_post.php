
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
        echo $stmt;
    } else {
    // Errore durante l'inserimento
    echo "Si è verificato un errore durante il salvataggio del post.";
    }   
}
// Chiusura delle risorse
mysqli_close($conn);
?>
