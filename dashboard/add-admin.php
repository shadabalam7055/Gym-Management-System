<?php
    include "../config/connection.php";
    session_start();

    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: ../login.php');
        exit();
    }

    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    // Comprehensive validation
    $errors = [];

    if (empty($username)) {
        $errors[] = "Username is required.";
    } elseif (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $errors[] = "Username can only contain letters, numbers, and underscores.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    if (empty($confirm_password)) {
        $errors[] = "Password confirmation is required.";
    } elseif ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // If there are validation errors, redirect back with errors
    if (!empty($errors)) {
        $error_string = implode('|', array_map('urlencode', $errors));
        header("Location: settings.php?admin_errors=" . $error_string);
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    try {
        // Check if username or email already exists
        $check_stmt = $conn->prepare("SELECT COUNT(*) FROM admin WHERE UserName = ? OR email = ?");
        $check_stmt->execute([$username, $email]);
        $count = $check_stmt->fetchColumn();

        if ($count > 0) {
            header("Location: settings.php?admin_errors=" . urlencode("Username or email already exists."));
            exit();
        }

        // Prepare and bind for insertion
        $stmt = $conn->prepare("INSERT INTO admin (UserName, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashed_password]);

        // Redirect back to settings page with success message
        header("Location: settings.php?admin_added=1");
        exit();
    } catch (PDOException $e) {
        // Log the error and show user-friendly message
        error_log("Database error in add-admin.php: " . $e->getMessage());
        header("Location: settings.php?admin_errors=" . urlencode("Database error occurred. Please try again."));
        exit();
    }
?>