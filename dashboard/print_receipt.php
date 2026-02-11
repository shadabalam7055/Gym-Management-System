<?php
session_start();
include '../config/connection.php';

if (!isset($_SESSION['admin_logged_in'])) {
    die('Unauthorized');
}

$pid = $_GET['pid'] ?? '';

if (!$pid) {
    die('Invalid receipt');
}

/* payment + member data */
$stmt = $conn->prepare("
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
        m.name,
        m.mobile
    FROM payments p
    JOIN members m ON m.userid = p.userid
    WHERE p.payment_id = ?
");
$stmt->execute([$pid]);
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$rec) {
    die('Receipt not found');
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Receipt #<?= $rec['payment_id'] ?></title>

<style>
body {
    font-family: Arial, sans-serif;
}
.receipt {
    max-width: 420px;
    margin: auto;
    border: 1px dashed #333;
    padding: 15px;
}
h2 {
    text-align: center;
    margin-bottom: 5px;
}
hr {
    border: none;
    border-top: 1px dashed #333;
}
.row {
    display: flex;
    justify-content: space-between;
    margin: 4px 0;
}
.total {
    font-size: 18px;
    font-weight: bold;
}
.center {
    text-align: center;
}
@media print {
    button { display: none; }
}

.print-btn{
    background: #000;
    color: #fff;
    border: none;
    padding: 10px 22px;
    font-size: 15px;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.2s ease;
}

.print-btn i{
    margin-right: 6px;
}

.print-btn:hover{
    background: #222;
}
</style>
</head>

<body>

<div class="receipt">

<h2>Alan Fitness Club</h2>
<p class="center">Payment Receipt</p>
<hr>

<div class="row">
    <span>Receipt No:</span>
    <span>#<?= $rec['payment_id'] ?></span>
</div>

<div class="row">
    <span>Date:</span>
    <span><?= date('d M Y', strtotime($rec['payment_date'])) ?></span>
</div>

<hr>

<div class="row">
    <span>Name:</span>
    <span><?= htmlspecialchars($rec['name']) ?></span>
</div>

<div class="row">
    <span>Mobile:</span>
    <span><?= $rec['mobile'] ?></span>
</div>

<div class="row">
    <span>User ID:</span>
    <span><?= $rec['userid'] ?></span>
</div>

<hr>

<div class="row">
    <span>Fee Month:</span>
    <span><?= $rec['fee_month'] ?></span>
</div>

<div class="row">
    <span>Payment Mode:</span>
    <span><?= strtoupper($rec['payment_mode']) ?></span>
</div>

<hr>

<div class="row total">
    <span>Paid Amount:</span>
    <span>₹<?= $rec['paid'] ?></span>
</div>

<div class="row">
    <span>Status:</span>
    <span><?= strtoupper($rec['status']) ?></span>
</div>

<hr>

<p class="center">Thank you for your payment 💪</p>

<button class="print-btn" onclick="window.print()">
    <i class="fa fa-print"></i> Print Receipt
</button>

</div>

</body>
</html>