<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login_page.html");
    exit();
}
include('config.php');

$userid = $_SESSION['id'];

$sql = "SELECT gc.gc_name
FROM user_gc
JOIN gc ON user_gc.gc_id = gc.id
WHERE user_gc.user_id = $userid;
";
$stmt = $conn->query($sql);

// Prepare data for JSON response
$accounts = [];
if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $accounts[] = $row; // Include both full_name and status
    }
}

header('Content-Type: application/json');
echo json_encode($accounts);

$conn = null;
?>
