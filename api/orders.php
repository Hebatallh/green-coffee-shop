<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { exit(0); }

require_once '../includes/db.php';
$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $name   = $data['customer_name'] ?? '';
    $email  = $data['customer_email'] ?? '';
    $phone  = $data['customer_phone'] ?? '';
    $notes  = $data['notes'] ?? '';
    $total  = floatval($data['total_amount'] ?? 0);
    $items  = $data['items'] ?? [];

    if (!$name || $total <= 0 || empty($items)) {
        echo json_encode(['success' => false, 'error' => 'Missing required fields']);
        exit;
    }

    $stmt = $db->prepare("INSERT INTO orders (customer_name, customer_email, customer_phone, total_amount, notes) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssds", $name, $email, $phone, $total, $notes);
    $stmt->execute();
    $order_id = $db->insert_id;

    foreach ($items as $item) {
        $mid   = intval($item['menu_item_id']);
        $qty   = intval($item['quantity']);
        $price = floatval($item['unit_price']);
        $s2 = $db->prepare("INSERT INTO order_items (order_id, menu_item_id, quantity, unit_price) VALUES (?, ?, ?, ?)");
        $s2->bind_param("iiid", $order_id, $mid, $qty, $price);
        $s2->execute();
    }

    echo json_encode(['success' => true, 'order_id' => $order_id]);
} else {
    $result = $db->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 50");
    $orders = [];
    while ($row = $result->fetch_assoc()) $orders[] = $row;
    echo json_encode(['orders' => $orders]);
}

$db->close();
?>
