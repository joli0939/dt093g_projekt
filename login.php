<?php
/*********************************************
 * 
 * Skapat av Joel Lindberg (joli0939)
 * 
 ********************************************/
?>
<?php
// Inkluderar config-fil för att få åtkomst till klasser och startar session
include("includes/config.php");

// Skapar variable för meddelande samt objekt av klassen Database
$loginMessage = "";
$database = new Database();

// När användaren klickat på login-knappen kontrolleras de ifyllda uppgifterna mot databasen
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kontrollerar så att både användarnamn och lösenord är ifyllt
    if ($username != "" && $password != "") {

        // Count skickar inloggningsuppgifter till objektet database och får ett värde tillbaka
        $count = $database->checkLogin($username, $password);

        // Finns det data i det retunerade värdet loggas användaren in
        if ($count > 0) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
        } else {
            $loginMessage = "Fel användarnamn och eller lösenord";
        }
               
    } else {
        $loginMessage = "Du har glömt att fylla i användarnamn och eller lösenord";
    }
}

?>
<?php 
// Anger undersidans namn och inkluderar sidhuvud
$pageTitle = "Logga in";
include("includes/head.php");
?>

<div class="loginContainer">

    <!-- Skriver ut felmeddelanden -->
    <?php    
        echo "<p class=\"loginMessage\">" . $loginMessage . "</p>";
    ?>

    <!-- Formulär där användern fyller i användarnamn och lösenord -->
    <form method="post" action="login.php" id="login">

        <label for="username">Användarnamn:</label><br />
        <input type="text" name="username" id="username" autofocus /><br />

        <label for="password">Lösenord:</label><br />
        <input type="password" name="password" id="password" /><br />

        <input type="submit" name="login" value="Logga in" class="button" />
        
    </form>

    <a href="createuser.php" class="createUserLink">Skapa ny användare</a>

</div>

<?php
include("includes/footer.php");
?>