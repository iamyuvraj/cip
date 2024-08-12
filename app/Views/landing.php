<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Welcome</title>
    <style>
      body {
        background-color: #f8f9fa; /* Light gray background */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
      }
      .landing-container {
        background-color: #ffffff; /* White background for the content */
        padding: 2rem;
        border-radius: .5rem;
        box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1); /* Subtle shadow */
        max-width: 500px; /* Limit width */
        width: 100%; /* Full width up to max-width */
        text-align: center;
      }
      .landing-container h1 {
        margin-bottom: 1.5rem; /* Space between heading and buttons */
      }
      .btn-custom {
        padding: .75rem 1.25rem;
        font-size: 1rem;
        margin: .5rem;
        border-radius: .25rem;
      }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <!-- Container for better alignment -->
    <div class="landing-container">
      <h1>Greetings!</h1>
      <p class="mb-4">Please choose an option below:</p>
      <a href="<?= site_url('login') ?>" class="btn btn-primary btn-custom">Log In</a>
      <a href="<?= site_url('register') ?>" class="btn btn-secondary btn-custom">Register</a>
    </div>
  </body>
</html>
