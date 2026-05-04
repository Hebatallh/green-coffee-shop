<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../includes/db.php';

$db = getDB();
$category = $_GET['category'] ?? '';

if ($category) {
    $stmt = $db->prepare("SELECT m.*, c.name as category_name FROM menu_items m JOIN categories c ON m.category_id = c.id WHERE c.slug = ? AND m.is_available = 1");
    $stmt->bind_param("s", $category);
} else {
    $stmt = $db->prepare("SELECT m.*, c.name as category_name FROM menu_items m JOIN categories c ON m.category_id = c.id WHERE m.is_available = 1 ORDER BY m.category_id");
    $stmt->bind_param("");
}

$stmt->execute();
$result = $stmt->get_result();
$items = [];
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}

echo json_encode(['items' => $items]);
$db->close();
?>
