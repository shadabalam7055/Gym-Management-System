<?php

session_start();
include '../config/connection.php';



$activepage = 'members';



/* ================= AUTH ================= */
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}


/* ================= ADD MEMBER ================= */
if (isset($_POST['add_member'])) {

    $name   = $_POST['memberName'];
    $mobile = $_POST['mobileNumber'];
    $fees   = $_POST['monthlyFees'];
    $join   = $_POST['joiningDate'];
    $status = strtolower($_POST['status']);

    // userid generate
    $last = $conn->query("SELECT id FROM members ORDER BY id DESC LIMIT 1")->fetch();
    $next = $last ? $last['id'] + 1 : 1;
    $userid = "AFC" . str_pad($next, 3, "0", STR_PAD_LEFT);

    $stmt = $conn->prepare("
        INSERT INTO members (userid, name, mobile, monthly_fees, join_date, status)
        VALUES (?,?,?,?,?,?)
    ");
    $stmt->execute([$userid, $name, $mobile, $fees, $join, $status]);

    echo "<script>alert('Member added successfully');</script>";
}

if (isset($_POST['update_member'])) {

    $id     = $_POST['edit_id'];
    $name   = $_POST['edit_name'];
    $mobile = $_POST['edit_mobile'];
    $fees   = $_POST['edit_fees'];
    $status = $_POST['edit_status'];

    $stmt = $conn->prepare("
        UPDATE members 
        SET name=?, mobile=?, monthly_fees=?, status=?
        WHERE id=?
    ");
    $stmt->execute([$name, $mobile, $fees, $status, $id]);

    echo "<script>alert('Member updated successfully');location.href='members.php';</script>";
}

if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];

    $stmt = $conn->prepare("
        UPDATE members SET status='inactive' WHERE id=?
    ");
    $stmt->execute([$id]);

    echo "<script>alert('Member deactivated');location.href='members.php';</script>";
}

/* ================= COLLECT FEES ================= */
if (isset($_POST['save_payment'])) {

    $userid = $_POST['userid'];
    $pay    = (int)$_POST['pay_amount'];
    $mode   = $_POST['payment_mode'];

    $stmt = $conn->prepare("
        SELECT payment_id, amount, paid
        FROM payments
        WHERE userid=? AND (amount - paid) > 0
        ORDER BY fee_month ASC
    ");
    $stmt->execute([$userid]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$rows) {
        echo "<script>alert('No pending fees');</script>";
        exit;
    }

    foreach ($rows as $row) {

        if ($pay <= 0) break;

        $due = $row['amount'] - $row['paid'];

        if ($pay >= $due) {
            // full clear this month
            $paidNow = $row['paid'] + $due;
            $pending = 0;
            $status  = 'paid';
            $pay    -= $due;
        } else {
            // partial
            $paidNow = $row['paid'] + $pay;
            $pending = $row['amount'] - $paidNow;
            $status  = 'partial';
            $pay     = 0;
        }

        $up = $conn->prepare("
            UPDATE payments SET
                paid=?,
                pending=?,
                status=?,
                payment_mode=?,
                payment_date=CURDATE()
            WHERE payment_id=?
        ");
        $up->execute([
            $paidNow,
            $pending,
            $status,
            $mode,
            $row['payment_id']
        ]);
    }

    echo "<script>alert('Payment adjusted successfully');</script>";
}
/* ================= FETCH MEMBERS ================= */
$members = $conn->query("SELECT * FROM members WHERE status='active' ORDER BY id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Members | Alan Fitness Club</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/members.css">
</head>

<body>

<div class="dashboard-wrapper">

    <!-- SIDEBAR -->
    <?php include 'partials/sidebar.php'; ?>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0">Members</h4>
                <small class="text-muted">Fees management & member records</small>
            </div>

            <div class="d-flex gap-2">

                <button class="btn btn-success"
                        data-bs-toggle="modal"
                        data-bs-target="#collectFeesModal">
                    <i class="fa fa-money-bill-wave"></i> Collect Fees
                </button>

                <button class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#addMemberModal">
                    <i class="fa fa-user-plus"></i> Add Member
                </button>
            </div>
        </div>

        <!-- MEMBERS TABLE -->
        <div class="card">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>S.R.</th>
                            <th>User id</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Monthly Fees</th>
                            <th>Joining Date</th>
                            <th>Status</th>
                            <th width="130">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($members)) {
                            $i = 1;
                            foreach ($members as $member) { ?>
                        
                        <tr>
                            <td><?php echo htmlspecialchars($member['id']); ?></td>
                            <td><?php echo htmlspecialchars($member['userid']); ?></td>
                            <td><?php echo htmlspecialchars($member['name']); ?></td>
                            <td><?php echo htmlspecialchars($member['mobile']); ?></td>
                            <td>₹<?php echo htmlspecialchars($member['monthly_fees']); ?></td>
                            <td><?php echo htmlspecialchars($member['join_date']); ?></td>
                            <td><span class="badge bg-<?= $member['status']=='active'?'success':'secondary' ?>"><?= htmlspecialchars($member['status']); ?></span></td>
                            <td>
                                <button 
                                    class="btn btn-sm btn-warning editMemberBtn"
                                    data-id="<?= $member['id'] ?>"
                                    data-name="<?= $member['name'] ?>"
                                    data-mobile="<?= $member['mobile'] ?>"
                                    data-fees="<?= $member['monthly_fees'] ?>"
                                    data-status="<?= $member['status'] ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editMemberModal">
                                    <i class="fa fa-pen"></i>
                                </button>
                                <form method="post" style="display:inline">
                                    <input type="hidden" name="delete_id" value="<?= $member['id'] ?>">
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this member?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
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

<!-- ================= ADD MEMBER MODAL ================= -->
<div class="modal fade" id="addMemberModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add New Member</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="" method="POST">
                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="memberName" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" name="mobileNumber" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Monthly Fees</label>
                            <input type="number" class="form-control" name="monthlyFees" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Joining Date</label>
                            <input type="date" class="form-control" name="joiningDate" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option>Active</option>
                                <option>Inactive</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <input type="hidden" name="add_member" value="1">
                    <button class="btn btn-primary">Save Member</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="editMemberModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Edit Member</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="post">
        <div class="modal-body row g-3">

          <input type="hidden" name="edit_id" id="edit_id">

          <div class="col-md-6">
            <label>Name</label>
            <input type="text" name="edit_name" id="edit_name" class="form-control">
          </div>

          <div class="col-md-6">
            <label>Mobile</label>
            <input type="text" name="edit_mobile" id="edit_mobile" class="form-control">
          </div>

          <div class="col-md-6">
            <label>Monthly Fees</label>
            <input type="number" name="edit_fees" id="edit_fees" class="form-control">
          </div>

          <div class="col-md-6">
            <label>Status</label>
            <select name="edit_status" id="edit_status" class="form-select">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-success" name="update_member">
            Update Member
          </button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- ================= COLLECT FEES MODAL ================= -->
<div class="modal fade" id="collectFeesModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Collect Fees</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="post">
    <div class="modal-body">
        <div class="row g-3">

            <!-- MEMBER -->
            <div class="col-md-6">
                <label class="form-label">Select Member</label>
                    <select class="form-select" name="userid" id="userid" required>
                        <?php
                            $members = $conn->query("
                                SELECT 
                                    m.userid, 
                                    m.name,
                                    COALESCE(SUM(p.amount - p.paid), 0) as total_pending
                                    FROM members m
                                    LEFT JOIN payments p ON m.userid = p.userid
                                    WHERE m.status='active'
                                    GROUP BY m.userid
                                    HAVING total_pending > 0
                                    ORDER BY m.name ASC"
                                );

                            while($m = $members->fetch()){
                                echo "<option value='{$m['userid']}'>
                                        {$m['name']} ({$m['userid']}) – Pending ₹{$m['total_pending']}
                                    </option>";
                                }
                            ?>
                    </select>                   
            </div>

            <!-- MONTH -->
            <div class="col-md-6">
                <label class="form-label">Fee Month</label>
                <input type="text" id="fee_month_display" class="form-control" readonly>
            </div>

            <!-- MONTHLY FEES (display only) -->
            <div class="col-md-4">
                <label class="form-label">Monthly Fees</label>
                <input type="number" class="form-control" id="monthly_fees" readonly>
            </div>

            <!-- PENDING (display only) -->
            <div class="col-md-4">
                <label class="form-label">Pending</label>
                <input type="number" class="form-control" id="pending" readonly>
            </div>

            <!-- PAY -->
            <div class="col-md-4">
                <label class="form-label">Pay Amount</label>
                <input type="number" class="form-control" name="pay_amount" required>
            </div>

            <!-- MODE -->
            <div class="col-md-6">
                <label class="form-label">Payment Mode</label>
                <select class="form-select" name="payment_mode">
                    <option value="cash">Cash</option>
                    <option value="upi">UPI</option>
                    <option value="bank">Bank</option>
                </select>
            </div>

        </div>
    </div>

    <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-success" name="save_payment">Save Payment</button>
    </div>
</form>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

document.querySelectorAll('.editMemberBtn').forEach(btn => {
    btn.addEventListener('click', function () {
    document.getElementById('edit_id').value = this.dataset.id;
    document.getElementById('edit_name').value = this.dataset.name;
    document.getElementById('edit_mobile').value = this.dataset.mobile;
    document.getElementById('edit_fees').value = this.dataset.fees;
    document.getElementById('edit_status').value = this.dataset.status;
  });
});


const modal = document.getElementById('collectFeesModal');

modal.addEventListener('shown.bs.modal', function () {

    const userid = document.getElementById('userid');

    function fetchFees() {
        if (!userid.value) return;

        let fd = new FormData();
        fd.append('userid', userid.value);

        fetch('fetch_fees.php', {
            method: 'POST',
            body: fd
        })
        .then(r => r.text())   // 🔴 json नहीं, पहले text
        .then(t => {
            console.log('RAW RESPONSE:', t);

            if (!t) return; // empty response guard

            let d = JSON.parse(t);

            if (d.error) {
                console.warn(d.error);
                return;
            }

            document.getElementById('monthly_fees').value = d.monthly_fees ?? '';
            document.getElementById('pending').value = d.pending ?? '';
            if (Array.isArray(d.months) && d.months.length > 0) {
                document.getElementById('fee_month_display').value = d.months.join(', ');
} else {
    document.getElementById('fee_month_display').value = '';
}
        })
        .catch(err => console.error(err));
    }

    userid.addEventListener('change', fetchFees);
    fetchFees();
});
</script>
</body>
</html>