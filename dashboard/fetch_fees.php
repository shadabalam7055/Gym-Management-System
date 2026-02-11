<?php
session_start();
include '../config/connection.php';

header('Content-Type: application/json');

$userid = $_POST['userid'] ?? '';

if ($userid === '') {
    echo json_encode(['error' => 'no userid']);
    exit;
}

/* member info */
$stmt = $conn->prepare("SELECT monthly_fees FROM members WHERE userid=?");
$stmt->execute([$userid]);
$member = $stmt->fetch(PDO::FETCH_ASSOC);

// ===== AUTO GENERATE PAYMENTS FOR NEW MEMBER =====
$join = $conn->prepare("SELECT join_date FROM members WHERE userid=?");
$join->execute([$userid]);
$join_date = $join->fetchColumn();

$start = new DateTime(date('Y-m-01', strtotime($join_date)));
$end   = new DateTime(date('Y-m-01'));

while ($start <= $end) {

    $month = $start->format('Y-m');

    $chk = $conn->prepare("SELECT payment_id FROM payments WHERE userid=? AND fee_month=?");
    $chk->execute([$userid, $month]);

    if (!$chk->fetch()) {

        $ins = $conn->prepare("
            INSERT INTO payments 
            (userid, fee_month, amount, paid, pending, status)
            VALUES (?, ?, ?, 0, ?, 'unpaid')
        ");

        $ins->execute([
            $userid,
            $month,
            $member['monthly_fees'],
            $member['monthly_fees']
        ]);
    }

    $start->modify('+1 month');
}

if (!$member) {
    echo json_encode(['error' => 'invalid user']);
    exit;
}

/* total pending amount */
$stmt2 = $conn->prepare("
    SELECT COALESCE(SUM(pending),0)
    FROM payments
    WHERE userid=? AND status!='paid'
");
$stmt2->execute([$userid]);
$pending = $stmt2->fetchColumn();

/* ALL pending months (IMPORTANT PART) */
$stmt3 = $conn->prepare("
    SELECT fee_month
    FROM payments
    WHERE userid=? AND status!='paid'
    ORDER BY fee_month ASC
");
$stmt3->execute([$userid]);
$months = $stmt3->fetchAll(PDO::FETCH_COLUMN);

echo json_encode([
    'monthly_fees' => $member['monthly_fees'],
    'pending'      => $pending,
    'months'       => $months
]);
exit;