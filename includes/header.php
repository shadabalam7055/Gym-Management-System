<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alan Fitness Club</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
</head>
<body>

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 gym-navbar fixed-top shadow">
    <div class="container-fluid px-lg-4">

        <!-- Logo / Brand -->
        <a class="navbar-brand fw-bold fs-3 ms-lg-3 gym-name" href="index.php">
            Alan Fitness Club
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#gymNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="gymNavbar">

            <!-- Center Links -->
            <ul class="navbar-nav mx-auto gap-lg-4 text-center">

                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentpage == 'home') ? 'active' : ''; ?>" href="index.php">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentpage == 'about') ? 'active' : ''; ?>" href="about.php">
                        About
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentpage == 'store') ? 'active' : ''; ?>" href="store.php">
                        Store
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentpage == 'contact') ? 'active' : ''; ?>" href="contact.php">
                        Contact Us
                    </a>
                </li>

                <!-- Mobile Buttons -->
                <li class="nav-item d-lg-none mt-3">
                    <a href="login.php" class="btn btn-outline-warning fw-bold w-100">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item d-lg-none mt-2">
                    <a href="contact.php" class="btn btn-danger fw-bold w-100">
                        Get Free Trial
                    </a>
                </li>

            </ul>

            <!-- Desktop Buttons -->
            <div class="d-none d-lg-flex align-items-center gap-3 me-lg-3">
                <a href="login.php" class="btn btn-outline-warning fw-bold px-4">
                    Dashboard
                </a>

                <a href="contact.php" class="btn btn-danger fw-bold px-4">
                    Get Free Trial
                </a>
            </div>

        </div>
    </div>
</nav>
<!-- Navbar End -->


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="../assets/js/main.js"></script>

</body>
</html>
