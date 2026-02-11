<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Admin Dashboard | Alan Fitness Club</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css'>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap' rel='stylesheet'>
</head>
<body>
    <div class='container mt-5'>
        <div class='row'>
            <div class='col-12'>
                <div class='card'>
                    <div class='card-header'>
                        <h4>Admin Dashboard</h4>
                    </div>
                    <div class='card-body'>
                        <p>Welcome to the admin dashboard!</p>
                        <p>You are logged in as: <?php echo htmlspecialchars($_SESSION['admin_username']); ?></p>
                        <a href='../logout.php' class='btn btn-danger'>Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
