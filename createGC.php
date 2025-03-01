
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
    $gc_name ="";
    $gc_id = "";
    if(isset($_POST["name_of_gc"])){
        $gc_name = $_POST["name_of_gc"];
        $gc_id = getGCId($gc_name);
        
    }
    else{
        echo "No given value.";
        exit;
    }

   
    $stmt_check = $conn->prepare("SELECT gc_name FROM gc WHERE gc_name = :gc_name");
    $stmt_check->bindParam(':gc_name', $gc_name);
    $stmt_check->execute();

    if ($stmt_check->rowCount() > 0) {
        echo "This GC already exist";
    } else {

        $stmt_insert = $conn->prepare("INSERT INTO `gc` (`gc_name`) VALUES (:gc_name)");
        $stmt_insert->bindParam(':gc_name', $gc_name);

        try {
            if ($stmt_insert->execute()) {
                $id = getGCId($gc_name);
                if($id == "Not_Found"){
                    echo "Not_Found";
                    exit;
                }
                $stmt_insert_userGC = $conn->prepare("INSERT INTO `user_gc` (`user_id`, `gc_id`) VALUES (:user_id, :gc_id)");
                $stmt_insert_userGC->bindParam(':user_id', $userId);
                $stmt_insert_userGC->bindParam(':gc_id', $id);

                if($stmt_insert_userGC->execute()){
                    echo "Success";
                }
                
            } else {
                echo "Adding Error. Please try again later.";
            }
        } catch (PDOException $e) {
            error_log("Error during registration: " . $e->getMessage());
            echo $e->getMessage();
        }
    }

    
} else {

    echo "Invalid request method.";
}


?>
