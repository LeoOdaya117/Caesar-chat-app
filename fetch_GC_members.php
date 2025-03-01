<?php
include('config.php');
include('functions.php');

$gc_name ="";
$gc_id = "";
if(isset($_POST['gc_name'])){
    $gc_name = $_POST['gc_name'];
    $gc_id = getGCId($gc_name);
}

$data = array();

if ($gc_id != "") {
    // Prepare and execute the SQL query
    $sql = "SELECT user_gc.user_id, account.full_name
            FROM user_gc
            INNER JOIN account ON user_gc.user_id = account.id
            WHERE user_gc.gc_id = :gc_id
            ORDER BY account.full_name";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':gc_id', $gc_id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        // Fetch results and add them to the data array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
    } else {
        // Handle execution errors
        $data['error'] = "Error executing SQL query";
    }
} else {
    // Handle missing or invalid gc_id
    $data['error'] = "Invalid or missing gc_id";
}

// Set response headers and echo JSON-encoded data
header('Content-Type: application/json');
echo json_encode($data);

// Close the database connection
$conn = null;
?>
