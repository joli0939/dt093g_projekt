<?php
/*********************************************
 * 
 * Skapat av Joel Lindberg (joli0939)
 * 
 ********************************************/
?>
<?php
include("includes/config.php");
$username = $_GET['user'];
?>
<?php 
// Anger undersidans namn, inkluderar sidhuvud och skapar ett objekt av klassen Database
$pageTitle = $username;
include("includes/head.php");
$database = new Database();
?>

<?php

    // Skriver ut användarnamnet som rubrik
    echo "<h2>" . $username . "</h2>";

    // Hämtar en array från objektet database med alla tidigare blogginlägg för den specifika användaren
    $currentPosts = $database->getUsersPosts($username);

    // Går igenom array med inlägg och skriver ut dem på skärmen
    foreach($currentPosts as $p) {
        echo "<div class=\"blogPost\"><p class=\"blogDate\">" . $p['creationdate'] . "</p><h4 class=\"blogHead\">" . $p['header'] . "</h4><p class=\"blogText\">" . $p['post_text'] . "</p><p class=\"writtenBy\">Skrivet av: </p><a href=\"user.php?user=" . $p['username'] . "\" class=\"blogUser\">" . $p['username'] . "</a></div>";
    }

?>

<?php
include("includes/footer.php");
?>