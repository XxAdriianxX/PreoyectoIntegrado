<?php

require_once 'conexion.php';

class Security extends Conexion {
    













    public static function validarEmail($email) {
        // Filtrar y validar el correo electrónico
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    public static function validarTexto($texto) {
        // Validar que el texto no esté vacío
        if (empty($texto)) {
            return false;
        }
        return true;
    }
}
?>
