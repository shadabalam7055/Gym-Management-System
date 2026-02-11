<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}

$activepage = 'trainers';

include '../config/connection.php';

// Add Trainer 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $trainer_name = $_POST['trainer_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $specialization = $_POST['specialization'] ?? '';
    $hire_date = $_POST['hire_date'] ?? '';
    $status = $_POST['status'] ?? 'active';
    try {
        // Prepare and execute the insert statement
        $stmt = $conn->prepare("INSERT INTO trainers (name, email, phone, specialization, hire_date, status)
          VALUES (:trainer_name, :email, :phone, :specialization, :hire_date, :status)");
        $stmt->bindParam(':trainer_name', $trainer_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':specialization', $specialization);
        $stmt->bindParam(':hire_date', $hire_date);
        $stmt->bindParam(':status', $status);
        $stmt->execute();

        // Redirect to the trainers page after successful insertion
        header('Location: trainers.php');
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

/* ================= UPDATE TRAINER ================= */
if (isset($_POST['update_trainer'])) {

    $id     = $_POST['trainer_id'];
    $name   = $_POST['trainer_name'];
    $email  = $_POST['email'];
    $phone  = $_POST['phone'];
    $spec   = $_POST['specialization'];
    $date   = $_POST['hire_date'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("
        UPDATE trainers SET
            name=?,
            email=?,
            phone=?,
            specialization=?,
            hire_date=?,
            status=?
        WHERE id=?
    ");
    $stmt->execute([
        $name,
        $email,
        $phone,
        $spec,
        $date,
        $status,
        $id
    ]);

    header("Location: trainers.php");
    exit;
}

// Show Trainers List
$trainers_stmt = $conn->prepare("
    SELECT * FROM trainers 
    WHERE status = 'active'
    ORDER BY id DESC
");
$trainers_stmt -> execute();
$trainers = $trainers_stmt -> fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Trainers | Alan Fitness Club</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- Dashboard CSS -->
  <link rel="stylesheet" href="assets/css/dashboard.css">
  <link rel="stylesheet" href="assets/css/sidebar.css">
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
        <h4>Trainers</h4>
        <p class="text-muted mb-0">Manage gym trainers</p>
      </div>

      <button class="btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#addTrainerModal">
        <i class="fa fa-user-plus"></i> Add Trainer
      </button>
    </div>

    <!-- TRAINERS TABLE -->
    <div class="card">
      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center mb-0">
          <thead class="table-light">
            <tr>
              <th>S.R.</th>
              <th>Trainer Name</th>
              <th>Email</th>
              <th>Mobile</th>
              <th>Specialization</th>
              <th>Hire Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            <?php if (!empty($trainers)) {
                            $i = 1;
                            foreach ($trainers as $trainer) { ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= htmlspecialchars($trainer['name']) ?></td>
              <td><?= htmlspecialchars($trainer['email']) ?></td>
              <td><?= htmlspecialchars($trainer['phone']) ?></td>
              <td><?= htmlspecialchars($trainer['specialization']) ?></td>
              <td><span class="badge bg-success"><?= htmlspecialchars($trainer['hire_date']) ?></span></td>
              <td><span class="badge bg-<?= $trainer['status']=='active'?'success':'secondary' ?>"><?= htmlspecialchars($trainer['status']); ?></span></td>
              <td>
                <button 
                  class="btn btn-sm btn-warning me-1 editBtn"
                  data-id="<?= $trainer['id'] ?>"
                  data-name="<?= htmlspecialchars($trainer['name']) ?>"
                  data-email="<?= htmlspecialchars($trainer['email']) ?>"
                  data-phone="<?= htmlspecialchars($trainer['phone']) ?>"
                  data-spec="<?= htmlspecialchars($trainer['specialization']) ?>"
                  data-date="<?= $trainer['hire_date'] ?>"
                  data-bs-toggle="modal"
                  data-bs-target="#editTrainerModal">
                  <i class="fa fa-pen"></i>
                </button>
                <a href="trainer_delete.php?id=<?= $trainer['id'] ?>"
                  class="btn btn-sm btn-danger"
                  onclick="return confirm('Are you sure you want to delete this trainer?')">
                  <i class="fa fa-trash"></i>
                </a>
                </button>
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

<!-- ================= ADD TRAINER MODAL ================= -->
<div class="modal fade" id="addTrainerModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">➕ Add New Trainer</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form method="POST" action="">
          <div class="mb-3">
            <label class="form-label">Trainer Name</label>
            <input type="text" class="form-control" placeholder="Enter trainer name" name="trainer_name">
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="Enter email" name="email">
          </div>

          <div class="mb-3">
            <label class="form-label">Mobile</label>
            <input type="text" class="form-control" placeholder="Enter mobile number" name="phone">
          </div>

          <div class="mb-3">
            <label class="form-label">Specialization</label>
            <input type="text" class="form-control" placeholder="Eg: Weight Training" name="specialization">
          </div>

          <div class="mb-3">
            <label class="form-label">Hire Date</label>
            <input type="date" class="form-control" name="hire_date">
          </div>
          
          <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-select" name="status">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>

          <button type="submit" class="btn btn-primary w-100">
            Add Trainer
          </button>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- ================= EDIT TRAINER MODAL ================= -->
<div class="modal fade" id="editTrainerModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <form method="POST">

      <div class="modal-header">
        <h5 class="modal-title">✏ Edit Trainer</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <input type="hidden" name="trainer_id" id="edit_id">

        <div class="mb-3">
          <label class="form-label">Trainer Name</label>
          <input type="text" class="form-control" name="trainer_name" id="edit_name" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="edit_email">
        </div>

        <div class="mb-3">
          <label class="form-label">Mobile</label>
          <input type="text" class="form-control" name="phone" id="edit_phone">
        </div>

        <div class="mb-3">
          <label class="form-label">Specialization</label>
          <input type="text" class="form-control" name="specialization" id="edit_spec">
        </div>

        <div class="mb-3">
          <label class="form-label">Hire Date</label>
          <input type="date" class="form-control" name="hire_date" id="edit_date">
        </div>

        <div class="mb-3">
          <label class="form-label">Status</label>
          <select class="form-select" name="status" id="edit_status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-warning" name="update_trainer">Update Trainer</button>
      </div>

      </form>

    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.querySelectorAll('.editBtn').forEach(btn => {
  btn.addEventListener('click', function () {

    document.getElementById('edit_id').value    = this.dataset.id;
    document.getElementById('edit_name').value  = this.dataset.name;
    document.getElementById('edit_email').value = this.dataset.email;
    document.getElementById('edit_phone').value = this.dataset.phone;
    document.getElementById('edit_spec').value  = this.dataset.spec;
    document.getElementById('edit_date').value  = this.dataset.date;

  });
});
</script>

</body>
</html>