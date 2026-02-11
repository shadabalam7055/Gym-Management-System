<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}

include '../config/connection.php';

// DELETE ENQUIRY
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $stmt = $conn->prepare("DELETE FROM enquiries WHERE id = ?");
    $stmt->execute([$delete_id]);

    header("Location: enquiries.php");
    exit;
}

// Show Enquiries List
$enq_stmt = $conn -> prepare("SELECT * FROM enquiries ORDER BY id DESC");
$enq_stmt -> execute();
$enquiries = $enq_stmt -> fetchAll(PDO::FETCH_ASSOC);

$activepage = 'enquiries';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enquiries | Alan Fitness Club</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>

<div class="dashboard-wrapper">

    <!-- SIDEBAR -->
    <?php include 'partials/sidebar.php'; ?>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <!-- HEADER -->
        <div class="mb-4">
            <h4 class="fw-bold mb-0">Enquiries</h4>
            <small class="text-muted">Contact & demo enquiries list</small>
        </div>

        <!-- ENQUIRIES TABLE -->
        <div class="card">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>S.R.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Purpose</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th width="80">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($enquiries)) {
                            $i = 1;
                            foreach ($enquiries as $enquiry) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($i++); ?></td>
                            <td><?php echo htmlspecialchars($enquiry['name']); ?></td>
                            <td><?php echo htmlspecialchars($enquiry['email']); ?></td>
                            <td><?php echo htmlspecialchars($enquiry['mobile']); ?></td>
                            <td><?php echo htmlspecialchars($enquiry['purpose']); ?></td>
                            <td><?php echo htmlspecialchars($enquiry['message']); ?></td>
                            <td><?php echo htmlspecialchars($enquiry['time']); ?></td>
                            <td>
                               <a href="enquiries.php?delete_id=<?= $enquiry['id'] ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this enquiry?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>

</body>
</html>
