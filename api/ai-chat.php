<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { exit(0); }

require_once '../includes/config.php';

$data     = json_decode(file_get_contents('php://input'), true);
$messages = $data['messages'] ?? [];

if (empty($messages)) {
    echo json_encode(['error' => 'No messages provided']);
    exit;
}

$system_prompt = "You are a friendly and knowledgeable AI barista at Green Coffee Shop, a premium coffee shop in Saudi Arabia. 
You help customers choose drinks, explain brewing methods, describe flavor profiles, and share the story behind our ethically-sourced beans.

Our menu includes:
- HOT COFFEE: Signature Espresso ($3.50), Cappuccino ($4.50), Oat Milk Latte ($5.50), Pour-Over Single Origin ($6.00), Flat White ($4.75)
- COLD DRINKS: Cold Brew ($5.00), Iced Matcha Latte ($5.75), Vanilla Sweet Cream Iced Coffee ($5.50), Lavender Lemonade ($4.50)
- TEA & HERBAL: Chamomile Honey Tea ($4.00), Moroccan Mint Tea ($4.00)
- SPECIALTY: Turmeric Golden Latte ($5.50), Lavender Honey Latte ($6.00)
- FOOD: Butter Croissant ($3.50), Avocado Toast ($8.50), Blueberry Muffin ($3.00)

Be warm, enthusiastic about coffee, and give helpful personalized recommendations. Keep responses concise (2-4 sentences). 
If someone asks about something unrelated to coffee or the shop, kindly redirect them.";

$api_messages = [['role' => 'system', 'content' => $system_prompt]];
foreach ($messages as $msg) {
    if (in_array($msg['role'] ?? '', ['user', 'assistant'])) {
        $api_messages[] = ['role' => $msg['role'], 'content' => $msg['content']];
    }
}

$payload = json_encode([
    'model'       => 'gpt-3.5-turbo',
    'messages'    => $api_messages,
    'max_tokens'  => 300,
    'temperature' => 0.8
]);

$ch = curl_init('https://api.openai.com/v1/chat/completions');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $payload,
    CURLOPT_HTTPHEADER     => [
        'Content-Type: application/json',
        'Authorization: Bearer ' . OPENAI_API_KEY
    ],
    CURLOPT_TIMEOUT        => 30
]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($response === false) {
    echo json_encode(['error' => 'Failed to connect to AI service. Check your API key in includes/config.php']);
    exit;
}

$result = json_decode($response, true);

if (isset($result['choices'][0]['message']['content'])) {
    echo json_encode(['reply' => $result['choices'][0]['message']['content']]);
} elseif (isset($result['error'])) {
    echo json_encode(['error' => 'AI Error: ' . $result['error']['message']]);
} else {
    echo json_encode(['error' => 'Unexpected AI response. Check your OpenAI API key.']);
}
?>
