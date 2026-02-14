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

// मैसेज दिखाने के लिए खाली वेरिएबल्स बना लिए हैं
$profile_msg = $profile_err = "";
$pwd_msg = $pwd_err = "";
$add_msg = $add_err = "";

/* ===== PROFILE UPDATE ===== */
if (isset($_POST['update_profile'])) {
    $username = trim($_POST['name']); 
    $email = trim($_POST['email']);

    $up = $conn->prepare("UPDATE admin SET UserName=?, email=? WHERE id=?");
    if ($up->execute([$username, $email, $admin_id])) {
        $profile_msg = "Profile updated successfully!";
    } else {
        $profile_err = "Failed to update profile.";
    }
}

/* ===== CHANGE PASSWORD ===== */
if (isset($_POST['change_password'])) {
    $old = $_POST['old_password'];
    $new = $_POST['new_password'];

    // पासवर्ड चेक करने के लिए पहले करेंट पासवर्ड निकालें
    $check_stmt = $conn->prepare("SELECT password FROM admin WHERE id=?");
    $check_stmt->execute([$admin_id]);
    $current_admin = $check_stmt->fetch(PDO::FETCH_ASSOC);

    if (!password_verify($old, $current_admin['password'])) {
        $pwd_err = "Old password incorrect!";
    } else {
        $new_hashed_password = password_hash($new, PASSWORD_DEFAULT);
        
        $up = $conn->prepare("UPDATE admin SET password=? WHERE id=?");
        if ($up->execute([$new_hashed_password, $admin_id])) {
            $pwd_msg = "Password changed successfully!";
        } else {
            $pwd_err = "Failed to change password.";
        }
    }
}

/* ===== ADD NEW ADMIN ===== */
if (isset($_POST['add_admin'])) {
    $name = trim($_POST['new_name']); // अगर डेटाबेस में name का कॉलम है तो इसे भी इन्सर्ट क्वेरी में डाल सकते हैं
    $username = trim($_POST['new_username']);
    $email = trim($_POST['new_email']);
    $password = $_POST['new_password'];

    $check_stmt = $conn->prepare("SELECT id FROM admin WHERE UserName = ? OR email = ? LIMIT 1");
    $check_stmt->execute([$username, $email]);
    $existing_admin = $check_stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_admin) {
        $add_err = "Error: Username or Email already exists!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $ins = $conn->prepare("
            INSERT INTO admin (UserName, email, password)
            VALUES (?,?,?)
        ");

        if ($ins->execute([$username, $email, $hashed_password])) {
            $add_msg = "New admin added successfully!";
        } else {
            $add_err = "Failed to add new admin.";
        }
    }
}

// अपडेट के बाद ताज़ा डेटा निकालें ताकि फॉर्म में नया डेटा तुरंत दिखे
$stmt = $conn->prepare("SELECT * FROM admin WHERE id=?");
$stmt->execute([$admin_id]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);
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

<div class="col-md-6">
<div class="card mb-4">
<div class="card-header">Profile Settings</div>

<div class="card-body">
<form method="post">

<label>Username</label>
<input type="text" class="form-control mb-3"
name="name"
value="<?php echo htmlspecialchars($admin['UserName']); ?>" required>

<label>Email</label>
<input type="email" class="form-control mb-3"
name="email"
value="<?php echo htmlspecialchars($admin['email']); ?>" required>

<button class="btn btn-primary w-100" name="update_profile">
Update Profile
</button>

<?php if($profile_msg): ?>
    <div class="alert alert-success mt-3 mb-0 py-2"><?php echo $profile_msg; ?></div>
<?php endif; ?>
<?php if($profile_err): ?>
    <div class="alert alert-danger mt-3 mb-0 py-2"><?php echo $profile_err; ?></div>
<?php endif; ?>

</form>
</div>
</div>
</div>

<div class="col-md-6">
<div class="card mb-4">
<div class="card-header">Change Password</div>

<div class="card-body">
<form method="post">

<label>Old Password</label>
<input type="password" class="form-control mb-3"
name="old_password" required>

<label>New Password</label>
<input type="password" class="form-control mb-3"
name="new_password" required>

<button class="btn btn-warning w-100" name="change_password">
Change Password
</button>

<?php if($pwd_msg): ?>
    <div class="alert alert-success mt-3 mb-0 py-2"><?php echo $pwd_msg; ?></div>
<?php endif; ?>
<?php if($pwd_err): ?>
    <div class="alert alert-danger mt-3 mb-0 py-2"><?php echo $pwd_err; ?></div>
<?php endif; ?>

</form>
</div>
</div>
</div>

</div>


<div class="card">
<div class="card-header">Add New Admin</div>

<div class="card-body">
<form method="post">

<div class="row">

<div class="col-md-6 mb-3">
<label>Name</label>
<input type="text" class="form-control" name="new_name" required>
</div>

<div class="col-md-6 mb-3">
<label>Username</label>
<input type="text" class="form-control" name="new_username" required>
</div>

<div class="col-md-6 mb-3">
<label>Email</label>
<input type="email" class="form-control" name="new_email" required>
</div>

<div class="col-md-6 mb-3">
<label>Password</label>
<input type="password" class="form-control" name="new_password" required>
</div>

</div>

<button class="btn btn-success w-100" name="add_admin">
Add Admin
</button>

<?php if($add_msg): ?>
    <div class="alert alert-success mt-3 mb-0 py-2"><?php echo $add_msg; ?></div>
<?php endif; ?>
<?php if($add_err): ?>
    <div class="alert alert-danger mt-3 mb-0 py-2"><?php echo $add_err; ?></div>
<?php endif; ?>

</form>
</div>
</div>

</div>
</div>

</body>
</html>