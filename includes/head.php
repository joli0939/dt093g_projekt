<?php
/*********************************************
 * 
 * Skapat av Joel Lindberg (joli0939)
 * 
 ********************************************/
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Titel med variabler för olika sidor -->
    <title><?= $titleSite . $divide . $pageTitle; ?></title>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Chivo:700,900" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="css/styles.css" type="text/css" />    
</head>
<body>

    <header id="pageHeader">
        <h1>Vinbloggen</h1>

        <?php include("menu.php"); ?>
        
        <!-- Skriver ut vilken användare som är inloggad -->
        <?php if(isset($_SESSION['username'])){echo '<p class="loggedInAs">Inloggad som: ' . $_SESSION['username'];} ?>

    </header>

    <div id="container">