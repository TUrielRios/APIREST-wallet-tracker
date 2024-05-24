<?php
include '../config/database.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        // Crear una nueva tarjeta
        $data = json_decode(file_get_contents("php://input"), true);
        $id_usuario = $data['id_usuario'];
        $nombre = $data['nombre'];
        $tipo = $data['tipo'];
        $saldo = $data['saldo'];

        $sql = "INSERT INTO tarjetas (id_usuario, nombre, tipo, saldo) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issd", $id_usuario, $nombre, $tipo, $saldo);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Tarjeta creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Error al crear tarjeta", "error" => $stmt->error]);
        }

        $stmt->close();
        break;

    case 'GET':
        if (isset($_GET['id_tarjeta'])) {
            // Obtener una tarjeta específica
            $id_tarjeta = $_GET['id_tarjeta'];

            $sql = "SELECT * FROM tarjetas WHERE id_tarjeta = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_tarjeta);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $tarjeta = $result->fetch_assoc();
                    echo json_encode($tarjeta);
                } else {
                    echo json_encode(["message" => "Tarjeta no encontrada"]);
                }
            } else {
                echo json_encode(["message" => "Error al obtener tarjeta", "error" => $stmt->error]);
            }

            $stmt->close();
        } else {
            // Obtener todas las tarjetas
            if (isset($_GET['id_usuario'])) {
                $id_usuario = $_GET['id_usuario'];
                $sql = "SELECT * FROM tarjetas WHERE id_usuario = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id_usuario);
            } else {
                $sql = "SELECT * FROM tarjetas";
                $stmt = $conn->prepare($sql);
            }

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $tarjetas = [];
                while ($row = $result->fetch_assoc()) {
                    $tarjetas[] = $row;
                }
                echo json_encode($tarjetas);
            } else {
                echo json_encode(["message" => "Error al obtener tarjetas", "error" => $stmt->error]);
            }

            $stmt->close();
        }
        break;

    case 'PUT':
        // Actualizar una tarjeta existente
        $data = json_decode(file_get_contents("php://input"), true);
        $id_tarjeta = $data['id_tarjeta'];
        $id_usuario = $data['id_usuario'];
        $nombre = $data['nombre'];
        $tipo = $data['tipo'];
        $saldo = $data['saldo'];

        $sql = "UPDATE tarjetas SET id_usuario = ?, nombre = ?, tipo = ?, saldo = ? WHERE id_tarjeta = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssdi", $id_usuario, $nombre, $tipo, $saldo, $id_tarjeta);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Tarjeta actualizada exitosamente"]);
        } else {
            echo json_encode(["message" => "Error al actualizar tarjeta", "error" => $stmt->error]);
        }

        $stmt->close();
        break;

    case 'DELETE':
        // Eliminar una tarjeta
        $data = json_decode(file_get_contents("php://input"), true);
        $id_tarjeta = $data['id_tarjeta'];

        $sql = "DELETE FROM tarjetas WHERE id_tarjeta = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_tarjeta);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Tarjeta eliminada exitosamente"]);
        } else {
            echo json_encode(["message" => "Error al eliminar tarjeta", "error" => $stmt->error]);
        }

        $stmt->close();
        break;

    default:
        echo json_encode(["message" => "Método no soportado"]);
        break;
}

$conn->close();
?>
