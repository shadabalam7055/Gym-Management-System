<?php

    include "config/connection.php";

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $purpose = trim($_POST['purpose'] ?? '');
    $message = trim($_POST['message'] ?? '');

    try {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO enquiries (name, email, mobile, purpose, message) VALUES (:name, :email, :phone, :purpose, :message)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':purpose', $purpose);
        $stmt->bindParam(':message', $message);

        // Execute the statement
        $stmt->execute();

        // Redirect back to contact page with success message
        header("Location: contact.php?success=1");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

?> 