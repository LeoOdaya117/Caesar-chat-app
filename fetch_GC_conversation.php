<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login_page.html");
    exit();
}

include('config.php');
include('functions.php');
$gc_name = "";
$gc_id = "";
if (!isset($_GET['GC_NAME'])) {
    // Handle error: Contact ID not provided
    echo json_encode(array('error' => 'Contact ID not provided'));
    exit();
}
else{
    $gc_name = $_GET['GC_NAME'];
    $gc_id = getGCId($gc_name);
}

// Fetch conversation between the current user and the specified contact
$userId = $_SESSION['id'];

$sql = "SELECT * FROM gc_chat_history WHERE gc_id =$gc_id   ORDER BY send_datetime ASC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$conversation = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if there are no rows in the conversation
if (count($conversation) == 0) {
    echo json_encode("No_Record");
} else {
    echo json_encode($conversation);
}


?>
