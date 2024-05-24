
<?php
include '../config/database.php';


$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        // Verificar si la solicitud es para registrar un nuevo usuario o para iniciar sesión
        $data = json_decode(file_get_contents("php://input"), true);
        
        if (isset($data['register'])) {
            // Crear un nuevo usuario
            $nombre = $data['nombre'];
            $email = $data['email'];
            $password = password_hash($data['password'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $nombre, $email, $password);

            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Usuario creado exitosamente"]);
            } else {
                echo json_encode(["success" => false, "message" => "Error al crear usuario", "error" => $stmt->error]);
            }

            $stmt->close();
        } else {
            // Autenticar usuario
            $email = $data['email'];
            $password = $data['password'];

            $sql = "SELECT * FROM usuarios WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $usuario = $result->fetch_assoc();
                if (password_verify($password, $usuario['password'])) {
                    echo json_encode(["success" => true, "id_usuario" => $usuario['id_usuario']]);
                } else {
                    echo json_encode(["success" => false, "message" => "Correo o contraseña incorrectos"]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "Correo o contraseña incorrectos"]);
            }
        }
        break;


    case 'GET':
        if (isset($_GET['id_usuario'])) {
            // Obtener un usuario específico
            $id_usuario = $_GET['id_usuario'];

            $sql = "SELECT id_usuario, nombre, email FROM usuarios WHERE id_usuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_usuario);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $usuario = $result->fetch_assoc();
                    echo json_encode($usuario);
                } else {
                    echo json_encode(["message" => "Usuario no encontrado"]);
                }
            } else {
                echo json_encode(["message" => "Error al obtener usuario", "error" => $stmt->error]);
            }

            $stmt->close();
        } else {
            // Obtener todos los usuarios
            $sql = "SELECT id_usuario, nombre, email FROM usuarios";
            $result = $conn->query($sql);

            $usuarios = [];
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
            echo json_encode($usuarios);
        }
        break;

    case 'PUT':
        // Actualizar un usuario existente
        $data = json_decode(file_get_contents("php://input"), true);
        $id_usuario = $data['id_usuario'];
        $nombre = $data['nombre'];
        $email = $data['email'];

        if (isset($data['password'])) {
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET nombre = ?, email = ?, password = ? WHERE id_usuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $nombre, $email, $password, $id_usuario);
        } else {
            $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id_usuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $nombre, $email, $id_usuario);
        }

        if ($stmt->execute()) {
            echo json_encode(["message" => "Usuario actualizado exitosamente"]);
        } else {
            echo json_encode(["message" => "Error al actualizar usuario", "error" => $stmt->error]);
        }

        $stmt->close();
        break;

    case 'DELETE':
        // Eliminar un usuario
        $data = json_decode(file_get_contents("php://input"), true);
        $id_usuario = $data['id_usuario'];

        $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Usuario eliminado exitosamente"]);
        } else {
            echo json_encode(["message" => "Error al eliminar usuario", "error" => $stmt->error]);
        }

        $stmt->close();
        break;

    default:
        echo json_encode(["message" => "Método no soportado"]);
        break;
}

$conn->close();
?>
