<?php
// app/config/config.php
// Ajusta estas constantes a tu entorno
define('DB_HOST', 'localhost');
define('DB_NAME', 'church_db');
define('DB_USER', 'root');
define('DB_PASS', '123456789');

// URL base (sin slash final). Ej: http://localhost/church-mvc-php/public
// Si usas XAMPP/MAMP, pon la URL correspondiente
define('BASE_URL', getenv('BASE_URL') ?: 'http://localhost:3000/public');

// Opciones generales
date_default_timezone_set('America/Mexico_City');
ini_set('display_errors', 1);
error_reporting(E_ALL);
