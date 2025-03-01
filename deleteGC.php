<?php 

include("config.php");
include("functions.php");

$gc_name ="";
$gc_id ="";
if($_POST['gc_name']){
    $gc_name = $_POST['gc_name'];
    $gc_id = getGCId($gc_name);
}
else
{
    exit;
}

//DELETE FROM GC TABLE
$sql = "DELETE FROM `gc` WHERE id = :id";
$stmt1 = $conn->prepare($sql);
$stmt1->bindParam(':id', $gc_id, PDO::PARAM_INT);


//DELETE IN USER GC LIST
$sql = "DELETE FROM `user_gc` WHERE gc_id = :id";
$stmt2 = $conn->prepare($sql);
$stmt2->bindParam(':id', $gc_id, PDO::PARAM_INT);


//DELETE CHAT HISTORY
$sql = "DELETE FROM `gc_chat_history` WHERE gc_id = :id";
$stmt3 = $conn->prepare($sql);
$stmt3->bindParam(':id', $gc_id, PDO::PARAM_INT);


if($stmt1->execute() && $stmt2->execute() && $stmt3->execute())
{
    echo "Success";
}
else{
    echo "Something went wrong!";
}


?>