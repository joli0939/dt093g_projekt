<?php
/*********************************************
 * 
 * Skapat av Joel Lindberg (joli0939)
 * 
 ********************************************/
?>
<?php
// Klassfil för att hantera gästboksinlägg mot databas

class Database {
    // Medlemsvariabler
    private $db;
    private $username;
    private $header;
    private $post;
    private $password;
    private $firstName;
    private $lastName;

    // Konstruktor
    function __construct(){

        // Ansluter till databasen
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        if($this->db->connect_errno > 0) {
            die("Fel vid anslutning: " . $this->db->connect_error);
        }
    }



    // Hämta blogginlägg
    public function getPosts() {

        // Skickar en fråga till databasen om att få alla poster
        $sql = "SELECT * FROM blogposts ORDER BY id DESC";
        $result = $this->db->query($sql);

        // Retunerar alla poster i en associativ array
        // För nyare version av PHP
        //return mysqli_fetch_all($result, MYSQLI_ASSOC);

        // För äldre version av PHP
        $array = array();
        while($row = $result->fetch_assoc())
            $array[] = $row;
        return $array;
    }



    // Hämta blogginlägg för specifik användare
    public function getUsersPosts($username) {

        // Skickar en fråga till databasen om att få alla poster
        $sql = "SELECT * FROM blogposts WHERE username='$username' ORDER BY id DESC";
        $result = $this->db->query($sql);

        // Retunerar alla poster i en associativ array
        // För nyare version av PHP
        //return mysqli_fetch_all($result, MYSQLI_ASSOC);

        // För äldre version av PHP
        $array = array();
        while($row = $result->fetch_assoc())
            $array[] = $row;
        return $array;
    }



    // Hämta specifikt antal blogginlägg
    public function getNumberOfPosts($numrows) {
        // Får ett värde och skickar en fråga för de x antal första poster som värdet anger
        $numrows = intval($numrows);
        $sql = "SELECT * FROM blogposts ORDER BY id DESC LIMIT $numrows";
        $result = $this->db->query($sql);

        // Retunerar posterna i en associativ array
        // För nyare version av PHP
        //return mysqli_fetch_all($result, MYSQLI_ASSOC);

        // För äldre version av PHP
        $array = array();
        while($row = $result->fetch_assoc())
            $array[] = $row;
        return $array;
    }



    // Tar bort blogginlägg
    public function deletePost($id) {
        // Får ett värde som är id för den post som ska tas bort, fråga skickas till databasen med att ta bort post med det angivna id, retunerar true eller false
        $id = intval($id);
        $sql = "DELETE FROM blogposts WHERE id='$id'";
        return $this->db->query($sql);
    }



    // Lägger till ny post
    public function addPost($username, $header, $post) {

        // Kontrollerar så att användarnamn och inlägg är godkända enligt setmetoder
        if(!$this->setUsername($username)) {return false;}
        if(!$this->setHeader($header)) {return false;}
        if(!$this->setPost($post)) {return false;}

        // Skickar fråga till databasen med användarnamn och inlägg för att lägga till som post i tabellen, id och datum fylls i automatiskt av databasen, retunerar true eller false
        $sql = "INSERT INTO blogposts(username, header, post_text) VALUES('" . $this->username . "', '" . $this->header . "', '" . $this->post . "');";
        return $result = $this->db->query($sql);
    }



    // Uppdatera en post
    public function updatePost($id, $username, $header, $post) {

        // Kontrollerar användarnamn och inlägg mot setmetoder
        $id = intval($id);
        if (!$this->setUsername($username)) {return false;}
        if(!$this->setHeader($header)) {return false;}
        if (!$this->setPost($post)) {return false;}

        // Skapar fråga om att ändra värdet för rad i tabell med det angivna id
        $sql = "UPDATE blogposts SET username='" . $this->username . "', header='" . $this->header . "',  post_text='" . $this->post . "' WHERE id = $id";

        // Retunerar true eller false
        return $this->db->query($sql);
    }



