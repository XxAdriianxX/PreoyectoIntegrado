<?php
class Security extends Connection
{
    private $loginPage = "login.php";
    private $homePage = "events.php";
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function checkLoggedIn()
    {
        if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
            header("Location: " . $this->loginPage);
        }
    }

    public function doSingUp($data)
    {
        if (count($data) > 0) {
            $userName = $data["userName"];
            $userPassword = $data["userPassword"];
            $DNI = $data['dni'];
            $mail = $data['mail'];
            $userLocation = $data['userLocation'];
            $securePassword = password_hash($userPassword, PASSWORD_BCRYPT);
            $query = 'INSERT INTO Usuario (DNI, username, contrasena, contr_cifrada, puntos, mail, ubi )
          VALUES ("' . $DNI . '", "' . $userName . '", "' . $userPassword . '", "' . $securePassword . '", 100, "' . $mail . '", "' . $userLocation . '")';
            mysqli_query($this->conn, $query);


            header("location: events.php");
        } else {
            return null;
        }
    }
    public function doLogin()
    {
        if (count($_POST) > 0) {
            $mail = $this->getUser($_POST["mail"]);
            $_SESSION["loggedIn"] = $this->checkUser($mail, $_POST["password"]) ? $mail["mail"] : false;
            if ($_SESSION["loggedIn"]) {
                header("Location: " . $this->homePage);
            } else {
                return "Incorrect User Name or Password";
            }
        } else {
            return null;
        }
    }

    public function getUserData()
    {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
            return $_SESSION["loggedIn"];
        }
    }

    private function checkUser($mail, $userPassword)
    {
        if ($mail) {
            //return $this->checkPassword($mail["userPassword"], $userPassword);
            return $this->checkPassword($mail["securePassword"], $userPassword);
        } else {
            return false;
        }
    }

    private function checkPassword($securePassword, $userPassword)
    {
        return password_verify($userPassword, $securePassword);
        //return ($userPassword === $securePassword);
    }

    private function getUser($mail)
    {
        $sql = "SELECT * FROM Usuario WHERE mail = '$mail'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
}
