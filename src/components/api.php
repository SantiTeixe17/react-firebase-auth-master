<?php
// Simulación de una base de datos simple (NO usar en producción)
$users = array(
    array("username" => "usuario1", "password" => password_hash("contrasena1", PASSWORD_DEFAULT)),
    array("username" => "usuario2", "password" => password_hash("contrasena2", PASSWORD_DEFAULT))
);

// Endpoint para el registro de usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $users[] = array("username" => $username, "password" => $password);
    
    echo json_encode(array("message" => "Registro exitoso"));
    exit();
}

// Endpoint para el inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            echo json_encode(array("message" => "Inicio de sesión exitoso"));
            exit();
        }
    }
    
    echo json_encode(array("message" => "Credenciales inválidas"));
    exit();
}

// Simulación de la API de Tienda Nube (NO usar en producción)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['get_orders'])) {
    $orders = array(
        array("user" => "usuario1", "order" => "Pedido 1"),
        array("user" => "usuario2", "order" => "Pedido 2")
    );
    
    echo json_encode($orders);
    exit();
}

// Endpoint para obtener los datos de usuarios y pedidos
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['get_users_and_orders'])) {
    $api_url = "https://api.tiendanube.com/v1"; // URL de la API de Tienda Nube
    
    // Configura las credenciales de autenticación de la API
    $api_key = "G-9G6T0NWL52";
    $api_secret = "GGrZcz9bQvSUUeThl7LN_Q";
    
    // Realiza la solicitud a la API utilizando cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "$api_url/customers"); // Ejemplo de endpoint para obtener datos de clientes
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Basic " . base64_encode("$api_key:$api_secret")
    ));
    $response = curl_exec($ch);
    curl_close($ch);
    
    // Decodifica la respuesta JSON
    $data = json_decode($response, true);
    
    // Manipula y muestra los datos de usuarios y pedidos
    // ...
    
    echo json_encode($data);
    exit();
}
?>