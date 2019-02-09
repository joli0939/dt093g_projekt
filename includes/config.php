<?php
/*********************************************
 * 
 * Skapat av Joel Lindberg (joli0939)
 * 
 ********************************************/
?>
<?php
    // Enable error reporting
    error_reporting(-1);              // Report all type of errors
    ini_set("display_errors", 1);     // Display all errors 

    // Activate autoload to speed up registering of classes needed
    spl_autoload_register(function ($class) {
        include 'classes/' . $class . '.class.php';
    });

    session_start();
    
    $titleSite = "Min webbplats";
    $divide = " | ";

    // Information för anslutning till databas
    define("DBHOST", "studentmysql.miun.se");
    define("DBUSER", "joli0939");
    define("DBPASS", "EM2DjlRQwIByzU5L");
    define("DBNAME", "joli0939");