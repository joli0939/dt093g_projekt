<?php
/*********************************************
 * 
 * Skapat av Joel Lindberg (joli0939)
 * 
 ********************************************/
?>
<nav class="mainMenu">
    <div class="dropdown">
        <span class="dropdown-span">Meny</span>
        <ul class="mainMenuUL">
            <li><a href="index.php">Start</a></li>       
            <li><a href="allposts.php">Alla inlägg</a></li>

            <?php     
            // Kontrollerar om det finns en sessionsvariabel för användare, i så fall visas ytterligare menyalternativ  
            if (isset($_SESSION['username'])) {
                echo '<li><a href="writepost.php">Nytt inlägg</a></li>';
                echo '<li><a href="editposts.php">Mina inlägg</a></li>';
                echo '<li class="loginButton"><a href="logout.php">Logga ut</a></li>';
            } else {
                echo '<li class="loginButton"><a href="login.php">Logga in</a></li>';
            }

            if (!isset($_SESSION['username'])) {
                echo '<li class="loginButton"><a href="createuser.php">Skapa användare</a></li>';
            }
            ?>
            
        </ul>
    </div>
</nav>