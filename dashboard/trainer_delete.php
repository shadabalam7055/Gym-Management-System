<?php
session_start();
include '../config/connection.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'] ?? '';

if ($id) {
    $stmt = $conn->prepare("
        UPDATE trainers 
        SET status='inactive'
        WHERE id=?
    ");
    $stmt->execute([$id]);
}

header("Location: trainers.php");
exit;