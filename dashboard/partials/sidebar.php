<div class="sidebar">
    <div class="sidebar-brand">Alan Fitness Club</div>

    <a href="index.php" class="sidebar-link <?= ($activepage == 'dashboard') ? 'active' : '' ?>">
        <i class="fa-solid fa-chart-line"></i> Dashboard
    </a>

    <a href="members.php" class="sidebar-link <?= ($activepage == 'members') ? 'active' : '' ?>">
        <i class="fa-solid fa-users"></i> Members
    </a>

    <a href="payment_details.php" class="sidebar-link <?= ($activepage == 'payments_details') ? 'active' : '' ?>">
        <i class="fa-solid fa-file-invoice-dollar"></i> Payment Details
    </a>

    <a href="enquiries.php" class="sidebar-link <?= ($activepage == 'enquiries') ? 'active' : '' ?>">
        <i class="fa-solid fa-envelope"></i> Enquiries
    </a>

    <a href="attendance.php" class="sidebar-link <?= ($activepage == 'attendance') ? 'active' : '' ?>">
        <i class="fa-solid fa-calendar-check"></i> Attendance
    </a>

    <a href="trainers.php" class="sidebar-link <?= ($activepage == 'trainers') ? 'active' : '' ?>">
        <i class="fa-solid fa-user"></i> Trainers
    </a>

    <a href="settings.php" class="sidebar-link <?= ($activepage == 'settings') ? 'active' : '' ?>">
        <i class="fa-solid fa-gear"></i> Settings
    </a>

    <a href="../logout.php" class="sidebar-link logout">
        <i class="fa-solid fa-right-from-bracket"></i> Logout
    </a>
</div>