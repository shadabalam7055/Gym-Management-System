<?php
include 'includes/auth.php';

$activepage = 'dashboard';

include '../config/connection.php';

// Show dashboard statistics
$total_members = $conn -> query("SELECT COUNT(*) FROM members");
$totalMembers = $total_members -> fetchColumn();

$active_members = $conn -> query("SELECT COUNT(*) FROM members WHERE status = 'active'");
$activeMembers = $active_members -> fetchColumn();

$pending_members = $conn -> query("SELECT COUNT(*) FROM payments WHERE pending > 0");
$pendingFees = $pending_members -> fetchColumn();

$total_collection = $conn -> query("SELECT SUM(paid) AS total FROM payments WHERE MONTH(payment_date) = MONTH(CURRENT_DATE()) AND YEAR(payment_date) = YEAR(CURRENT_DATE())");
$thisMonthCollection = $total_collection -> fetchColumn();

$recent_payments = $conn->query("
    SELECT p.*, m.name 
    FROM payments p
    JOIN members m ON p.userid = m.userid
    WHERE p.paid > 0
    ORDER BY p.payment_date DESC
    LIMIT 5
");

$recentPayments = $recent_payments->fetchAll(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Alan Fitness Club</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

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

        <!-- PAGE TITLE -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0">Dashboard</h3>
            <span class="fw-semibold text-dark">Welcome, <?php echo $_SESSION['admin_username']; ?></span>
        </div>

        <!-- STATS -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <h3><?php echo $totalMembers; ?></h3>
                    <p>Total Members</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <h3><?php echo $activeMembers; ?></h3>
                    <p>Active Members</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <h3><?php echo $pendingFees; ?></h3>
                    <p>Pending Fees</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <h3>₹ <?php echo number_format($thisMonthCollection); ?></h3>
                    <p>This Month Collection</p>
                </div>
            </div>
        </div>

        <!-- QUICK ACTIONS -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <a href="members.php" class="text-decoration-none text-dark">
                    <div class="action-card">
                        <i class="fa fa-user-plus mb-2"></i><br>
                        Add New Member
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="members.php" class="text-decoration-none text-dark">
                    <div class="action-card">
                        <i class="fa fa-sack-dollar mb-2"></i><br>
                        Collect Fees
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="enquiries.php" class="text-decoration-none text-dark">
                    <div class="action-card">
                        <i class="fa fa-envelope mb-2"></i><br>
                        View Enquiries
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="members.php" class="text-decoration-none text-dark">
                    <div class="action-card">
                        <i class="fa fa-users mb-2"></i><br>
                        View Members
                    </div>
                </a>
            </div>
        </div>

        

        <!-- RECENT PAYMENTS -->
<div class="card">
    <div class="card-header fw-bold">
        Recent Payments
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>S.R</th>
                    <th>User ID</th>
                    <th>Month</th>
                    <th>Amount</th>
                    <th>Paid</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
            <?php if (!empty($recentPayments)) {
                $i = 1;
                foreach ($recentPayments as $pay) { ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= htmlspecialchars($pay['userid']) ?></td>
                    <td><?= htmlspecialchars($pay['fee_month']) ?></td>
                    <td>₹<?= htmlspecialchars($pay['amount']) ?></td>
                    <td class="text-success">₹<?= htmlspecialchars($pay['paid']) ?></td>
                    <td>
                        <span class="badge bg-<?= $pay['status']=='paid' ? 'success' : 'warning' ?>">
                            <?= htmlspecialchars($pay['status']) ?>
                        </span>
                    </td>
                    <td><?= htmlspecialchars($pay['payment_date']) ?></td>
                </tr>
            <?php } } else { ?>
                <tr>
                    <td colspan="7" class="text-muted">No recent payments found</td>
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