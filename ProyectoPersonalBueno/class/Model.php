<?php
class Model extends Connection
{
    public function getAllEvents()
    {
        $query = 'SELECT * From Evento order by estado desc';
        $result = mysqli_query($this->conn, $query);
        $events = [];
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
        $result->close();
        $newEvents = [];
        foreach ($events as $event) {
            $object = new Event($event['nombre'], $event['fecha_hora'], $event['ubi'], $event['descripcion'], $event['estado'], $event['DNI_usuario'], $event['puntos_asociados'], $event['imagen']);
            $newEvents[] = $object;
        }
        return $newEvents;
    }

    public function drawEventsList()
    {
        $events = $this->getAllEvents();
        $table = '';
        foreach ($events as $event) {
            $table .= '<div class="col-lg-6 col-md-6">';
            if ($event->active == '1') {
                $table .= '<div class="card text-center mb-5">';
            } else {
                $table .= '<div class="card bg-dark text-center mb-5">';
            }
            $table .= '<div class="card-body">';
            $table .= '<h5 class="card-title"><strong>' . $event->name . '</strong></h5>';
            $table .= '<div class="row justify-content-center mb-2">';
            $table .= '<div class="col-auto">';
            $table .= '<span class="badge rounded-pill bg-success">Fecha y hora: ' . $event->date . '</span>';
            $table .= '</div>';
            $table .= '<div class="col-auto">';
            $table .= '<span class="badge rounded-pill bg-secondary">Puntos: ' . $event->points . '</span>';
            $table .= '</div>';
            $table .= '</div>';
            $table .= '<p class="card-text">Descripción: ' . $event->description . '</p>';
            $table .= '<p class="card-text">Ubicación: ' . $event->location . '</p>';
            $isAttending = $this->verifyAttendance($event->name, $event->date);
            if ($event->active == '1') {
                if ($isAttending) {
                    $table .= '<a href="notGoEvent.php?eventName=' . $event->name . '&eventDate=' . $event->date . '" class="btn border border-dark text-white bg-success">Desapuntarse</a>';
                } else {
                    $table .= '<a href="goEvent.php?eventName=' . $event->name . '&eventDate=' . $event->date . '" class="btn border border-dark text-white bg-success">Apuntarse</a>';
                }
            } else {
                $table .= '<a href="#" class="btn custom-button border border-dark disabled">Apuntarse</a>';
            }
            $table .= '</div>';
            $table .= '<img src="' . $event->picture . '" class="card-img-bottom rounded-3" alt="...">';
            $table .= '</div>';
            $table .= '</div>';
        }
        return $table;
    }

    public function getUserEvents()
    {
        $dni = $_SESSION['dni'];
        $query = "SELECT nombre_evento, fecha_hora_evento  from Asiste where dni_usuario = '$dni' ";
        $result = mysqli_query($this->conn, $query);
        $events = [];
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
        $result->close();
        $newEvents = [];
        foreach ($events as $event) {
            $object = new Event($event['nombre_evento'], $event['fecha_hora_evento'], null, null, null, $dni, null, null);
            $newEvents[] = $object;
        }
        return $newEvents;
    }

    public function getCreatedEvents()
    {
        $dni = $_SESSION['dni'];
        $query = "SELECT * From Evento where DNI_usuario = '$dni' order by estado desc";
        $result = mysqli_query($this->conn, $query);
        $events = [];
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
        $result->close();
        $newEvents = [];
        foreach ($events as $event) {
            $object = new Event($event['nombre'], $event['fecha_hora'], $event['ubi'], $event['descripcion'], $event['estado'], $event['DNI_usuario'], $event['puntos_asociados'], $event['imagen']);
            $newEvents[] = $object;
        }
        return $newEvents;
    }

