<?php
$host = 'dpg-d24l0l15pdvs73bvvmq0-a';
$port = '5432';
$dbname = 'life_gym_db';
$user = 'life_gym_db_user';
$password = '0BaR53ptUeZaLHwtIBbMtuZ6cvYtCu3p';

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("❌ Error de conexión a PostgreSQL");
} else {
    echo "✅ Conectado correctamente a PostgreSQL";
}
?>
