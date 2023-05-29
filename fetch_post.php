<?php
require_once 'auth.php';
if (!$userid = checkAuth()) exit;

header("Content-Type: application/json");

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

$userid = mysqli_real_escape_string($conn, $userid);

$query = "SELECT users.id AS userid, users.name AS name, users.surname as surname,
    users.username as username, posts.id as postid, 
    posts.commentText as content, posts.time as time, 
    posts.nlikes as nlikes,
    FROM posts JOIN users ON posts.user_id = users.id
    ORDER BY postid DESC LIMIT 10";

$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

$postsArray = array();
while ($entry = mysqli_fetch_assoc($res)) {
    $time = getTime($entry['time']);
    $postsArray[] = array(
        'userid' => $entry['userid'],
        'name' => $entry['firstName'],
        'surname' => $entry['lastName'],
        'username' => $entry['username'],
        'postid' => $entry['id'],
        'content' => json_decode($entry['commentText']),
        'nlikes' => $entry['nlikes'],
        'time' => $time
    );
}

echo json_encode($postsArray);
exit;
?>
