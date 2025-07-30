<?php
$host = 'dpg-d24l0l15pdvs73bvvmq0-a';
$port = 5432;
$user = 'life_gym_db_user';
$pass = '0BaR53ptUeZaLHwtIBbMtuZ6cvYtCu3p';
$db = 'life_gym_db'; // o 'railway' si usaste esa

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?> 
