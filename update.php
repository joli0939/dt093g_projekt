<?php
/*********************************************
 * 
 * Skapat av Joel Lindberg (joli0939)
 * 
 ********************************************/
?>
<?php
    include("includes/config.php");
    // Kontrollerar så att ett id är valt, ger isf variabel id det värdet, annars skickas användaren till startsidan
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header("Location: notloggedin.php");
    }
?>
<?php 
// Anger undersidans namn, inkluderar sidhuvud och skapar ett objekt av klassen Database
$pageTitle = "Ändra inlägg";
include("includes/head.php");
$database = new Database();
$updateMessage = "";
?>
<?php
    // Anropar metoden updatePost när användaren trycker på knappen för att ändra och skickar med det inmatade värdena
    if (isset($_POST['submitUpdate'])) {
        $username = $_SESSION['username'];
        $header = $_POST['updateHeader'];
        $post = $_POST['updatePost'];

        if ($database->updatePost($id, $username, $header, $post)) {
            $updateMessage = "Inlägg uppdaterat";
        } else {
            $updateMessage = "Fel vid ändring";
        }
    }

    // Begär den post med id för den post användaren valt att ändra, variabel för användarnamn och post skapas från svaret
    $updatePost = $database->getSpecificPost($id);
    $currentHeader = $updatePost['header'];
    $currentPost = $updatePost['post_text'];

?>

<h2>Ändra inlägg</h2>

<!-- Skriver ut meddelande -->
<?php    
    echo "<p class=\"messageOut\">" . $updateMessage . "</p>";
?>

<!-- Formulär för att fylla i ändringar i post -->
<form method="post" id="updateForm">

    <label for="updateHeader">Ändra rubrik:</label><br />
    <input type="text" name="updateHeader" id="updateHeader" value="<?= $currentHeader; ?>" /><br />

    <label for="updatePost">Ändra meddelande:</label><br />
    <textarea name="updatePost" id="updatePost"><?= $currentPost; ?></textarea><br />

    <input type="submit" name="submitUpdate" value="Uppdatera" class="button" />
</form>

<a href="editposts.php" class="returnLink">Tillbaka</a>


<?php
include("includes/footer.php");
?>