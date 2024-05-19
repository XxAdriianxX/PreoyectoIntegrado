<?php
class Model extends Connection
{
    public function getAllEvents()
    {
        $query = 'SELECT * From Evento';
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

    public function drawEventsList($dni)
    {
        $events = $this->getAllEvents();
        $table = '';
        foreach ($events as $event) {
            $table .= '<div class="col-lg-4 col-md-6">';
            if ($event->active == '1') {
                $table .= '<div class="card text-center mb-5 custom-bg">';
            } else {
                $table .= '<div class="card bg-dark text-center mb-5">';
            }
            $table .= '<div class="card-body">';
            $table .= '<h5 class="card-title"><strong>' . $event->name . '</strong></h5>';
            $table .= '<p class="card-text"><br>Ubicación: ' . $event->location . '</p>';
            $table .= '<div class="row justify-content-start mb-2">';
            $table .= '<div class="col-md-6">';
            $table .= '<span class="badge rounded-pill pill-bg border border-dark d-block mb-2">Fecha: ' . $event->date . '</span>';
            $table .= '</div>';
            $table .= '<div class="col-md-6">';
            $table .= '<span class="badge rounded-pill pill-bg border border-dark d-block mb-2">Hora: ' . $event->date . '</span>';
            $table .= '</div>';
            $table .= '</div>';
            $table .= '<div class="row justify-content-center mx-auto" style="width: 50%;">';
            $table .= '<span class="badge rounded-pill pill-bg border border-dark d-block mb-2 mx-auto">Puntos: ' . $event->points . '</span>';
            $table .= '</div>';
            $table .= '<p></p>';
            $isAttending = $this->verifyAttendance($dni, $event->name, $event->date);
            if ($event->active == '1') {
                if ($isAttending) {
                    $table .= '<a href="notGoEvent.php?eventName=' . $event->name . '&eventDate=' . $event->date . '" class="btn custom-button border border-dark">Desapuntarse</a>';
                } else {
                    $table .= '<a href="goEvent.php?eventName=' . $event->name . '&eventDate=' . $event->date . '" class="btn custom-button border border-dark">Apuntarse</a>';
                }
            } else {
                $table .= '<a href="#" class="btn custom-button border border-dark disabled">Apuntarse</a>';
            }
            $table .= '</div>';
            if (!empty($event->picture)) {
                $table .= '<img src="' . $event->picture . '" class="card-img-bottom rounded-3" alt="...">';
            } else {
                $table .= '<img src="Assets/img/albufera.jpg" class="card-img-bottom rounded-3" alt="Imagen por defecto">';
            }
            $table .= '</div>';
            $table .= '</div>';
        }
        return $table;
    }

    public function getAllFriends($DNI)
    {
        $stmt = $this->conn->prepare('SELECT u.username AS nombre_amigo
        FROM Usuario u
        INNER JOIN Amigos a ON u.DNI = a.DNI_amigo
        WHERE a.DNI_usuario = ?');
        $stmt->bind_param('s', $DNI);
        $stmt->execute();
        $result = $stmt->get_result();
        $friends = [];

        while ($row = $result->fetch_assoc()) {
            $friends[] = $row['nombre_amigo'];
        }
        $stmt->close();
        return $friends;
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function drawFriends($DNI)
    {
        $friends = $this->getAllFriends($DNI);
        $table = '';
        for ($i = 0; $i < count($friends); $i++) {
            $table .= '<span class="custom-span badge rounded-pill border border-dark flex-grow-1 text-dark mb-2 d-flex justify-content-center">' . $friends[$i] . '</span>';
        }
        return $table;
    }

    public function addEvent($data, $DNI)
    {
        $curdate = new DateTime();
        $date = $data["date"];
        $dateFormat = DateTime::createFromFormat('Y-m-d\TH:i', $date);
        if (!$dateFormat) {
            echo "Formato de fecha inválido.";
            return;
        }
        $dateFormatStr = $dateFormat->format('Y-m-d H:i:s');
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
        $stmt->bind_param('sssssiss', $eventName, $dateFormatStr, $location, $active, $DNI, $points, $description, $imagePath);

        if (!$stmt->execute()) {
            echo "Error al añadir el evento.";
        } else {
            header("location: events.php");
        }
    }

    public function goEvent($dni, $eventName, $eventDate)
    {
        $stmt = $this->conn->prepare('INSERT INTO Asiste (DNI_usuario, nombre_evento, fecha_hora_evento) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $dni, $eventName, $eventDate);
        if ($stmt->execute()) {
            header("location: events.php");
        } else {
            echo "Error al apuntarse.";
        }

        $stmt->close();
    }

    public function verifyAttendance($dni, $eventName, $eventDate)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS asistente FROM Asiste WHERE nombre_evento = ? AND fecha_hora_evento = ? AND DNI_usuario = ?");
        $stmt->bind_param("ssi", $eventName, $eventDate, $dni);
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

    public function showProfile($data)
    {

        $form = "";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>Nombre de usuario:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $data['username'] . "</span>";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>E-mail:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $data['mail'] . "</span>";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>DNI:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $data['dni'] . "</span>";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>Ubicación:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $data['ubi'] . "</span>";
        $form .= "<h3 class='mb-0 me-2 text-nowrap' style='width: 280px;'>Puntos:</h3>";
        $form .= "<span class='badge rounded-pill bg-light border border-dark flex-grow-1 text-dark text-start fs-6'>" . $data['puntos'] . "</span>";
        return $form;
    }

    public function notGoEvent($dni, $eventName, $eventDate)
    {
        $stmt = $this->conn->prepare('DELETE FROM Asiste WHERE DNI_usuario= ? AND nombre_evento = ? AND fecha_hora_evento = ?');
        $stmt->bind_param('sss', $dni, $eventName, $eventDate);
        if ($stmt->execute()) {
            header("location: events.php");
        } else {
            echo "Error al desapuntarse.";
        }

        $stmt->close();
    }
}
