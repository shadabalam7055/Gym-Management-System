<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alan Fitness Club Navbar</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 gym-navbar fixed-top">
        <div class="container-fluid px-lg-4">
            <div class="d-flex align-items-center justify-content-between w-100">

                <!-- LEFT -->
                <h2 class="navbar-brand fw-bold ms-lg-3 gym-name">Alan Fitness Club</h2>

                <!-- CENTER -->
                <div class="collapse navbar-collapse justify-content-center" id="gymNavbar">
                    <ul class="navbar-nav gap-4">
                        <li class="nav-item"><a class="nav-link <?php echo ($currentpage == 'home') ? 'active' : ''; ?>" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link <?php echo ($currentpage == 'about') ? 'active' : ''; ?>" href="about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link <?php echo ($currentpage == 'store') ? 'active' : ''; ?>" href="store.php">Store</a></li>
                        <li class="nav-item"><a class="nav-link <?php echo ($currentpage == 'contact') ? 'active' : ''; ?>" href="contact.php">Contact Us</a></li>
                    </ul>
                </div>

                <!-- RIGHT -->
                <div class="d-none d-lg-flex align-items-center gap-3 me-lg-3">
                    <li class="nav-item">
    <a href="login.php" class="btn btn-outline-warning fw-bold px-3">
        Dashboard
    </a>
</li>
                    <a href="contact.php" class="btn btn-danger fw-bold px-3">Get Free Trial</a>
                </div>

                <!-- TOGGLER -->
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#gymNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>
        </div>
    </nav>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>