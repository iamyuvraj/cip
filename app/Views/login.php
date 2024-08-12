<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Log In</title>
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
      .alert-message {
        margin-bottom: 1rem;
      }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Check for the success message in localStorage
        const message = localStorage.getItem('registerSuccess');
        if (message) {
          // Display success message
          const alertPlaceholder = document.getElementById('alertPlaceholder');
          alertPlaceholder.innerHTML = `<div class="alert alert-success" role="alert">${message}</div>`;
          // Remove the message from localStorage
          localStorage.removeItem('registerSuccess');
        }
      });
    </script>
  </head>
  <body>
    <!-- Container for better alignment -->
    <div class="login-container">
      <h2 class="text-center">Enter Your Details</h2>
      <div id="alertPlaceholder"></div>
      <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email Address</label>
      </div>
      <div class="form-floating mb-3">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>
      <button class="btn btn-primary w-100">Log In</button>
    </div>
  </body>
</html>
