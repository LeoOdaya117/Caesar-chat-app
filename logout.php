
<?php
session_start();
include("config.php");

$status = "Offline";

$stmt = $conn->prepare("UPDATE `account` SET `status`=:status WHERE `id` =  :id");
$stmt->bindParam(':status', $status);
$stmt->bindParam(':id', $_SESSION['id']);
$stmt->execute();



unset($_SESSION['id']);
session_destroy();
header("Location: login_page.html");
?>
