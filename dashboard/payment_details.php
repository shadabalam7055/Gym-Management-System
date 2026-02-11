<?php
session_start();
include '../config/connection.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}

$activepage = 'payments_details';

/* ================= PAID PAYMENTS ================= */
$paidPayments = $conn->query("
    SELECT 
        p.payment_id,
        p.userid,
        p.fee_month,
        p.amount,
        p.paid,
        p.pending,
        p.payment_mode,
        p.payment_date,
        p.status,
        m.name
    FROM payments p
    JOIN members m ON m.userid = p.userid
    WHERE p.paid > 0
    ORDER BY p.payment_date DESC
")->fetchAll(PDO::FETCH_ASSOC);


/* ================= UNPAID MEMBERS ================= */
$pendingMembers = $conn->query("
    SELECT 
        m.userid,
        m.name,
        GROUP_CONCAT(
            p.fee_month 
            ORDER BY p.fee_month 
            SEPARATOR ', '
        ) AS pending_months,
        SUM(p.amount - p.paid) AS total_pending
    FROM payments p
    JOIN members m ON m.userid = p.userid
    WHERE (p.amount - p.paid) > 0
    GROUP BY m.userid, m.name
")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Payment Details | Alan Fitness Club</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="assets/css/dashboard.css">
<link rel="stylesheet" href="assets/css/sidebar.css">
</head>

<body>
<div class="dashboard-wrapper">
<?php include 'partials/sidebar.php'; ?>

<div class="main-content">

<h4 class="fw-bold mb-3">💰 Payment Details</h4>

<!-- ================= PAID TABLE ================= -->
<div class="card mb-5">
<div class="card-header fw-bold text-success">
    ✅ Members Who Paid
</div>

<div class="table-responsive">
<table class="table table-bordered text-center align-middle mb-0">
<thead class="table-light">
<tr>
    <th>#</th>
    <th>Name</th>
    <th>UserID</th>
    <th>Month</th>
    <th>Amount</th>
    <th>Paid</th>
    <th>Pending</th>
    <th>Mode</th>
    <th>Date</th>
    <th>Status</th>
    <th>Receipt</th>
</tr>
</thead>

<tbody>
<?php if ($paidPayments): $i=1; foreach($paidPayments as $p): ?>
<tr>
<td><?= $i++ ?></td>
<td><?= htmlspecialchars($p['name']) ?></td>
<td><?= $p['userid'] ?></td>
<td><?= $p['fee_month'] ?></td>
<td>₹<?= $p['amount'] ?></td>
<td class="text-success fw-bold">₹<?= $p['paid'] ?></td>
<td class="text-danger">₹<?= $p['pending'] ?></td>
<td><?= strtoupper($p['payment_mode']) ?></td>
<td><?= $p['payment_date'] ?></td>
<td>
<span class="badge bg-<?= $p['status']=='paid'?'success':'warning' ?>">
<?= $p['status'] ?>
</span>
</td>
<td>
<a href="print_receipt.php?pid=<?= $p['payment_id'] ?>" 
   target="_blank"
   class="btn btn-sm btn-primary">
<i class="fa fa-print"></i>
</a>
</td>
</tr>
<?php endforeach; else: ?>
<tr>
<td colspan="11" class="text-muted">No paid records</td>
</tr>
<?php endif; ?>
</tbody>
</table>
</div>
</div>


<!-- ================= UNPAID TABLE ================= -->
<div class="card">
<div class="card-header fw-bold text-danger">
    ❌ Members With Pending Fees
</div>

<div class="table-responsive">
<table class="table table-bordered text-center align-middle mb-0">
<thead class="table-light">
<tr>
    <th>#</th>
    <th>Name</th>
    <th>UserID</th>
    <th>Pending Months</th>
    <th>Total Pending</th>
    <th>Status</th>
</tr>
</thead>

<tbody>
<?php if ($pendingMembers): $i=1; foreach($pendingMembers as $u): ?>
<tr>
<td><?= $i++ ?></td>
<td><?= htmlspecialchars($u['name']) ?></td>
<td><?= $u['userid'] ?></td>
<td><?= $u['pending_months'] ?></td>
<td class="text-danger fw-bold">₹<?= $u['total_pending'] ?></td>
</tr>
<?php endforeach; else: ?>
<tr>
<td colspan="5" class="text-muted">No pending members</td>
</tr>
<?php endif; ?>
</tbody>
</table>
</div>
</div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>