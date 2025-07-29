<?php
$host = 'xxxx.onrender.com';
$user = 'root';
$pass = '123456';
$db = 'life_gym';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("💥 Error de conexión: " . $conn->connect_error);
}
echo "✅ Conexión exitosa a la base de datos.";
?>
