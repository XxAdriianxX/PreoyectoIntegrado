<?php
class EventList extends Connection
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
            $object = new Event($event['nombre'], $event['fecha_hora'], $event['ubi'], $event['descripcion'], $event['estado'], $event['DNI_usuario'], $event['puntos_asociados']);
            $newEvents[] = $object;
        }
        return $newEvents;
    }

    public function drawEventsList()
    {
        $events = $this->getAllEvents();
        $table = '';
        foreach ($events as $event) {
            $table .= '<div class="col-lg-4 col-md-6">';
            if ($event->active == 'Activo') {
                $table .= '<div class="card text-center mb-5">';
            } else {
                $table .= '<div class="card custom-bg text-center mb-5">';
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
            $table .= '<a href="#" class="btn custom-button border border-dark">Apuntarse</a>';
            $table .= '</div>';
            $table .= '<img src="Assets/img/albufera.jpg" class="card-img-bottom rounded-3" alt="...">';
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
        for ($i=0; $i<count($friends); $i++) {
            $table .= '<span class="custom-span badge rounded-pill border border-dark flex-grow-1 text-dark mb-2 d-flex justify-content-center">' . $friends[$i] . '</span>';
        }
        return $table;
    }
}