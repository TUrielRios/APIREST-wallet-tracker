<?php
$db_url = "mysql://root:password@viaduct.proxy.rlwy.net:56635/railway";

// Analizar la URL para obtener los detalles de conexión
$url_parts = parse_url($db_url);

// Obtener los detalles de la conexión desde la URL
$db_host = "roundhouse.proxy.rlwy.net";
$db_port = "10771";
$db_user = "root";
$db_pass = "QCSWRfSOjQOFGfKsZCzozBJvyJODaoBc";
$db_name = "railway";

// Crear la conexión
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
