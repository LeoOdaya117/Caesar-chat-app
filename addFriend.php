
<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login_page.html");
    exit();
}
include("config.php");
include("functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userId = $_SESSION['id'];
    if(isset($_POST["nameInput"])){
        $nameInput = $_POST["nameInput"];

    }
    else{
        echo "No given value.";
    }

    $userId = $_SESSION['id']; 
    $id = getUserIdByFullName($nameInput);

    if($id == "Not_Found"){
        echo "User not Found";
        exit;
    }else{
        $stmt_check = $conn->prepare("SELECT friend_id FROM friend_list WHERE friend_id = :friend_id AND `user_id` =:user_id");
        $stmt_check->bindParam(':friend_id', $id);
        $stmt_check->bindParam(':user_id', $userId);
        $stmt_check->execute();
    
        if ($stmt_check->rowCount() > 0) {
            echo "This user is already in your contact list";
        } else {
    
            $stmt_insert = $conn->prepare("INSERT INTO `friend_list` (`user_id`, `friend_id`) VALUES (:user_id, :friend_id)");
            $stmt_insert->bindParam(':user_id', $userId);
            $stmt_insert->bindParam(':friend_id', $id);
    
            try {
                if ($stmt_insert->execute()) {
    
                    echo "Success";
                } else {
                    echo "Adding Error. Please try again later.";
                }
            } catch (PDOException $e) {
                error_log("Error during registration: " . $e->getMessage());
                echo $e->getMessage();
            }
        }
    }

    
} else {

    echo "Invalid request method.";
}


?>
