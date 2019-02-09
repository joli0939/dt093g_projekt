<?php
/*********************************************
 * 
 * Skapat av Joel Lindberg (joli0939)
 * 
 ********************************************/
?>
<?php
    // Inkluderar config för att komma åt klasser
    include("includes/config.php");

    // Skapar nytt objekt av klassen Database samt variabel med maxvärde
    $database = new Database();
    $numrows = 999;

    // Kontrollerar om numrows står med i adressfältet och i så fall vilket värde som angetts
    if(isset($_GET['numrows'])) {
        // Om specifikt värde angetts skickas det med till objektet och det antalet poster retuneras och lagras i JSON-format
        $numrows = $_GET['numrows'];
        $posts = $database->getNumberOfPosts($numrows);
        $json = json_encode($posts, JSON_PRETTY_PRINT);
    } else {
        // Om inget värde angetts retuneras alla poster och lagras i JSON-format
        $posts = $database->getPosts();
        $json = json_encode($posts, JSON_PRETTY_PRINT);
    }

    // Anger att det är en JSON-fil samt tillåter åtkomst från andra källor
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");

    // Skriver ut innehåll i JSON-fil
    echo $json;
?>