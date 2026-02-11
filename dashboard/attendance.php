<?php
session_start();
include '../config/connection.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}

$activepage = 'attendance';
$dateToday = date('Y-m-d');

/* ============== MARK ATTENDANCE ============== */
if (isset($_POST['mark_attendance'])) {

    $userid = $_POST['userid'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("
        INSERT INTO attendance (userid, date, status)
        VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE status=?
    ");

    $stmt->execute([$userid, $dateToday, $status, $status]);

    // echo "<script>alert('Attendance marked successfully');</script>";
}

/* ============== FETCH MEMBERS ============== */
$members = $conn->query("
    SELECT userid, name, mobile 
    FROM members 
    WHERE status='active'
")->fetchAll(PDO::FETCH_ASSOC);

/* ============== TODAY ATTENDANCE ============== */
$attendanceToday = $conn->prepare("
    SELECT * FROM attendance WHERE date=?
");
$attendanceToday->execute([$dateToday]);
$todayRecords = $attendanceToday->fetchAll(PDO::FETCH_ASSOC);

$attendanceMap = [];

foreach ($todayRecords as $rec) {
    $attendanceMap[$rec['userid']] = $rec['status'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Attendance | Alan Fitness Club</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="assets/css/dashboard.css">
<link rel="stylesheet" href="assets/css/sidebar.css">
</head>

<body>

<div class="dashboard-wrapper">

<?php include 'partials/sidebar.php'; ?>

<div class="main-content">

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Attendance - <?= date('d M Y') ?></h4>

    <button class="btn btn-outline-primary"
            data-bs-toggle="modal"
            data-bs-target="#monthlyRecordModal">
        View Monthly Record
    </button>
</div>

<div class="card">
<div class="table-responsive">
<table class="table table-bordered text-center align-middle">
<thead class="table-light">
<tr>
    <th>S.R.</th>
    <th>Name</th>
    <th>Mobile</th>
    <th>Attendance</th>
</tr>
</thead>

<tbody>

<?php $i=1; foreach($members as $m): ?>

<tr>
<td><?= $i++ ?></td>
<td><?= htmlspecialchars($m['name']) ?></td>
<td><?= htmlspecialchars($m['mobile']) ?></td>

<td>
<form method="post">

<input type="hidden" name="userid" value="<?= $m['userid'] ?>">
<input type="hidden" name="mark_attendance" value="1">

<?php 
$marked = $attendanceMap[$m['userid']] ?? null;
?>

<?php if ($marked == 'present'): ?>

<span class="text-success fw-bold">
<i class="fa fa-check-circle"></i> Present
</span>

<?php elseif ($marked == 'absent'): ?>

<span class="text-danger fw-bold">
<i class="fa fa-times-circle"></i> Absent
</span>

<?php else: ?>

<button name="status" value="present" class="btn btn-success btn-sm">
Present
</button>

<button name="status" value="absent" class="btn btn-danger btn-sm">
Absent
</button>

<?php endif; ?>

</form>
</td>

</tr>

<?php endforeach; ?>

</tbody>
</table>
</div>
</div>

</div>
</div>

<!-- ========== MONTHLY REPORT MODAL ========== -->
<div class="modal fade" id="monthlyRecordModal">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Monthly Attendance Report</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<table class="table table-bordered text-center">

<thead>
<tr>
<th>Name</th>
<th>Total Days</th>
<th>Present</th>
<th>Absent</th>
<th>%</th>
</tr>
</thead>

<tbody>

<?php

$report = $conn->query("
SELECT 
    m.name,
    COUNT(a.id) as total,
    SUM(CASE WHEN a.status='present' THEN 1 ELSE 0 END) as present,
    SUM(CASE WHEN a.status='absent' THEN 1 ELSE 0 END) as absent
FROM attendance a
JOIN members m ON m.userid = a.userid
GROUP BY m.userid
")->fetchAll();

foreach($report as $r):

$percent = $r['total'] > 0 
    ? round(($r['present'] / $r['total']) * 100)
    : 0;
?>

<tr>
<td><?= htmlspecialchars($r['name']) ?></td>
<td><?= $r['total'] ?></td>
<td class="text-success"><?= $r['present'] ?></td>
<td class="text-danger"><?= $r['absent'] ?></td>
<td><b><?= $percent ?>%</b></td>
</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>