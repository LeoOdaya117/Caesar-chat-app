<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login_page.html");
    exit();
}

include('config.php');
include('functions.php');
// Check if the contact ID is provided
if (!isset($_GET['contactId'])) {
    // Handle error: Contact ID not provided
    echo json_encode(array('error' => 'Contact ID not provided'));
    exit();
}

// Fetch conversation between the current user and the specified contact
$userId = $_SESSION['id'];
$contactId = getUserIdByFullName($_GET['contactId']);

$sql = "SELECT ch.id, ch.user_id, ch.message, ch.message_to_id, ch.send_datetime, a.full_name AS recipient_name
        FROM chathistory ch
        INNER JOIN account a ON ch.user_id = a.id
        WHERE (ch.user_id = :userId AND ch.message_to_id = :contactId)
        OR (ch.user_id = :contactId AND ch.message_to_id = :userId)
        ORDER BY ch.send_datetime ASC";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
$stmt->bindValue(':contactId', $contactId, PDO::PARAM_INT);
$stmt->execute();
$conversation = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if there are no rows in the conversation
if (count($conversation) == 0) {
    echo json_encode("No_Record");
} else {
    echo json_encode($conversation);
}


?>
