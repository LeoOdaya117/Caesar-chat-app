
<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login_page.html");
    exit();
}
include("config.php");
include("functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    

    $username = $_POST['username']; 
    $gc_name = $_POST['gc_name']; 
    $gc_id = getGCId($gc_name);
    
    $id = getUserIdByFullName($username);

    if($id == "Not_Found"){
        echo "User not Found";
        exit;
    }else{
        $stmt_check = $conn->prepare("SELECT user_id FROM user_gc WHERE user_id = :user_id AND `gc_id` =:gc_id");
        $stmt_check->bindParam(':user_id', $id);
        $stmt_check->bindParam(':gc_id', $gc_id);
        $stmt_check->execute();
    
        if ($stmt_check->rowCount() > 0) {
            echo "This user is already in the gc";
        } else {
    
            $stmt_insert = $conn->prepare("INSERT INTO `user_gc` (`user_id`, `gc_id`) VALUES (:user_id, :gc_id)");
            $stmt_insert->bindParam(':user_id', $id);
            $stmt_insert->bindParam(':gc_id', $gc_id);
    
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
