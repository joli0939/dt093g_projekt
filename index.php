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
$pageTitle = "Startsida";
include("includes/head.php");
$database = new Database();
?>

    

    

<div id="allUsers">
    <h5>Alla användare</h5>
    <div class="holdUsers">
        <?php

            // Hämtar en array från objektet database med alla tidigare blogginlägg
            $currentPosts = $database->getUsers();

            // Går igenom array med inlägg och skriver ut dem på skärmen
            foreach($currentPosts as $p) {
                echo "<a href=\"user.php?user=" . $p['username'] . "\">" . $p['username'] . "</a><br />";
            }

        ?>
    </div>
</div>

<h2>Senaste inlägg</h2>

<div id="widget"></div>

<!-- Läser in javascriptfil -->
<script src="js/widget.js"></script>

<?php
include("includes/footer.php");
?>