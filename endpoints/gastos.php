<?php
include '../config/database.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        // Crear un nuevo gasto
        $data = json_decode(file_get_contents("php://input"), true);
        $id_usuario = $data['id_usuario'];
        $monto = $data['monto'];
        $fecha = $data['fecha'];
        $categoria = $data['categoria'];
        $id_tarjeta = $data['id_tarjeta'];

        $sql = "INSERT INTO gastos (id_usuario, monto, fecha, categoria, id_tarjeta) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("idssi", $id_usuario, $monto, $fecha, $categoria, $id_tarjeta);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Gasto creado exitosamente"]);
        } else {
            echo json_encode(["message" => "Error al crear gasto", "error" => $stmt->error]);
        }

        $stmt->close();
        break;

    case 'GET':
        if (isset($_GET['id_gasto'])) {
            // Obtener un gasto específico
            $id_gasto = $_GET['id_gasto'];

            $sql = "SELECT * FROM gastos WHERE id_gasto = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_gasto);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $gasto = $result->fetch_assoc();
                    echo json_encode($gasto);
                } else {
                    echo json_encode(["message" => "Gasto no encontrado"]);
                }
            } else {
                echo json_encode(["message" => "Error al obtener gasto", "error" => $stmt->error]);
            }

            $stmt->close();
        } else {
            // Obtener todos los gastos
            if (isset($_GET['id_usuario'])) {
                $id_usuario = $_GET['id_usuario'];
                $sql = "SELECT * FROM gastos WHERE id_usuario = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id_usuario);
            } else {
                $sql = "SELECT * FROM gastos";
                $stmt = $conn->prepare($sql);
            }

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $gastos = [];
                while ($row = $result->fetch_assoc()) {
                    $gastos[] = $row;
                }
                echo json_encode($gastos);
            } else {
                echo json_encode(["message" => "Error al obtener gastos", "error" => $stmt->error]);
            }

            $stmt->close();
        }
        break;

    case 'PUT':
        // Actualizar un gasto existente
        $data = json_decode(file_get_contents("php://input"), true);
        $id_gasto = $data['id_gasto'];
        $id_usuario = $data['id_usuario'];
        $monto = $data['monto'];
        $fecha = $data['fecha'];
        $categoria = $data['categoria'];
        $id_tarjeta = $data['id_tarjeta'];

        $sql = "UPDATE gastos SET id_usuario = ?, monto = ?, fecha = ?, categoria = ?, id_tarjeta = ? WHERE id_gasto = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("idssii", $id_usuario, $monto, $fecha, $categoria, $id_tarjeta, $id_gasto);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Gasto actualizado exitosamente"]);
        } else {
            echo json_encode(["message" => "Error al actualizar gasto", "error" => $stmt->error]);
        }

        $stmt->close();
        break;

    case 'DELETE':
        // Eliminar un gasto
        $data = json_decode(file_get_contents("php://input"), true);
        $id_gasto = $data['id_gasto'];

        $sql = "DELETE FROM gastos WHERE id_gasto = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_gasto);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Gasto eliminado exitosamente"]);
        } else {
            echo json_encode(["message" => "Error al eliminar gasto", "error" => $stmt->error]);
        }

        $stmt->close();
        break;

    default:
        echo json_encode(["message" => "Método no soportado"]);
        break;
}

$conn->close();
?>
