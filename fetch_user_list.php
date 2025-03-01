<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login_page.html");
    exit();
}
include('config.php');

$userid = $_SESSION['id'];

$sql = "SELECT account.full_name, account.status
FROM account
JOIN friend_list ON account.id = friend_list.friend_id
WHERE friend_list.user_id = $userid

UNION

SELECT account.full_name, account.status
FROM account
JOIN friend_list ON account.id = friend_list.user_id
WHERE friend_list.friend_id = $userid

ORDER BY full_name ASC
;
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
