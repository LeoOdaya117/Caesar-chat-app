<?php
session_start();

if (!isset($_SESSION['id'])) {
    
    echo json_encode(array('error' => 'User not logged in'));
    exit();
}

include('config.php');
include('functions.php');
date_default_timezone_set('Asia/Manila');
$userId = $_SESSION['id'];

$message = $_POST['message'];
$recipient = $_POST['recipient'];
$recipient = getUserIdByFullName($recipient);
$datetime = date('Y-m-d H:i:s');


//Encrypting the message
$message = encryptMessage($message, 3);

$sql = "INSERT INTO chathistory ( `user_id`, `message`, `message_to_id`, `send_datetime`) VALUES (:user_id, :message, :message_to_id, :send_datetime)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
$stmt->bindParam(':message', $message, PDO::PARAM_STR);
$stmt->bindParam(':message_to_id', $recipient, PDO::PARAM_INT);
$stmt->bindParam(':send_datetime', $datetime, PDO::PARAM_STR);
$result = $stmt->execute();

if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('error' => 'Failed to send message'));
}

$conn = null;


?>
