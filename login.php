
<?php
  session_start();
  include("config.php");

    $status = "Offline";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login_username = $_POST["login-username"];
        $password = $_POST["login-password"];

        $stmt = $conn->prepare("SELECT * FROM account WHERE email = :email");
        $stmt->bindParam(':email', $login_username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $rowCount = $stmt->rowCount();
        if($rowCount < 1){
            echo "Account Not Found.";
        }
        else{
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['Email'] = $login_username;
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['Photo'] = $user['photo'];
                $status = "Active";
                echo "Success";

                $stmt = $conn->prepare("UPDATE `account` SET `status`=:status WHERE `email` =  :email");
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':email', $login_username);
                $stmt->execute();
            }
            else {

                echo "Invalid username or password!";
        
            }
        }

    }
    else{
        echo "No data provided.";
    }
    
        



?>


