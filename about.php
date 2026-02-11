<?php
$currentpage = 'about';
include_once "includes/navbar.php";
include_once "includes/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Us | Alan Fitness Club</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- Custom CSS -->
   <link rel="stylesheet" href="assets/css/services.css">
  <link rel="stylesheet" href="assets/css/about.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<!-- HERO -->
<section class="about-hero text-center">
  <div class="container">
    <h1>About Alan Fitness Club</h1>
    <p>Your trusted destination for fitness & transformation</p>
  </div>
</section>

<!-- ABOUT CONTENT -->
<section class="section-padding">
  <div class="container">
    <div class="row align-items-center gy-4">
      <div class="col-lg-6">
        <h2 class="section-title">Who We Are</h2>
        <p class="section-subtitle">
          Alan Fitness Club is a modern gym focused on real results,
          professional training, and a motivating environment.
        </p>
        <p class="section-subtitle">
          We help beginners to advanced members reach their fitness goals
          safely and effectively.
        </p>
      </div>

      <div class="col-lg-6">
        <img src="assets/img/about-gym.jpg" class="img-fluid rounded-4 shadow" alt="Gym">
      </div>
    </div>
  </div>
</section>

<section class="why-trust-us py-3">
  <div class="container">

<section class="mission-vision py-5">
  <div class="container">

    <div class="text-center mb-5">
      <h2 class="fw-bold section-title">Our Mission & Vision</h2>
      <p class="text-muted">What drives Alan Fitness Club every day</p>
    </div>

    <div class="row g-4 justify-content-center">

      <!-- Mission -->
      <div class="col-md-6 col-lg-4">
        <div class="mv-card text-center p-4 h-100">
          <div class="mv-icon mb-3">
            <i class="bi bi-bullseye"></i>
          </div>
          <h5 class="fw-bold">Our Mission</h5>
          <p class="mt-2">
            To provide structured fitness training that delivers real,
            sustainable results for every member.
          </p>
        </div>
      </div>

      <!-- Vision -->
      <div class="col-md-6 col-lg-4">
        <div class="mv-card text-center p-4 h-100">
          <div class="mv-icon mb-3">
            <i class="bi bi-eye"></i>
          </div>
          <h5 class="fw-bold">Our Vision</h5>
          <p class="mt-2">
            To become the most trusted fitness club by promoting a
            healthy and disciplined lifestyle.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

    <!-- SECTION HEADING -->
    <div class="section-header text-center mb-3">
      <span class="section-tag">WHY CHOOSE US</span>
      <h2 class="fw-bold mt-2">Why Alan Fitness Club?</h2>
      <p class="text-muted mt-2">
        Everything you need to achieve your fitness goals
      </p>
    </div>

    <!-- cards row -->
    <div class="row g-4 text-center">
      <!-- cards -->
    </div>

  </div>
</section>

<section class="why-trust-us py-5">
  <div class="container">
    <div class="row text-center g-4">

      <div class="col-md-3">
        <div class="trust-card">
          <i class="fa-solid fa-user-check"></i>
          <h4>Certified Trainers</h4>
          <p>Experienced & professional coaches</p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="trust-card">
          <i class="fa-solid fa-screwdriver-wrench"></i>
          <h4>Modern Equipment</h4>
          <p>Latest machines & free weights</p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="trust-card">
          <i class="fa-regular fa-clock"></i>
          <h4>Flexible Timings</h4>
          <p>Morning & evening batches</p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="trust-card">
          <i class="fa-solid fa-chart-line"></i>
          <h4>Real Results</h4>
          <p>Proven transformations</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- TRAINERS SECTION -->
<section class="trainers-section py-5">
  <div class="container">
    <div class="text-center mb-5">
      <span class="section-tag">OUR TEAM</span>
      <h2 class="section-title">Meet Our Trainers</h2>
      <p class="text-muted">Certified professionals dedicated to your fitness journey</p>
    </div>

    <div class="row g-4">
      <!-- Trainer 1 -->
      <div class="col-md-4">
        <div class="trainer-card text-center">
          <img src="assets/images/trainer1.jpg" alt="Strength Trainer">
          <h5>Rahul Sharma</h5>
          <span>Strength Coach</span>
        </div>
      </div>

      <!-- Trainer 2 -->
      <div class="col-md-4">
        <div class="trainer-card text-center">
          <img src="assets/images/trainer2.jpg" alt="Cardio Trainer">
          <h5>Amit Verma</h5>
          <span>Cardio Specialist</span>
        </div>
      </div>

      <!-- Trainer 3 -->
      <div class="col-md-4">
        <div class="trainer-card text-center">
          <img src="assets/images/trainer3.jpg" alt="Crossfit Trainer">
          <h5>Neha Singh</h5>
          <span>CrossFit Trainer</span>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="stats-section py-3">
  <div class="container">

    <div class="text-center mb-5">
      <span class="section-badge">WHY TRUST US</span>
      <h2 class="section-title">Our Achievements</h2>
    </div>

    <div class="row g-4">

      <div class="col-md-3 col-sm-6">
        <div class="stat-card">
          <h3>500+</h3>
          <p>Happy Members</p>
        </div>
      </div>

      <div class="col-md-3 col-sm-6">
        <div class="stat-card">
          <h3>10+</h3>
          <p>Years Experience</p>
        </div>
      </div>

      <div class="col-md-3 col-sm-6">
        <div class="stat-card">
          <h3>20+</h3>
          <p>Training Programs</p>
        </div>
      </div>

      <div class="col-md-3 col-sm-6">
        <div class="stat-card">
          <h3>95%</h3>
          <p>Success Rate</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section py-5">
  <div class="container text-center">
    <h2 class="fw-bold">Start Your Fitness Journey Today</h2>
    <p class="mt-2">
      Join Alan Fitness Club and train with certified professionals
    </p>

    <div class="mt-4">
      <a href="contact.php" class="btn btn-danger btn-lg me-3">
        Get Free Trial
      </a>
      <a href="tel:+919876543210" class="btn btn-outline-light btn-lg">
        Call Now
      </a>
    </div>
  </div>
</section>

</body>
</html>

<?php
include_once "includes/footer.php";
?>