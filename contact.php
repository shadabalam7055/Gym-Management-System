<?php
$currentpage = 'contact';
include_once "includes/navbar.php";

// Handle form submission
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $purpose = trim($_POST['purpose'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validation
    if (empty($purpose)) {
        $errors['purpose'] = 'Please select a purpose.';
    }

    if (empty($name)) {
        $errors['name'] = 'Name is required.';
    } elseif (strlen($name) < 2) {
        $errors['name'] = 'Name must be at least 2 characters.';
    }

    if (empty($email)) {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    if (empty($phone)) {
        $errors['phone'] = 'Phone number is required.';
    } elseif (!preg_match('/^[0-9+\-\s()]+$/', $phone)) {
        $errors['phone'] = 'Please enter a valid phone number.';
    }

    if (empty($message)) {
        $errors['message'] = 'Message is required.';
    } elseif (strlen($message) < 10) {
        $errors['message'] = 'Message must be at least 10 characters.';
    }

    // If no errors, process the form
    if (empty($errors)) {
        // Here you could send email or save to database
        // For now, just set success
        $success = true;
        
        // Clear form data
        $purpose = $name = $email = $phone = $message = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Alan Fitness Club</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/contact.css">
    <script src="assets/js/main.js"></script>
</head>
<body>
    
<section class="contact-hero d-flex align-items-center">
  <div class="container text-center text-white">

    <h1 class="fw-bold display-5">
      Contact Alan Fitness Club
    </h1>

    <p class="mt-3 lead">
      Have questions? Want to join? Our team is ready to help you.
    </p>

  </div>
</section>

<section class="contact-info py-5">
  <div class="container">
    <div class="row g-4">

      <div class="col-md-4">
        <div class="info-card text-center">
          <i class="fa-solid fa-phone"></i>
          <h5>Call Us</h5>
          <p>+91 98765 43210</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="info-card text-center">
          <i class="fa-solid fa-location-dot"></i>
          <h5>Visit Us</h5>
          <p>Alan Fitness Club, Amroha, UP</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="info-card text-center">
          <i class="fa-solid fa-clock"></i>
          <h5>Working Hours</h5>
          <p>Mon – Sat : 5 AM – 10 PM</p>
        </div>
      </div>

    </div>
  </div>
</section>

<section class="contact-form py-5">
  <div class="container">
    <div class="row align-items-center g-5">

      <!-- FORM -->
      <div class="col-lg-6">
        <h2 class="fw-bold mb-3">Send Us a Message</h2>
        <p class="text-muted mb-4">
          Book a free demo, join the gym, or ask anything.
        </p>

        <?php if ($success): ?>
        <div class="alert alert-success" role="alert">
          Thank you for your message! We'll get back to you soon.
        </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger" role="alert">
          <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>

        <form id="contactForm" method="post" action="contact-form-handler.php" novalidate>
          <!-- PURPOSE -->
          <div class="mb-3">
            <select class="form-select <?php echo isset($errors['purpose']) ? 'is-invalid' : ''; ?>" name="purpose" id="purpose" required>
              <option value="" selected disabled>
                What are you looking for?
              </option>
              <option value="demo">Book Free Demo</option>
              <option value="join">Join Gym</option>
              <option value="inquiry">General Inquiry</option>
            </select>
          </div>

          <div class="mb-3">
            <input type="text" class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" name="name" id="name" placeholder="Name" value="<?php echo htmlspecialchars($name ?? ''); ?>" required>
          </div>

          <div class="mb-3">
            <input type="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" name="email" id="email" placeholder="Email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
          </div>

          <div class="mb-3">
            <input type="tel" class="form-control <?php echo isset($errors['phone']) ? 'is-invalid' : ''; ?>" name="phone" id="phone" placeholder="Number" value="<?php echo htmlspecialchars($phone ?? ''); ?>" required>
          </div>

          <div class="mb-3">
            <textarea class="form-control <?php echo isset($errors['message']) ? 'is-invalid' : ''; ?>" name="message" id="message" rows="4" placeholder="Message" required><?php echo htmlspecialchars($message ?? ''); ?></textarea>
          </div>

          <button type="submit" class="btn btn-danger px-4">
            Submit
          </button>

        </form>
      </div>

      <!-- IMAGE -->
      <div class="col-lg-6 text-center">
        <img
          src="assets/img/why-a-f-c.jpg"
          alt="Alan Fitness Club Gym"
          class="img-fluid contact-img"
        >
      </div>

    </div>
  </div>
</section>

<script>
// Contact form validation
document.getElementById('contactForm').addEventListener('submit', function(e) {
    let isValid = true;
    const errors = [];

    // Clear previous error messages
    document.querySelectorAll('.error-message').forEach(el => el.remove());
    document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

    // Purpose validation
    const purpose = document.getElementById('purpose');
    if (!purpose.value) {
        showError(purpose, 'Please select a purpose.');
        isValid = false;
    }

    // Name validation
    const name = document.getElementById('name');
    if (!name.value.trim()) {
        showError(name, 'Name is required.');
        isValid = false;
    } else if (name.value.trim().length < 2) {
        showError(name, 'Name must be at least 2 characters.');
        isValid = false;
    }

    // Email validation
    const email = document.getElementById('email');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.value.trim()) {
        showError(email, 'Email is required.');
        isValid = false;
    } else if (!emailRegex.test(email.value.trim())) {
        showError(email, 'Please enter a valid email address.');
        isValid = false;
    }

    // Phone validation
    const phone = document.getElementById('phone');
    const phoneRegex = /^[0-9+\-\s()]+$/;
    if (!phone.value.trim()) {
        showError(phone, 'Phone number is required.');
        isValid = false;
    } else if (!phoneRegex.test(phone.value.trim())) {
        showError(phone, 'Please enter a valid phone number.');
        isValid = false;
    }

    // Message validation
    const message = document.getElementById('message');
    if (!message.value.trim()) {
        showError(message, 'Message is required.');
        isValid = false;
    } else if (message.value.trim().length < 3) {
        showError(message, 'Message must be at least 3 characters.');
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault();
    }
});

function showError(element, message) {
    element.classList.add('is-invalid');
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message text-danger mt-1';
    errorDiv.textContent = message;
    element.parentNode.appendChild(errorDiv);
}

// Real-time validation
document.querySelectorAll('#contactForm input, #contactForm select, #contactForm textarea').forEach(field => {
    field.addEventListener('blur', function() {
        // Clear previous error for this field
        const existingError = this.parentNode.querySelector('.error-message');
        if (existingError) {
            existingError.remove();
        }
        this.classList.remove('is-invalid');

        // Basic validation on blur
        if (this.hasAttribute('required') && !this.value.trim()) {
            showError(this, this.placeholder + ' is required.');
        }
    });
});
</script>

</body>
</html>

<?php
include_once "includes/footer.php";
?>