    public function drawUserEventsBig()
    {
        $events = $this->getCreatedEvents();
        $table = '';
        foreach ($events as $event) {
            $table .= '<div class="col-lg-6 col-md-6">';
            if ($event->active == '1') {
                $table .= '<div class="card text-center mb-5">';
            } else {
                $table .= '<div class="card bg-dark text-center mb-5">';
            }
            $table .= '<div class="card-body">';
            $table .= '<h5 class="card-title"><strong>' . $event->name . '</strong></h5>';
            $table .= '<div class="row justify-content-center mb-2">';
            $table .= '<div class="col-auto">';
            $table .= '<span class="badge rounded-pill bg-success">Fecha y hora: ' . $event->date . '</span>';
            $table .= '</div>';
            $table .= '<div class="col-auto">';
            $table .= '<span class="badge rounded-pill bg-secondary">Puntos: ' . $event->points . '</span>';
            $table .= '</div>';
            $table .= '</div>';
            $table .= '<p class="card-text">Descripción: ' . $event->description . '</p>';
            $table .= '<p class="card-text">Ubicación: ' . $event->location . '</p>';
            $table .= '<a href="deleteEvent.php?eventName=' . $event->name . '&eventDate=' . $event->date . '" class="btn custom-button border border-dark mb-3">Eliminar evento</a><br>';
            $table .= '<a href="updateEvent.php?eventName=' . $event->name . '&eventDate=' . $event->date . '" class="btn custom-button border border-dark">Editar</a>';
            $table .= '</div>';
            $table .= '<img src="' . $event->picture . '" class="card-img-bottom rounded-3" alt="...">';
            $table .= '</div>';
            $table .= '</div>';
        }
        return $table;
    }

    public function drawUserEventsSmall()
    {
        $dni = $_SESSION['dni'];
        $events = $this->getUserEvents();
        $table = '';
        foreach ($events as $event) {
            $table .= '<span class="custom-span badge rounded-pill border border-dark flex-grow-1 text-dark mb-2 d-flex justify-content-center">' . $event->name . '</span>';
        }
        return $table;
    }

