<?php
include '../config/database.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        // Crear un nuevo ingreso
        $data = json_decode(file_get_contents("php://input"), true);
        $id_usuario = $data['id_usuario'];
        $monto = $data['monto'];
        $fecha = $data['fecha'];
        $fuente = $data['fuente'];

        $sql = "INSERT INTO ingresos (id_usuario, monto, fecha, fuente) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("idss", $id_usuario, $monto, $fecha, $fuente);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Ingreso creado exitosamente"]);
        } else {
            echo json_encode(["message" => "Error al crear ingreso", "error" => $stmt->error]);
        }

        $stmt->close();
        break;

    case 'GET':
        if (isset($_GET['id_ingreso'])) {
            // Obtener un ingreso específico
            $id_ingreso = $_GET['id_ingreso'];

            $sql = "SELECT * FROM ingresos WHERE id_ingreso = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_ingreso);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $ingreso = $result->fetch_assoc();
                    echo json_encode($ingreso);
                } else {
                    echo json_encode(["message" => "Ingreso no encontrado"]);
                }
            } else {
                echo json_encode(["message" => "Error al obtener ingreso", "error" => $stmt->error]);
            }

            $stmt->close();
        } else {
            // Obtener todos los ingresos
            if (isset($_GET['id_usuario'])) {
                $id_usuario = $_GET['id_usuario'];
                $sql = "SELECT * FROM ingresos WHERE id_usuario = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id_usuario);
            } else {
                $sql = "SELECT * FROM ingresos";
                $stmt = $conn->prepare($sql);
            }

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $ingresos = [];
                while ($row = $result->fetch_assoc()) {
                    $ingresos[] = $row;
                }
                echo json_encode($ingresos);
            } else {
                echo json_encode(["message" => "Error al obtener ingresos", "error" => $stmt->error]);
            }

            $stmt->close();
        }
        break;

    case 'PUT':
        // Actualizar un ingreso existente
        $data = json_decode(file_get_contents("php://input"), true);
        $id_ingreso = $data['id_ingreso'];
        $id_usuario = $data['id_usuario'];
        $monto = $data['monto'];
        $fecha = $data['fecha'];
        $fuente = $data['fuente'];

        $sql = "UPDATE ingresos SET id_usuario = ?, monto = ?, fecha = ?, fuente = ? WHERE id_ingreso = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("idssi", $id_usuario, $monto, $fecha, $fuente, $id_ingreso);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Ingreso actualizado exitosamente"]);
        } else {
            echo json_encode(["message" => "Error al actualizar ingreso", "error" => $stmt->error]);
        }

        $stmt->close();
        break;

    case 'DELETE':
        // Eliminar un ingreso
        $data = json_decode(file_get_contents("php://input"), true);
        $id_ingreso = $data['id_ingreso'];

        $sql = "DELETE FROM ingresos WHERE id_ingreso = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_ingreso);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Ingreso eliminado exitosamente"]);
        } else {
            echo json_encode(["message" => "Error al eliminar ingreso", "error" => $stmt->error]);
        }

        $stmt->close();
        break;

    default:
        echo json_encode(["message" => "Método no soportado"]);
        break;
}

$conn->close();
?>
