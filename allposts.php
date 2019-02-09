<?php
/*********************************************
 * 
 * Skapat av Joel Lindberg (joli0939)
 * 
 ********************************************/
?>
<?php include("includes/config.php"); ?>
<?php 
// Anger undersidans namn, inkluderar sidhuvud och skapar ett objekt av klassen Database
$pageTitle = "Alla poster";
include("includes/head.php");
$database = new Database();
?>

<h2>Alla inlägg</h2>

<!-- Div där alla blogginlägg visas -->
<div id="showPosts">

    <?php

        // Hämtar en array från objektet database med alla tidigare blogginlägg
        $currentPosts = $database->getPosts();

        // Går igenom array med inlägg och skriver ut dem på skärmen
        foreach($currentPosts as $p) {
            echo "<div class=\"blogPost\"><p class=\"blogDate\">" . $p['creationdate'] . "</p><h4 class=\"blogHead\">" . $p['header'] . "</h4><p class=\"blogText\">" . $p['post_text'] . "</p><p class=\"writtenBy\">Skrivet av: </p><a href=\"user.php?user=" . $p['username'] . "\" class=\"blogUser\">" . $p['username'] . "</a></div>";
        }

    ?>


</div>

<?php
include("includes/footer.php");
?>