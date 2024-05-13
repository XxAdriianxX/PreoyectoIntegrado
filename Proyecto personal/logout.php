<?php
// logout.php

// Inicia la sesión si no está iniciada aún
session_start();

// Destruye todas las variables de sesión
session_destroy();

// Redirige al usuario a la página de inicio o a donde desees
header("Location: index.php");
exit;
?>