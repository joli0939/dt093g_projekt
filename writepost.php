<?php
/*********************************************
 * 
 * Skapat av Joel Lindberg (joli0939)
 * 
 ********************************************/
?>
<?php include("includes/config.php"); ?>
<?php
    // Kontrollerar om en sessionsvariabel finns för en användare, om inte skickas man till login-skärm
    if(!isset($_SESSION['username'])) {
        header("Location: notloggedin.php");
    }
?>
<?php 
// Anger undersidans namn, inkluderar sidhuvud och skapar ett objekt av klassen Database
$pageTitle = "Nytt inlägg";
include("includes/head.php");
$database = new Database();
$writeMessage = "";
?>

<h2>Nytt inlägg</h2>

<?php
    // Använder objektet database för att lägga till ny post när användaren klickar på Skicka-knappen
    if(isset($_POST['addPost'])) {

        // Deklararer variabler med användarnamn, rubrik och text
        $username = $_SESSION['username'];
        $header = $_POST['addHeader'];
        $post = $_POST['blogPost'];

        // Skickar med användarnamn och inlägg, kontrollerar så att inlägget postades korrekt och skriver ut meddelande
        if($database->addPost($username, $header, $post)) {
            $writeMessage = "Inlägg publicerat!";
        } else {
            $writeMessage = "Fel vid publicering av inlägg (har du fyllt i alla fält?)";
        }
    }
?>

<!-- Skriver ut meddelande -->
<?php    
    echo "<p class=\"messageOut\">" . $writeMessage . "</p>";
?>

<!-- Formulär där användern fyller i namn och meddelande -->
<form method="post" action="writepost.php" id="writePost">
    
    <p>Skriv nytt inlägg</p>

    <label for="addHeader">Rubrik:</label><br />
    <input type="text" name="addHeader" id="addHeader" autofocus/><br />

    <label for="blogPost">Inlägg:</label><br />
    <textarea name="blogPost" id="blogPost"></textarea><br />

    <input type="submit" name="addPost" value="Publicera" class="button" />
    
</form>

<?php
include("includes/footer.php");
?>