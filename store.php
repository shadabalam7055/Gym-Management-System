<?php
$currentpage = 'store';
include_once "includes/navbar.php";
include_once "includes/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store | Alan Fitness Club</title>

   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/services.css">

    <!-- Store CSS -->
    <link rel="stylesheet" href="/assets/css/store.css">
</head>

<body>

<!-- STORE HERO -->
<section class="store-hero">
  <div class="container text-center">
    <h1 class="fw-bold">Fitness <span>Store</span></h1>
    <p class="mt-2">Supplements & Gym Essentials to Boost Your Performance</p>
  </div>
</section>

<!-- PRODUCTS SECTION -->
<section class="store-products py-5">
  <div class="container">

    <div class="text-center mb-5">
      <span class="section-tag">OUR PRODUCTS</span>
      <h2 class="fw-bold mt-2">Top Fitness Products</h2>
      <p class="text-muted">
        Trusted supplements & accessories for better results
      </p>
    </div>

    <div class="row g-4 justify-content-center">

      <!-- Product Card -->
      <div class="col-md-3">
        <div class="product-card">
          <img src="https://m.media-amazon.com/images/I/71f+UBXh2vL._AC_UF1000,1000_QL80_.jpg" alt="">
          <h5>Whey Protein</h5>
          <p class="price">₹2,499</p>
          <a href="#" class="btn btn-danger w-100">Buy Now</a>
        </div>
      </div>

      <div class="col-md-3">
        <div class="product-card">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSoV6aJvejzaOrrc6-nGcXYVnjQn3faTdH6AA&s" alt="">
          <h5>Creatine Monohydrate</h5>
          <p class="price">₹1,299</p>
          <a href="#" class="btn btn-danger w-100">Buy Now</a>
        </div>
      </div>

      <div class="col-md-3">
        <div class="product-card">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRiPL8izzzssjbhTUP8VSCyrqmESWlrWhpzEQ&s" alt="">
          <h5>Gym Gloves</h5>
          <p class="price">₹599</p>
          <a href="#" class="btn btn-danger w-100">Buy Now</a>
        </div>
      </div>

      <div class="col-md-3">
        <div class="product-card">
          <img src="https://m.media-amazon.com/images/I/51czYs5YISL.jpg" alt="">
          <h5>Shaker Bottle</h5>
          <p class="price">₹299</p>
          <a href="#" class="btn btn-danger w-100">Buy Now</a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section py-5">
  <div class="container text-center">
    <h2 class="fw-bold">Need Help Choosing the Right Product?</h2>
    <p class="mt-2">
      Talk directly with our fitness experts
    </p>

    <div class="mt-4">
      <a href="contact.php" class="btn btn-danger btn-lg me-3">
        Contact Us
      </a>
      <a href="https://wa.me/917055953578" target="_blank" class="btn btn-outline-light btn-lg">
        Chat on WhatsApp
      </a>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include_once "includes/footer.php"; ?>