<?php
/*********************************************
 * 
 * Skapat av Joel Lindberg (joli0939)
 * 
 ********************************************/
?>
<?php include("includes/config.php"); ?>
<?php 
// Anger undersidans namn och inkluderar sidhuvud
$pageTitle = "Inte inloggad";
include("includes/head.php");
?>

<!-- Meddelande till användare som kommit till sida som man måste vara inloggad för att se -->
<h3>För att se den här sidan måste du vara inloggad, för att logga in klicka <a href="login.php">här</a></h3>


<?php
include("includes/footer.php");
?>