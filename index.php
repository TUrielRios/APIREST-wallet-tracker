<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentación de la API de Wallet TR </title>
    <style>
        /* Estilos CSS aquí */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1, h2, h3 {
            color: black;
            cursor: pointer;
        }

        .endpoint {
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
            background-color: lightgreen;
            border: 1px solid #007bff;
            padding: 20px;
        }

        .endpoint h3 {
            margin-top: 0;
            color: #333;
        }

        p, pre {
            margin: 10px 0;
        }

        pre {
            background: #f7f7f7;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }

        a {
            color: lightgreen;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: darkgreen;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: lightgreen;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #45a049;
        }

        .endpoint {
            display: none;
        }

        .endpoint:target {
            display: block;
        }
        #autenticacion, #usuarios, #ingresos, #gastos, #tarjetas {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        #autenticacion a, #usuarios a, #ingresos a, #gastos a, #tarjetas a {
            text-decoration: none;
            margin: 0 10px;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: lightgreen;
            color: #333;
            transition: background-color 0.3s;
        }

        #autenticacion a:hover, #usuarios a:hover, #ingresos a:hover, #gastos a:hover, #tarjetas a:hover {
            background-color: darkgreen;
            color: white;
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Documentación de la API de Wallet TR</h1>
        <p>Bienvenido a la documentación de la API de Wallet TR. Aquí encontrarás información sobre cómo utilizar los diferentes endpoints disponibles en esta API.</p>

        <h2>Autenticación</h2>
        <div id="autenticacion">
            <a href="#crear-usuario">Crear Usuario</a>
        </div>
        <div class="endpoint" id="crear-usuario">
            <h3>Registro de Usuario</h3>
            <p><strong>Método:</strong> POST</p>
            <p><strong>Ruta:</strong> /endpoints/usuarios.php</p>
            <p><strong>Body:</strong></p>
            <pre>{
    "nombre": "John Doe",
    "email": "john.doe@example.com",
    "password": "password123"
}</pre>
        </div>


        <h2 >Usuarios</h2>
        <div id="usuarios">
            <a href="#todos-usuarios">Obtener Todos los Usuarios</a>
            <a href="#usuario-id">Obtener Usuario por ID</a>
            <a href="#actualizar-usuario">Actualizar Usuario</a>
            <a href="#eliminar-usuario">Eliminar Usuario</a>
        </div>
        <div id="todos-usuarios" class="endpoint">
            <h3>Obtener Todos los Usuarios</h3>
            <p><strong>Método:</strong> GET</p>
            <p><strong>Ruta:</strong> /endpoints/usuarios.php</p>
        </div>
        <div class="endpoint" id="usuario-id">
            <h3>Obtener Usuario por ID</h3>
            <p><strong>Método:</strong> GET</p>
            <p><strong>Ruta:</strong> /endpoints/usuarios.php?id_usuario=1</p>
        </div>
        <div class="endpoint" id="actualizar-usuario">
            <h3>Actualizar Usuario</h3>
            <p><strong>Método:</strong> PUT</p>
            <p><strong>Ruta:</strong> /endpoints/usuarios.php</p>
            <p><strong>Body:</strong></p>
            <pre>{
    "id_usuario": 1,
    "nombre": "John Doe Updated",
    "email": "john.doe@example.com",
    "password": "newpassword123"
}</pre>
        </div>
        <div class="endpoint" id="eliminar-usuario">
            <h3>Eliminar Usuario</h3>
            <p><strong>Método:</strong> DELETE</p>
            <p><strong>Ruta:</strong> /endpoints/usuarios.php</p>
            <p><strong>Body:</strong></p>
            <pre>{
    "id_usuario": 1
}</pre>
        </div>

        <h2>Ingresos</h2>
        <div id="ingresos">
            <a href="#crear-ingresos">Crear ingresos</a>
            <a href="#todos-ingresos">Obtener Todos los ingresos</a>
            <a href="#ingresos-id">Obtener ingreso por ID</a>
            <a href="#ingresos-usuario">Obtener ingreso por usuario</a>
            <a href="#actualizar-ingreso">Actualizar ingreso</a>
            <a href="#eliminar-ingreso">Eliminar Ingreso</a>
        </div>
        <div class="endpoint" id="crear-ingresos">
            <h3>Crear Ingreso</h3>
            <p><strong>Método:</strong> POST</p>
            <p><strong>Ruta:</strong> /endpoints/ingresos.php</p>
            <p><strong>Body:</strong></p>
            <pre>{
    "id_usuario": 1,
    "monto": 1000.00,
    "fecha": "2024-05-21",
    "fuente": "Salario"
}</pre>
        </div>
        <div class="endpoint" id="todos-ingresos">
            <h3>Obtener Todos los Ingresos</h3>
            <p><strong>Método:</strong> GET</p>
            <p><strong>Ruta:</strong> /endpoints/ingresos.php</p>
        </div>
        <div class="endpoint" id="ingresos-id">
            <h3>Obtener Ingreso por ID</h3>
            <p><strong>Método:</strong> GET</p>
            <p><strong>Ruta:</strong> /endpoints/ingresos.php?id_ingreso=1</p>
        </div>
        <div class="endpoint" id="ingresos-usuario">
            <h3>Obtener Ingresos de un Usuario</h3>
            <p><strong>Método:</strong> GET</p>
            <p><strong>Ruta:</strong> /endpoints/ingresos.php?id_usuario=1</p>
        </div>
        <div class="endpoint" id="actualizar-ingreso">
            <h3>Actualizar Ingreso</h3>
            <p><strong>Método:</strong> PUT</p>
            <p><strong>Ruta:</strong> /endpoints/ingresos.php</p>
            <p><strong>Body:</strong></p>
            <pre>{
    "id_ingreso": 1,
    "monto": 1200.00,
    "fecha": "2024-05-21",
    "fuente": "Salario"
}</pre>
        </div>
        <div class="endpoint" id="eliminar-ingreso">
            <h3>Eliminar Ingreso</h3>
            <p><strong>Método:</strong> DELETE</p>
            <p><strong>Ruta:</strong> /endpoints/ingresos.php</p>
            <p><strong>Body:</strong></p>
            <pre>{
    "id_ingreso": 1
}</pre>
        </div>

        <h2>Gastos</h2>
        <div id="gastos">
            <a href="#crear-gasto">Crear gasto</a>
            <a href="#todos-gastos">Obtener Todos los gastos</a>
            <a href="#gastos-id">Obtener gasto por ID</a>
            <a href="#gastos-usuario">Obtener gasto por usuario</a>
            <a href="#actualizar-gasto">Actualizar gasto</a>
            <a href="#eliminar-gasto">Eliminar gasto</a>
        </div>
        <div class="endpoint" id="crear-gasto">
            <h3>Crear Gasto</h3>
            <p><strong>Método:</strong> POST</p>
            <p><strong>Ruta:</strong> /endpoints/gastos.php</p>
            <p><strong>Body:</strong></p>
            <pre>{
    "id_usuario": 1,
    "monto": 50.00,
    "fecha": "2024-05-21",
    "categoria": "Comida",
    "id_tarjeta": 1
}</pre>
        </div>
        <div class="endpoint" id="todos-gastos">
            <h3>Obtener Todos los Gastos</h3>
            <p><strong>Método:</strong> GET</p>
            <p><strong>Ruta:</strong> /endpoints/gastos.php</p>
        </div>
        <div class="endpoint" id="gastos-id">
            <h3>Obtener Gasto por ID</h3>
            <p><strong>Método:</strong> GET</p>
            <p><strong>Ruta:</strong> /endpoints/gastos.php?id_gasto=1</p>
        </div>
        <div class="endpoint" id="gastos-usuario">
            <h3>Obtener Gastos de un Usuario</h3>
            <p><strong>Método:</strong> GET</p>
            <p><strong>Ruta:</strong> /endpoints/gastos.php?id_usuario=1</p>
        </div>
        <div class="endpoint" id="actualizar-gasto">
            <h3>Actualizar Gasto</h3>
            <p><strong>Método:</strong> PUT</p>
            <p><strong>Ruta:</strong> /endpoints/gastos.php</p>
            <p><strong>Body:</strong></p>
            <pre>{
    "id_gasto": 1,
    "monto": 60.00,
    "fecha": "2024-05-21",
    "categoria": "Comida",
    "id_tarjeta": 1
}</pre>
        </div>
        <div class="endpoint" id="eliminar-gasto">
            <h3>Eliminar Gasto</h3>
            <p><strong>Método:</strong> DELETE</p>
            <p><strong>Ruta:</strong> /endpoints/gastos.php</p>
            <p><strong>Body:</strong></p>
            <pre>{
    "id_gasto": 1
}</pre>
        </div>

        <h2>Tarjetas</h2>
        <div id="tarjetas">
            <a href="#crear-tarjeta">Crear tarjeta</a>
            <a href="#todos-tarjetas">Obtener Todos las tarjetas</a>
            <a href="#tarjeta-id">Obtener tarjeta por ID</a>
            <a href="#tarjetas-usuario">Obtener tarjetas por usuario</a>
            <a href="#actualizar-tarjeta">Actualizar tarjeta</a>
            <a href="#eliminar-tarjeta">Eliminar tarjeta</a>
        </div>
        <div class="endpoint" id="crear-tarjeta">
            <h3>Crear Tarjeta</h3>
            <p><strong>Método:</strong> POST</p>
            <p><strong>Ruta:</strong> /endpoints/tarjetas.php</p>
            <p><strong>Body:</strong></p>
            <pre>{
    "id_usuario": 1,
    "nombre": "Mi Tarjeta",
     "saldo": "200"       }
    </pre>
        </div>
        <div class="endpoint" id="todos-tarjetas">
            <h3>Obtener Todas las Tarjetas</h3>
            <p><strong>Método:</strong> GET</p>
            <p><strong>Ruta:</strong> /endpoints/tarjetas.php</p>
        </div>
        <div class="endpoint" id="tarjeta-id">
            <h3>Obtener Tarjeta por ID</h3>
            <p><strong>Método:</strong> GET</p>
            <p><strong>Ruta:</strong> /endpoints/tarjetas.php?id_tarjeta=1</p>
        </div>
        <div class="endpoint" id="tarjetas-usuario">
            <h3>Obtener Tarjetas de un Usuario</h3>
            <p><strong>Método:</strong> GET</p>
            <p><strong>Ruta:</strong> /endpoints/tarjetas.php?id_usuario=1</p>
        </div>
        <div class="endpoint" id="actualizar-tarjeta">
            <h3>Actualizar Tarjeta</h3>
            <p><strong>Método:</strong> PUT</p>
            <p><strong>Ruta:</strong> /endpoints/tarjetas.php</p>
            <p><strong>Body:</strong></p>
            <pre>{
    "id_tarjeta": 1,
    "nombre": "Mi Tarjeta Actualizada",
    "saldo":"2000"
}</pre>
        </div>
        <div class="endpoint" id="eliminar-tarjeta">
            <h3>Eliminar Tarjeta</h3>
            <p><strong>Método:</strong> DELETE</p>
            <p><strong>Ruta:</strong> /endpoints/tarjetas.php</p>
            <p><strong>Body:</strong></p>
            <pre>{
    "id_tarjeta": 1
}</pre>
        </div>

        <h2>Documentación Adicional</h2>
        <p>Para obtener más detalles sobre cómo usar la API, consulta la documentación completa en la <a href="https://tu_dominio.com/docs">página de documentación</a>.</p>
    </div>

</body>
</html>
