<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$botToken = "ISI_TOKEN_BOT";  // ← Ganti token bot kamu
$chatId   = "ISI_CHAT_ID";    // ← Ganti chat ID kamu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $message = $data['message'] ?? '';

    $url = "https://api.telegram.org/bot".$botToken."/sendMessage";
    $fields = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => 'HTML'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    $response = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo json_encode(["code" => $code, "response" => $response]);
} else {
    echo json_encode(["error" => "Gunakan POST"]);
}
?>