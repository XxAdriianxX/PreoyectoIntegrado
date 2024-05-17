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
            if (!$this->checkMail($mail))
                return print ("El correo ya está registrado. Por favor, usa otro correo.");
            if (!$this->checkUsername($userName))
                return print ("El nombre de usuario ya está registrado. Por favor, usa otro nombre de usuario.");
            $securePassword = password_hash($userPassword, PASSWORD_BCRYPT);
            $stmt = $this->conn->prepare('INSERT INTO Usuario (DNI, username, contrasena, puntos, mail, ubi) VALUES (?, ?, ?, 100, ?, ?)');
            $stmt->bind_param('sssss', $DNI, $userName, $securePassword, $mail, $userLocation);

            if ($stmt->execute()) {
                header("location: login.php");
            } else {
                echo "Error al registrar el usuario.";
            }

            $stmt->close();
        } else {
            return null;
        }
    }
    public function doLogin()
    {
        if (count($_POST) > 0) {
            $user = $this->getUser($_POST["mail"]);
            $_SESSION["loggedIn"] = $this->checkUser($user, $_POST["userPassword"]) ? $user["mail"] : false;
            if ($_SESSION["loggedIn"]) {
                $_SESSION["dni"] = $user["DNI"];
                $_SESSION["mail"] = $user["mail"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["ubi"] = $user["ubi"];
                $_SESSION["puntos"] = $user["puntos"];
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
            return $this->checkPassword($mail["contrasena"], $userPassword);
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

    public function checkMail($mail)
    {
        $stmt = $this->conn->prepare("SELECT * FROM Usuario WHERE mail = ?");
        $stmt->bind_param("s", $mail);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows === 0;
    }
    public function checkUsername($userName)
    {
        $stmt = $this->conn->prepare("SELECT * FROM Usuario WHERE username = ?");
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows === 0;
    }
}
