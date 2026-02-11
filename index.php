<?php
$currentpage = 'home';
include_once "includes/navbar.php";
include_once "includes/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alan Fitness Club</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/services.css">
</head>
<body>
    
  <section class="about-section py-5 why-choose-a-f-c">
  <div class="container">
    <div class="row align-items-center">
      
      <div class="col-md-6">
        <h2 class="fw-bold mb-3">Why Choose Alan Fitness Club?</h2>
        <p>
          Modern equipment, certified trainers and a motivating environment
          to help you reach your fitness goals.
        </p>
      </div>

      <div class="col-md-6">
        <img 
          src="/assets/img/why-a-f-c.jpg" 
          class="img-fluid rounded shadow"
          alt="Gym training"
        >
      </div>

    </div>
  </div>
</section>

<section class="services-wrapper py-5 service-content our-services">
  <div class="container">

    <div class="services-header text-center mb-5">
      <span class="services-tag">OUR SERVICES</span>
      <h2 class="fw-bold mt-2">Training Programs That Deliver Results</h2>
      <p class="text-muted mt-2">
        Strength, cardio and transformation programs designed for real fitness
      </p>
    </div>

  </div>
</section>

<!-- SERVICES SECTION -->

<!-- 1. Weight Training -->
<section class="service-feature py-5 weight-training bg-light">
  <div class="container">
    <div class="row align-items-center flex-md-row-reverse ">
      <div class="col-md-6">
        <h2 class="fw-bold">Weight Training</h2>
        <p>
          Build muscle and strength using modern machines and free weights.
          Suitable for beginners to advanced members.
        </p>
      </div>
      <div class="col-md-6">
        <img src="/assets/img/weight-training.jpg" class="img-fluid rounded shadow">
      </div>
    </div>
  </div>
</section>

<!-- 2. Cardio Training -->
<!-- <section class="service-feature py-5 bg-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h2 class="fw-bold">Cardio Training</h2>
        <p>
          Improve stamina and burn calories using treadmills, cycles
          and cross trainers.
        </p>
      </div>
      <div class="col-md-6">
        <img src="/assets/img/cardio-training.jpg" class="img-fluid rounded shadow">
      </div>
    </div>
  </div>
</section> -->

<!-- 3. Personal Training -->
<section class="service-feature py-3 personal-training ">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h2 class="fw-bold">Personal Training</h2>
        <p>
          One-to-one guidance from experienced trainers for faster
          and safer results.
        </p>
      </div>
      <div class="col-md-6">
        <img src="/assets/img/personal-training.jpg" class="img-fluid rounded shadow">
      </div>
    </div>
  </div>
</section>

<!-- 4. Fat Loss Training -->
<section class="service-feature py-5 bg-light fat-loss-training">
  <div class="container">
    <div class="row align-items-center flex-md-row-reverse">
      <div class="col-md-6">
        <h2 class="fw-bold">Fat Loss Training</h2>
        <p>
          Structured workouts and routines focused on healthy
          and sustainable weight loss.
        </p>
      </div>
      <div class="col-md-6">
        <img src="/assets/img/fat-loss.jpg" class="img-fluid rounded shadow">
      </div>
    </div>
  </div>
</section>

<!-- 5. Nutrition Guidance -->
<!-- <section class="service-feature py-5">
  <div class="container">
    <div class="row align-items-center flex-md-row-reverse">
      <div class="col-md-6">
        <h2 class="fw-bold">Nutrition Guidance</h2>
        <p>
          Basic diet and nutrition advice to support your fitness
          and weight goals.
        </p>
      </div>
      <div class="col-md-6">
        <img src="/assets/img/nutrition.jpg" class="img-fluid rounded shadow">
      </div>
    </div>
  </div>
</section> -->

<!-- 6. Body Transformation -->
<section class="service-feature py-3 body-transformation">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h2 class="fw-bold">Body Transformation</h2>
        <p>
          Complete fitness transformation programs with proper
          training and discipline.
        </p>
      </div>
      <div class="col-md-6">
        <img src="/assets/img/transformation.jpg" class="img-fluid rounded shadow">
      </div>
    </div>
  </div>
</section>

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
      <a href="https://wa.me/917055953578" target="_blank" class="btn btn-outline-light btn-lg">
        Call Now
      </a>
    </div>
  </div>
</section>

<section class="why-trust-us py-5">
  <div class="container">

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

<section class="pricing-section">
  <div class="container">

    <div class="section-header text-center mb-4">
      <span class="section-tag">MEMBERSHIP</span>
      <h2 class="fw-bold mt-2">Choose Your Plan</h2>
      <p class="text-muted mt-1">
        Simple plans designed for every fitness goal
      </p>
    </div>

    <div class="row g-4 justify-content-center">

      <!-- Plan 1 -->
      <div class="col-md-4">
        <div class="pricing-card">
          <h4>Monthly Plan</h4>
          <h3>₹1,200</h3>
          <p class="duration">per month</p>
          <ul>
            <li>Gym Access</li>
            <li>Basic Guidance</li>
            <li>Flexible Timings</li>
          </ul>
          <a href="#" class="btn btn-outline-dark w-100">Get Started</a>
        </div>
      </div>

      <!-- Plan 2 -->
      <div class="col-md-4">
        <div class="pricing-card popular">
          <span class="badge">Most Popular</span>
          <h4>Quarterly Plan</h4>
          <h3>₹3,000</h3>
          <p class="duration">3 months</p>
          <ul>
            <li>Full Gym Access</li>
            <li>Trainer Support</li>
            <li>Diet Guidance</li>
          </ul>
          <a href="#" class="btn btn-danger w-100">Join Now</a>
        </div>
      </div>

      <!-- Plan 3 -->
      <div class="col-md-4">
        <div class="pricing-card">
          <h4>Personal Training</h4>
          <h3>₹5,000</h3>
          <p class="duration">per month</p>
          <ul>
            <li>1-on-1 Trainer</li>
            <li>Custom Workout</li>
            <li>Personal Diet Plan</li>
          </ul>
          <a href="#" class="btn btn-outline-dark w-100">Contact Us</a>
        </div>
      </div>

    </div>

  </div>
</section>

<section class="testimonials-section">
  <div class="container">

    <div class="section-header text-center mb-5">
      <span class="section-tag">TESTIMONIALS</span>
      <h2 class="fw-bold mt-2">Success Stories</h2>
      <p class="text-muted">What our members say about Alan Fitness Club</p>
    </div>

    <div class="row g-4">

      <div class="col-md-4">
        <div class="testimonial-card">
          <p>
            “I lost 8kg in 3 months. Trainers here are very supportive and
            professional.”
          </p>
          <h5>Rahul Verma</h5>
          <span>Weight Loss Program</span>
        </div>
      </div>

      <div class="col-md-4">
        <div class="testimonial-card">
          <p>
            “Best gym in the area. Clean environment and modern equipment.”
          </p>
          <h5>Ankit Sharma</h5>
          <span>Strength Training</span>
        </div>
      </div>

      <div class="col-md-4">
        <div class="testimonial-card">
          <p>
            “Personal training helped me stay consistent and disciplined.”
          </p>
          <h5>Pooja Singh</h5>
          <span>Personal Training</span>
        </div>
      </div>

    </div>

  </div>
</section>


  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>
</body>
</html>

<?php
include_once "includes/footer.php";
?>