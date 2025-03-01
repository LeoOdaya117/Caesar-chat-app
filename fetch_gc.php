<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login_page.html");
    exit();
}
include('config.php');

if(isset($_POST['gc_name'])){
    $gc_name = $_POST['gc_name'];
}

$sql = "SELECT gc_name FROM gc WHERE gc_name = :gc_name";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':gc_name', $gc_name, PDO::PARAM_STR);
$stmt->execute();


// Prepare data for JSON response
$accounts = [];
if ($stmt->rowCount() > 0) {
   
    echo 'True'; 
}
else{
    echo 'False'; 
}



$conn = null;
?>
