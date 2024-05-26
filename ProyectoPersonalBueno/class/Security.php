<?php
class Security extends Connection
{
    private $loginPage = "login.php";
    private $homePage = "indexPubli.php";
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function checkLoggedIn()
    {
        if (!isset($_SESSION["mail"]) || !$_SESSION["mail"]) {
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

    public function getUser($mail)
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

    public function changePassword($password)
    {
        if (isset($_SESSION["mail"])) {
            $correo = $_SESSION["mail"];
            $contraseña_hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->conn->prepare("UPDATE Usuario SET contrasena = ? WHERE mail = ?");
            $stmt->bind_param("ss", $contraseña_hash, $correo);

            if ($stmt->execute()) {
                echo "Contraseña Actualizada";
            } else {
                echo "Error al conectar con la base de datos: " . $this->conn->error;
            }

            $stmt->close();
        } else {
            echo "Usuario no autenticado.";
        }
    }

    public function changeInfo($data)
{
    if (count($data) > 0) {
        $name = $data["username"];
        $mail = $data["email"];
        $ubi = $data["ubi"];

       
        $_SESSION['username'] = $name;
        $_SESSION['mail'] = $mail;
        $_SESSION['ubi'] = $ubi;

        $dni = $_SESSION['dni'];
        $query = "SELECT img FROM Usuario WHERE DNI = ?";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("Error en el statement: " . $this->conn->error);
        }
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $currentImagePath = $row['img'];
        $stmt->close();

        $targetDir = "Assets/img/profile/";
        $imagePath = $currentImagePath; 

        
        if (!empty($_FILES["imageFile"]["name"])) {
            $targetFile = $targetDir . basename($_FILES["imageFile"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["imageFile"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "El archivo no es una imagen.";
                $uploadOk = 0;
            }
            if ($_FILES["imageFile"]["size"] > 5000000) {
                echo "Lo siento, tu archivo es demasiado grande.";
                $uploadOk = 0;
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                echo "Lo siento, tu archivo no fue subido.";
                return;
            } else {
                if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $targetFile)) {
                    $imagePath = $targetFile;
                } else {
                    echo "Lo siento, hubo un error al subir tu archivo.";
                    return;
                }
            }
        }

        
        $query = "UPDATE Usuario SET username = ?, mail = ?, ubi = ?, img = ? WHERE DNI = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            die("Error en el statement: " . $this->conn->error);
        }

        $stmt->bind_param("sssss", $name, $mail, $ubi, $imagePath, $dni);

        if ($stmt->execute()) {
            header("Location: profile.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}


    public function getImage($mail){
        $sql = "SELECT img FROM Usuario WHERE mail = '$mail'";
        $result = $this->conn->query($sql);
        foreach ($result->fetch_assoc() as $line){
        }
        return $line;
    }
}
