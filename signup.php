
<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $Fullname = htmlspecialchars($_POST["full_name"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $confirm_password = htmlspecialchars($_POST["confirm_password"]);

    if($password == $confirm_password){
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    }
    else
    {
        echo "Password and Confirm Password is not the same.";
        exit;
    }

    

    $stmt_check = $conn->prepare("SELECT email FROM account WHERE email = :email");
    $stmt_check->bindParam(':email', $email);
    $stmt_check->execute();

    if ($stmt_check->rowCount() > 0) {
        echo "This email already have an account.";
    } else {

        $stmt_insert = $conn->prepare("INSERT INTO account (`full_name`, `email`, `password` ) VALUES (:full_name, :email, :password)");
        $stmt_insert->bindParam(':full_name', $Fullname);
        $stmt_insert->bindParam(':email', $email);
        $stmt_insert->bindParam(':password', $password);

        try {
            if ($stmt_insert->execute()) {

                echo "Success";
            } else {
                echo "Registration failed. Please try again later.";
            }
        } catch (PDOException $e) {
            error_log("Error during registration: " . $e->getMessage());
            echo "An error occurred during registration. Please try again later.";
        }
    }
} else {

    echo "Invalid request method.";
}
?>