    public function addEvent($data)
    {
        $curdate = new DateTime();
        $date = $data["date"];
        $dateFormat = DateTime::createFromFormat('Y-m-d\TH:i', $date);
        if (!$dateFormat) {
            echo "Formato de fecha inválido.";
            return;
        }
        $dateFormatStr = $dateFormat->format('Y-m-d H:i:s');
        $dni = $_SESSION['dni'];
        $active = ($dateFormat > $curdate) ? 1 : 0;
        $eventName = $data["eventName"];
        $location = $data["location"];
        $points = $data['points'];
        $description = $data['description'];
        $targetDir = "Assets/event_picture/";
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
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
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
        $stmt = $this->conn->prepare('INSERT INTO Evento (nombre, fecha_hora, ubi, estado, DNI_usuario, puntos_asociados, descripcion, imagen) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('sssssiss', $eventName, $dateFormatStr, $location, $active, $dni, $points, $description, $imagePath);

        if (!$stmt->execute()) {
            echo "Error al añadir el evento.";
        } else {
            header("location: events.php");
        }
    }

    public function deleteEvent($eventName, $eventDate)
    {
        $dni = $_SESSION['dni'];

        $stmt = $this->conn->prepare('DELETE FROM Asiste WHERE nombre_evento = ? AND fecha_hora_evento = ?');
        $stmt->bind_param('ss', $eventName, $eventDate);

        if ($stmt->execute()) {
            $stmt->close();

            $stmt2 = $this->conn->prepare('DELETE FROM Evento WHERE nombre = ? AND fecha_hora = ? AND DNI_usuario = ?');
            $stmt2->bind_param('sss', $eventName, $eventDate, $dni);

            if ($stmt2->execute()) {
                $stmt2->close();
                header("location: userEvents.php");
            } else {
                echo "Error al eliminar el evento.";
            }
        } else {
            echo "Error al eliminar amigo.";
        }
    }

    public function updateEvent()
    {

    }
    public function getAllFriends()
    {
        $dni = $_SESSION['dni'];
        $stmt = $this->conn->prepare('SELECT u.*
        FROM Usuario u
        INNER JOIN Amigos a ON u.DNI = a.DNI_amigo
        WHERE a.DNI_usuario = ?');
        $stmt->bind_param('s', $dni);
        $stmt->execute();
        $result = $stmt->get_result();
        $friends = [];

        while ($row = $result->fetch_assoc()) {
            $friends[] = $row;
        }
        $stmt->close();
        return $friends;
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function drawFriends()
{
    $friends = $this->getAllFriends();
    $card = '<div class="card">';
    $card .= '<div class="card-body">';
    $card .= '<h5 class="card-title">Amigos</h5>';
    for ($i = 0; $i < count($friends); $i++) {
        $card .= '<span class="custom-span badge rounded-pill border border-dark flex-grow-1 text-dark mb-2 d-flex justify-content-center">' . $friends[$i]['username'] . '</span>';
    }
    $card .= '</div>'; 
    $card .= '</div>'; 
    return $card;
}


    public function cardFriends()
    {
        $friends = $this->getAllFriends();
        $table = '';
        foreach ($friends as $friend) {
            $table .= '<div class="col-lg-6 col-md-6 mb-4">';
            $table .= '<div class="card text-center">';
            $table .= '<div class="card-body">';
            $table .= '<h5 class="card-title"><strong>' . $friend['username'] . '</strong></h5>';
            $table .= '<p class="card-text">Ubicación: <span class="badge rounded-pill bg-success">' . $friend['ubi'] . '</span></p>';
            $table .= '<div class="row justify-content-center mb-2">';
            $table .= '<div class="col-auto">';
            $table .= '<span class="badge rounded-pill bg-secondary">Puntos: ' . $friend['puntos'] . '</span>';
            $table .= '</div>';
            $table .= '</div>';
            $table .= '<a href="deleteFriend.php?dniFriend=' . $friend['DNI'] . '" class="btn custom-button border border-dark">Eliminar amigo</a>';
            $table .= '</div>';
            $table .= '</div>';
            $table .= '</div>';
        }
        return $table;
    }

    public function deleteFriend($dniFriend)
    {
        $dni = $_SESSION['dni'];
        $stmt = $this->conn->prepare('DELETE FROM Amigos WHERE DNI_usuario= ? AND DNI_amigo = ?');
        $stmt->bind_param('ss', $dni, $dniFriend);
        if ($stmt->execute()) {
            header("location: events.php");
        } else {
            echo "Error al eliminar amigo.";
        }

        $stmt->close();
    }

    public function goEvent($eventName, $eventDate)
    {
        $dni = $_SESSION['dni'];
        $stmt = $this->conn->prepare('INSERT INTO Asiste (DNI_usuario, nombre_evento, fecha_hora_evento) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $dni, $eventName, $eventDate);
        if ($stmt->execute()) {
            $stmt->close();
            $subquery = $this->conn->prepare('SELECT puntos_asociados FROM Evento WHERE nombre = ? AND fecha_hora = ?');
            $subquery->bind_param('ss', $eventName, $eventDate);
            $subquery->execute();
            $result = $subquery->get_result();
            if ($result->num_rows > 0) {
                $points = $result->fetch_assoc()['puntos_asociados'];
                $subquery->close();
                $updateStmt = $this->conn->prepare('UPDATE Usuario SET puntos = puntos + ? WHERE DNI = ?');
                $updateStmt->bind_param('is', $points, $dni);
                if ($updateStmt->execute()) {
                    header("location: events.php");
                } else {
                    echo "Error al actualizar puntos del usuario.";
                }
                $updateStmt->close();
            } else {
                $subquery->close();
                echo "Error al obtener puntos asociados al evento.";
            }
        } else {
            echo "Error al apuntarse.";
        }
    }

    public function verifyAttendance($eventName, $eventDate)
    {
        $dni = $_SESSION['dni'];
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS asistente FROM Asiste WHERE nombre_evento = ? AND fecha_hora_evento = ? AND DNI_usuario = ?");
        $stmt->bind_param("sss", $eventName, $eventDate, $dni);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['asistente'];
        $stmt->close();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function showProfile()
    {

        $form = "";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>Nombre de usuario:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $_SESSION['username'] . "</span>";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>E-mail:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $_SESSION['mail'] . "</span>";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>DNI:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $_SESSION['dni'] . "</span>";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>Ubicación:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $_SESSION['ubi'] . "</span>";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>Puntos:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $_SESSION['puntos'] . "</span>";
        return $form;
    }

    public function notGoEvent($eventName, $eventDate)
    {
        $dni = $_SESSION['dni'];
        $stmt = $this->conn->prepare('DELETE FROM Asiste WHERE DNI_usuario = ? AND nombre_evento = ? AND fecha_hora_evento = ?');
        $stmt->bind_param('sss', $dni, $eventName, $eventDate);
        if ($stmt->execute()) {
            $stmt->close();

            $subquery = $this->conn->prepare('SELECT puntos_asociados FROM Evento WHERE nombre = ? AND fecha_hora = ?');
            $subquery->bind_param('ss', $eventName, $eventDate);
            $subquery->execute();
            $result = $subquery->get_result();
            if ($result->num_rows > 0) {
                $points = $result->fetch_assoc()['puntos_asociados'];
                $subquery->close();

                $updateStmt = $this->conn->prepare('UPDATE Usuario SET puntos = puntos - ? WHERE DNI = ?');
                $updateStmt->bind_param('is', $points, $dni);
                if ($updateStmt->execute()) {
                    header("location: events.php");
                } else {
                    echo "Error al actualizar puntos del usuario.";
                }
                $updateStmt->close();
            } else {
                $subquery->close();
                echo "Error al obtener puntos asociados al evento.";
            }
        } else {
            echo "Error al desapuntarse.";
        }
    }


    public function logrosUsuario()
    {
        $dni = $_SESSION['dni'];
        $query = "SELECT puntos FROM Usuario WHERE DNI = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $puntos = $row['puntos'];

            $goalQuery = "SELECT nombre, imagen FROM Logros WHERE puntos_necesarios <= ?";
            $stmt = $this->conn->prepare($goalQuery);
            $stmt->bind_param("i", $puntos);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                $logros = [];
                while ($fila = $resultado->fetch_assoc()) {
                    $logros[] = [
                        'nombre' => $fila['nombre'],
                        'imagen' => $fila['imagen']
                    ];
                }
                $_SESSION['logros'] = $logros;
            }
        }

        $stmt->close();
    }

    public function numGoals()
    {
        $points = $this->getPoints();
        switch (true) {
            case $points < 200:
                return 0;
            case $points >= 200 && $points < 300:
                return 1;
            case $points >= 300 && $points < 400:
                return 2;
            case $points >= 400 && $points < 500:
                return 3;
            case $points >= 500 && $points < 600:
                return 4;
            case $points >= 600 && $points < 700:
                return 5;
            case $points >= 700 && $points < 800:
                return 6;
            case $points >= 800 && $points < 900:
                return 7;
            case $points >= 900 && $points < 1000:
                return 8;
            default:
                return 9;
        }
    }

    public function getAllGoals()
    {
        $query = "SELECT nombre FROM Logros";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $goals = [];
        while ($row = $result->fetch_assoc()) {
            $goals[] = $row['nombre'];
        }
        $stmt->close();
    }

    private function getUserGoals()
    {
        $points = $this->getPoints();
        $query = "SELECT nombre, imagen FROM Logros WHERE puntos_necesarios <= ? ORDER BY puntos_necesarios ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $points);
        $stmt->execute();
        $result = $stmt->get_result();
        $goals = array();

        while ($row = $result->fetch_assoc()) {
            $goals[] = [
                'nombre' => $row['nombre'],
                'imagen' => $row['imagen'],
            ];
        }
        $stmt->close();
        return $goals;
    }

    public function drawGoals()
    {
        $goals = $this->getUserGoals();
        $html = '';
        foreach ($goals as $goal) {
            $html .= '<div class="col-md-4 text-center">';
            $html .= '<div class="card">';
            $html .= '<img src="' . $goal['imagen'] . '" class="card-img-top" alt="' . $goal['nombre'] . '">';
            $html .= '<div class="card-body">';
            $html .= '<h5 class="card-title">' . $goal['nombre'] . '</h5>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }
        return $html;
    }

    public function getPoints()
    {
        $dni = $_SESSION['dni'];
        $query = "SELECT puntos FROM Usuario WHERE DNI = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $dni);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc()['puntos'];
        return $result;
    }

    public function drawPoints()
    {
        $points = $this->getPoints();
        $button = '<div class="btn mb-3 border border-dark bg-light" id="toggle-button" onclick="toggleSaldo()"><i id="toggle-icon" class="fas fa-eye"></i></div>';
        $card = '<div class="card" id="saldo">';
        $card .= '<div class="card-body d-flex justify-content-between">';
        $card .= '<h5 class="card-title">Puntos:</h5>';
        $card .= ''; 
        $card .= '</div>'; 
        $card .= '<span class="custom-span badge rounded-pill border border-dark flex-grow-1 text-dark mb-2 d-flex justify-content-center">' . $points . '</span>';
        $card .= '</div>'; 
        return $button . $card;
    }
    





    public function mostrarUsuario()
    {
        $data = $_SESSION;
        $form = "<div class='form-container'>";
        $form .= "<div class='form-group'><h3 class='mt-3 me-2 text-nowrap' style='width: 280px;'>Nombre de usuario:</h3><span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $data['username'] . "</span></div>";
        $form .= "<div class='form-group'><h3 class='mt-3 me-2 text-nowrap ' style='width: 280px;'>E-mail:</h3><span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $data['mail'] . "</span></div>";
        $form .= "<div class='form-group'><h3 class='mt-3 me-2 text-nowrap ' style='width: 280px;'>DNI:</h3><span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $data['dni'] . "</span></div>";
        $form .= "<div class='form-group'><h3 class='mt-3 me-2 text-nowrap ' style='width: 280px;'>Ubicación:</h3><span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $data['ubi'] . "</span>    </div>";
        $form .= "<div class='form-group'><h3 class='mt-3 me-2 text-nowrap  ' style='width: 280px;'>Puntos:</h3><span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $data['puntos'] . "</span></div>";
        $form .= "</div>";
        return $form;
    }
}
