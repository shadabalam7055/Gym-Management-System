<?php
session_start();
include '../config/connection.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}

$activepage = 'settings';

if (!isset($_SESSION['admin_id'])) {
    echo "<script>alert('Session expired, please login again'); window.location='../login.php';</script>";
    exit;
}

$admin_id = $_SESSION['admin_id'];

// fetch current admin details
$stmt = $conn->prepare("SELECT * FROM admin WHERE id=?");
$stmt->execute([$admin_id]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

/* ===== UPDATE PROFILE ===== */
if (isset($_POST['update_profile'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];

    $up = $conn->prepare("UPDATE admin SET name=?, email=? WHERE id=?");
    $up->execute([$name, $email, $admin_id]);

    echo "<script>alert('Profile updated successfully'); window.location='settings.php';</script>";
}

/* ===== CHANGE PASSWORD ===== */
if (isset($_POST['change_password'])) {

    $old = $_POST['old_password'];
    $new = $_POST['new_password'];

    if ($old != $admin['password']) {
        echo "<script>alert('Old password incorrect');</script>";
    } else {
        $up = $conn->prepare("UPDATE admin SET password=? WHERE id=?");
        $up->execute([$new, $admin_id]);

        echo "<script>alert('Password changed successfully'); window.location='settings.php';</script>";
    }
}

/* ===== ADD NEW ADMIN ===== */
if (isset($_POST['add_admin'])) {

    $name = $_POST['new_name'];
    $username = $_POST['new_username'];
    $email = $_POST['new_email'];
    $password = $_POST['new_password'];

    $ins = $conn->prepare("
        INSERT INTO admin (username, email, password)
        VALUES (?,?,?)
    ");

    $ins->execute([$username, $email, $password]);
    echo "<script>alert('New admin added successfully'); window.location='settings.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Settings | Alan Fitness Club</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/sidebar.css">
<link rel="stylesheet" href="assets/css/dashboard.css">

</head>

<body>

<div class="dashboard-wrapper">

<?php include 'partials/sidebar.php'; ?>

<div class="main-content">

<h4 class="mb-3">⚙ Settings</h4>

<div class="row">

<!-- PROFILE UPDATE -->
<div class="col-md-6">
<div class="card mb-4">
<div class="card-header">Profile Settings</div>

<div class="card-body">
<form method="post">

<label>Name</label>
<input type="text" class="form-control mb-3"
name="name"
value="<?php echo $admin['UserName']; ?>">

<label>Email</label>
<input type="email" class="form-control mb-3"
name="email"
value="<?php echo $admin['email']; ?>">

<button class="btn btn-primary w-100"
name="update_profile">
Update Profile
</button>

</form>
</div>
</div>
</div>

<!-- PASSWORD CHANGE -->
<div class="col-md-6">
<div class="card mb-4">
<div class="card-header">Change Password</div>

<div class="card-body">
<form method="post">

<label>Old Password</label>
<input type="password" class="form-control mb-3"
name="old_password">

<label>New Password</label>
<input type="password" class="form-control mb-3"
name="new_password">

<button class="btn btn-warning w-100"
name="change_password">
Change Password
</button>

</form>
</div>
</div>
</div>

</div>


<!-- ADD NEW ADMIN -->
<div class="card">
<div class="card-header">Add New Admin</div>

<div class="card-body">
<form method="post">

<div class="row">

<div class="col-md-6 mb-3">
<label>Name</label>
<input type="text" class="form-control" name="new_name">
</div>

<div class="col-md-6 mb-3">
<label>Username</label>
<input type="text" class="form-control" name="new_username">
</div>

<div class="col-md-6 mb-3">
<label>Email</label>
<input type="email" class="form-control" name="new_email">
</div>

<div class="col-md-6 mb-3">
<label>Password</label>
<input type="password" class="form-control" name="new_password">
</div>

</div>

<button class="btn btn-success w-100" name="add_admin">
Add Admin
</button>

</form>
</div>
</div>

</div>
</div>

</body>
</html>