    // Hämta specifik post
    public function getSpecificPost($id) {
        $id = intval($id);
        // Skapar fråga för att hämta rad där id är det id som skickats till metoden
        $sql = "SELECT * FROM blogposts WHERE id='$id'";
        $result = $this->db->query($sql);
        // Den första raden från resultatet lagras och retuneras
        $row = mysqli_fetch_array($result);
        return $row;

    }



    // Kontrollerar om en användare existerar
    public function checkIfUserExists($username) {

        // Skickar fråga till databasen med ifyllt användarnamn för att se om det existerar, retunerar true eller false
        $sql = "SELECT * FROM users WHERE username='$username';";
        $result = $this->db->query($sql);

        if (mysqli_num_rows($result)>0) {
            return false;
        } else {
            return true;
        }
    }



    // Skapar ny användare
    public function createUser($username, $password, $firstName, $lastName) {
       
        // Kontrollerar användarnamn och lösenord mot setmetoder
        if (!$this->setUsername($username)) {return false;}
        if (!$this->setPassword($password)) {return false;}
        if (!$this->setFirstName($firstName)) {return false;}
        if (!$this->setLastname($lastName)) {return false;}

        // Skapar fråga som lägger till den nya användaren i databasen
        $sql = "INSERT INTO users (username, password, first_name, last_name) VALUES ('" . $this->username . "', '" . $this->password . "', '" . $this->firstName . "', '" . $this->lastName . "');";
        return $this->db->query($sql);
    }



    // Hämta användarnamn och lösenord
    public function checkLogin($username, $password) {

        // Skickar fråga till databasen med ifyllt användarnamn och lösenord, frågan för lösenord är BINARY för att skilja på stora och små bokstäver, resultatet retuneras
        $sql = "SELECT id FROM users WHERE username='$username' and password = BINARY '$password'";
        $result = $this->db->query($sql);

        return mysqli_num_rows($result);
    }



    public function getUsers() {
        // Skickar en fråga till databasen om att få alla poster
        $sql = "SELECT * FROM users ORDER BY username";
        $result = $this->db->query($sql);

        // Retunerar alla poster i en associativ array
        // För nyare version av PHP
        //return mysqli_fetch_all($result, MYSQLI_ASSOC);

        // För äldre version av PHP
        $array = array();
        while($row = $result->fetch_assoc())
            $array[] = $row;
        return $array;
    }



    // Set- och getmetoder
    public function setUsername($username) {
        
        // Kontrollerar så att användarnamnet inte är en tom sträng samt korrigerar tecken för att kunna lagras i databasen utan problem, retunerar true eller false
        if($username != "") {
            $this->username = $this->db->real_escape_string($username);
            return true;
        } else {
            return false;
        }
    }

    public function setHeader($header) {
        
        // Kontrollerar så att rubriken inte är en tom sträng samt korrigerar tecken för att kunna lagras i databasen utan problem, retunerar true eller false
        if($header != "") {
            $this->header = $this->db->real_escape_string($header);
            return true;
        } else {
            return false;
        }
    }

    public function setPost($post) {

        // Kontrollerar så att posten inte är en tom sträng samt korrigerar tecken för att kunna lagras i databasen utan problem, retunerar true eller false
        if($post != "") {
            $this->post = $this->db->real_escape_string($post);
            return true;
        } else {
            return false;
        }
    }

    public function setPassword($password) {

        $password = strval($password);
        // Kontrollerar att lösenordet är minst 6 tecken långt
        if (strlen($password)>5) {
            $this->password = $this->db->real_escape_string($password);
            return true;
        } else {
            return false;
        }
    }

    public function setFirstName($firstName) {
        
        // Kontrollerar så att användarnamnet inte är en tom sträng samt korrigerar tecken för att kunna lagras i databasen utan problem, retunerar true eller false
        if($firstName != "") {
            $this->firstName = $this->db->real_escape_string($firstName);
            return true;
        } else {
            return false;
        }
    }

    public function setLastName($lastName) {
        
        // Kontrollerar så att användarnamnet inte är en tom sträng samt korrigerar tecken för att kunna lagras i databasen utan problem, retunerar true eller false
        if($lastName != "") {
            $this->lastName = $this->db->real_escape_string($lastName);
            return true;
        } else {
            return false;
        }
    }

}



?>