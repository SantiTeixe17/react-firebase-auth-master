<?php
$store_id = '5956340013';
$api_key = '';
$url = "https://api.tiendanube.com/v1/$store_id/customers";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer $api_key"
));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);
$customers = json_decode($response, true);

// Aquí procesamos los datos para obtener pedidos para cada usuario
foreach ($customers as &$customer) {
    $customer['orders'] = getOrdersForUser($customer['id']);
}

header('Content-Type: application/json');
echo json_encode($customers);

// Función para obtener pedidos para un usuario específico
function getOrdersForUser($userId) {
    $ordersUrl = "https://api.tiendanube.com/v1/$store_id/customers/$userId/orders";
    
    $ordersCurl = curl_init($ordersUrl);
    curl_setopt($ordersCurl, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer $api_key"
    ));
    curl_setopt($ordersCurl, CURLOPT_RETURNTRANSFER, true);

    $ordersResponse = curl_exec($ordersCurl);
    $orders = json_decode($ordersResponse, true);
    
    return $orders;
}
?>

