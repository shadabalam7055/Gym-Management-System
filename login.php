<?php
session_start();
require_once 'config/connection.php';

$errors = [];
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '') {
        $errors['username'] = 'Username is required';
    }

    if ($password === '') {
        $errors['password'] = 'Password is required';
    }

    if (empty($errors)) {

        $stmt = $conn->prepare("SELECT * FROM admin WHERE UserName = ? LIMIT 1");
        $stmt->execute([$username]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && $admin['password'] === $password) {

    session_regenerate_id(true);

    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_id'] = $admin['id'];        // 👈 MAIN FIX
    $_SESSION['admin_username'] = $admin['UserName'];

    header("Location: dashboard/index.php");
    exit;
} else {
            $errors['general'] = 'Invalid username or password';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Alan Fitness Club</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #111827, #1f2937);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        .brand {
            color: #f97316;
            font-weight: 700;
        }
        .error-message {
            font-size: 0.875rem;
        }
    </style>
</head>

<body>

<div class="login-card">

    <div class="text-center mb-4">
        <h4 class="brand">Alan Fitness Club</h4>
        <p class="text-muted mb-0">Admin Login</p>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($errors['general'] ?? reset($errors)); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="" autocomplete="off">

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input
                type="text"
                name="username"
                class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>"
                value="<?php echo htmlspecialchars($username); ?>"
                autocomplete="off"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input
                type="password"
                name="password"
                class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>"
                autocomplete="new-password"
            >
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <div class="text-center mt-3">
        <small class="text-muted">© <?php echo date('Y'); ?> Alan Fitness Club</small>
    </div>

</div>

</body>
</html>