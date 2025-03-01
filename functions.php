<?php 


function encryptMessage($message, $shift) {
    $encryptedMessage = '';
    
    for ($i = 0; $i < strlen($message); $i++) {
        $charCode = ord($message[$i]);
        $encryptedChar = '';

        if (ctype_alpha($message[$i])) {
            if (ctype_lower($message[$i])) {
                $baseCharCode = 97;
            } else {
                $baseCharCode = 65;
            }
            $encryptedChar = chr((($charCode - $baseCharCode + $shift) % 26) + $baseCharCode);
        } elseif (is_numeric($message[$i])) {
            $encryptedChar = chr((($charCode - 48 + $shift) % 10) + 48);
        } else {
            $encryptedChar = $message[$i];
        }

        $encryptedMessage .= $encryptedChar;
    }
    
    return $encryptedMessage;
}

function decryptMessage($encryptedMessage, $shift) {
    $decryptedMessage = '';
    
    for ($i = 0; $i < strlen($encryptedMessage); $i++) {
        $charCode = ord($encryptedMessage[$i]);
        $decryptedChar = '';

        if (ctype_alpha($encryptedMessage[$i])) {
            if (ctype_lower($encryptedMessage[$i])) {
                $baseCharCode = 97;
            } else {
                $baseCharCode = 65;
            }
            $decryptedChar = chr((($charCode - $baseCharCode - $shift + 26) % 26) + $baseCharCode);
        } elseif (is_numeric($encryptedMessage[$i])) {
            $decryptedChar = chr((($charCode - 48 - $shift + 10) % 10) + 48);
        } else {
            $decryptedChar = $encryptedMessage[$i];
        }

        $decryptedMessage .= $decryptedChar;
    }
    
    return $decryptedMessage;
}

function getUserIdByFullName($fullName) {
    include('config.php'); 


    $sql = "SELECT id FROM account WHERE full_name = :fullName";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':fullName', $fullName, PDO::PARAM_STR);
    
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result['id']; 
    } else {
        return 'Not_Found';
    }
    
    $conn = null;
}

function getNameByID($id) {
    include('config.php'); 


    $sql = "SELECT full_name FROM account WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result['full_name']; 
    } else {
        return 'Not_Found';
    }
    
    $conn = null;
}

function getGCId($name) {
    include('config.php'); 


    $sql = "SELECT id FROM gc WHERE gc_name = :gc_name";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':gc_name', $name, PDO::PARAM_STR);
    
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result['id']; 
    } else {
        return 'Not_Found';
    }
    
    $conn = null;
}

// Test
// $message = "Leo 2024 Malupet";
// $shift = 3;
// $encryptedMessage = encryptMessage($message, $shift);
// $decryptedMessage = decryptMessage($encryptedMessage, $shift);

// echo "Encrypted message: " . $encryptedMessage . "<br>";
// echo "Decrypted message: " . $decryptedMessage;

?>