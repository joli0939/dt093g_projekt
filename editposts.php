<?php
/*********************************************
 * 
 * Skapat av Joel Lindberg (joli0939)
 * 
 ********************************************/
?>
<?php 
    include("includes/config.php");

    // Kontrollerar om en sessionsvariabel finns för en användare, om inte skickas man till login-skärm
    if(!isset($_SESSION['username'])) {
        header("Location: notloggedin.php");
    } else {
        $username=$_SESSION['username'];
    }
?>
<?php 
// Anger undersidans namn, inkluderar sidhuvud och skapar ett objekt av klassen Database
$pageTitle = "Mina inlägg";
include("includes/head.php");
$database = new Database();
$editMessage = "";
?>

<h2>Mina inlägg</h2>

<?php

    // Om användaren klickar på länk för specifikt inlägg hämtas id för inlägg och används för att radera posten via objektet database
    if (isset($_GET['deleteid'])) {
        $id = $_GET['deleteid'];

        // Skickar id till objektet databse och kontrollerar så att inlägg togs bort ordentligt
        if ($database->deletePost($id)) {
            $editMessage = "Inlägget borttaget";
        } else {
            $editMessage = "Fel vid borttagning";
        }
    }

    // Skriver ut meddelande
    echo "<p class=\"messageOut\">" . $editMessage . "</p>";


    // Hämtar alla tidigare poster och lägger dem i en array
    $currentPosts = $database->getUsersPosts($username);

    // Skriver ut alla tidigare poster på skärmen tillsammans med länk med varje posts id-nummer för att kunna ta bort varje post
    foreach($currentPosts as $p) {
        echo "<div class=\"blogPost\"><h4 class=\"blogHead\">" . $p['header'] . "</h4><p class=\"blogText\">" . $p['post_text'] . "</p><p class=\"blogDate\">" . $p['creationdate'] . "</p><a href=\"update.php?id=" . $p['id'] . "\" class=\"editLink\">Ändra inlägg</a><a href=\"editposts.php?deleteid=" . $p['id'] . "\" >Ta bort inlägg</a></div>";
    }

?>

<?php
include("includes/footer.php");
?>