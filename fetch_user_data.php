<?php 



include('config.php'); 


$id = "";

if(isset($_POST['id'])){
    $id = $_POST['id'];
}

$sql = "SELECT full_name FROM account WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_STR);

$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    echo $result['full_name']; 
} else {
    return null;
}

$conn = null;

?>