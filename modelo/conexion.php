<?php
$host = 'switchyard.proxy.rlwy.net';
$port = 15384;
$user = 'root';
$pass = 'yHVACjdVpisuiHXnOqKCEfWbkJuktloQ';
$db = 'life_gym'; // o 'railway' si usaste esa

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?> 