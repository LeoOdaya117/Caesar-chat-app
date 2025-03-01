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
$full_name  = $_SESSION['full_name'];
$message = $_POST['message'];
$gc_name = $_POST['gc_name'];
$gc_id =getGCId($gc_name);
$datetime = date('Y-m-d H:i:s');


//Encrypting the message
$message = encryptMessage($message, 3);

$sql = "INSERT INTO gc_chat_history ( `user_id`, `full_name`,`message`, `send_datetime`, `gc_id`) VALUES (:user_id, :full_name, :message, :send_datetime, :gc_id)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
$stmt->bindParam(':full_name', $full_name, PDO::PARAM_STR);
$stmt->bindParam(':message', $message, PDO::PARAM_STR);
$stmt->bindParam(':send_datetime', $datetime, PDO::PARAM_STR);
$stmt->bindParam(':gc_id', $gc_id, PDO::PARAM_STR);
$result = $stmt->execute();

if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('error' => 'Failed to send message'));
}

$conn = null;


?>
