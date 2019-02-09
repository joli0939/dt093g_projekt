<?php
/*********************************************
 * 
 * Skapat av Joel Lindberg (joli0939)
 * 
 ********************************************/
?>
<?php include("includes/config.php") ?>
<?php 
// Anger undersidans namn, inkluderar sidhuvud och skapar ett objekt av klassen Database
$pageTitle = "Skapa ny användare";
include("includes/head.php");
$database = new Database();
?>

<h2>Skapa ny användare</h2>

<?php

    // Kollar om knappen för att skapa användare trycks på eller om användaren trycker 'enter' i sista textfältet
    if (isset($_POST['createUser']) or isset($_POST['repeatPassword'])) {

        // Skapar variabler av det användaren fyllt i
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeatPassword'];

        // Kontrollerar så att samma lösenord fyllts i för båda lösenordsfält
        if ($repeatPassword === $password) {

            // Kollar mot metod i objektet database om användarnamnet redan används
            if ($database->checkIfUserExists($username)) {
            
                // Skickar de värden användaren angett till metod i objektet database för att de ska lagras i databasen
                if ($database->createUser($username, $password, $firstName, $lastName)) {
                    echo "<p class=\"createMessage\">Användare skapad. <br />Klicka <a href=\"login.php\">här</a> för att logga in.</p>";
                } else {
                    echo "<p class=\"createMessage\">Fel vid skapande av användare</p>";
                }
            
            } else {
                echo "<p  class=\"createMessage\">Det finns redan en användare med det användarnamnet.</p>";
            }
        } else {
            echo "<p class=\"createMessage\">De angivna lösenorden är inte samma</p>";
        }
    }

?>

<div class="createUserContainer">

    <!-- Formulär för att fylla i önskat användarnamn, lösenord, förnamn och efternamn -->
    <form method="post" action="createuser.php" id="login">

        <label for="firstName" class="createUserLabel">Förnamn:</label><br />
        <input type="text" name="firstName" id="firstName" class="createUserTxt" autofocus /><br />

        <label for="lastName" class="createUserLabel">Efternamn:</label><br />
        <input type="text" name="lastName" id="lastName" class="createUserTxt" /><br />

        <label for="username" class="createUserLabel">Användarnamn:</label><br />
        <input type="text" name="username" id="username" class="createUserTxt" /><br />

        <label for="password" class="createUserLabel">Lösenord:</label><br />
        <input type="password" name="password" id="password" class="createUserTxt" /><br />

        <label for="repeatPassword" class="createUserLabel">Upprepa lösenord:</label><br />
        <input type="password" name="repeatPassword" id="repeatPassword" class="createUserTxt" /><br />

        <input type="submit" name="createUser" value="Skapa användare" class="button" />
        
    </form>

</div>

<?php
include("includes/footer.php");
?>