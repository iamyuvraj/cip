<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Register</title>
    <style>
      body {
        background-color: #f8f9fa; /* Light gray background */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
      }
      .login-container {
        background-color: #ffffff; /* White background for the form */
        padding: 2rem;
        border-radius: .5rem;
        box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1); /* Subtle shadow */
        max-width: 400px; /* Limit width */
        width: 100%; /* Full width up to max-width */
      }
      .login-container h2 {
        margin-bottom: 1.5rem; /* Space between heading and form */
      }
      .form-floating {
        margin-bottom: 1rem; /* Space between form controls */
      }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      function handleRegister(event) {
        event.preventDefault(); // Prevent default form submission

        const firstName = document.getElementById('firstName');
        const lastName = document.getElementById('lastName');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');

        // Check if passwords match
        if (password.value !== confirmPassword.value) {
          alert('Passwords do not match!');
          return;
        }

        // Save success message in localStorage
        localStorage.setItem('registerSuccess', 'Registration Successful. Please Login to continue.');
        // Redirect to login page
        window.location.href = "<?= site_url('login') ?>";
      }
    </script>
  </head>
  <body>
    <!-- Container for better alignment -->
    <div class="login-container">
      <h2 class="text-center">Create a New Account</h2>
      <form onsubmit="handleRegister(event)">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="firstName" placeholder="First Name" required maxlength="10">
          <label for="firstName">First Name</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="lastName" placeholder="Last Name" required maxlength="10">
          <label for="lastName">Last Name</label>
        </div>
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
          <label for="email">Email Address</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="password" placeholder="Password" required>
          <label for="password">Password</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
          <label for="confirmPassword">Confirm Password</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
      </form>
    </div>
  </body>
</html>
