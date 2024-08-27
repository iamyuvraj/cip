<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Log In</title>
    <style>
      body {
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
      }
      .login-container {
        background-color: #ffffff;
        padding: 2rem;
        border-radius: .5rem;
        box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
      }
      .login-container h2 {
        margin-bottom: 1.5rem;
      }
      .form-floating {
        margin-bottom: 1rem;
      }
      .alert-message {
        margin-bottom: 1rem;
      }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <div class="login-container">
      <h2 class="text-center">Enter Your Details</h2>

      <!-- Display Flash Message -->
      <?php if (session()->getFlashdata('status')): ?>
        <div class="alert alert-success">
          <?= session()->getFlashdata('status') ?>
        </div>
      <?php endif; ?>

      <form action="<?= site_url('login-user') ?>" method="post"> <!-- Updated form action -->
        <div class="form-floating mb-3">
          <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com" required>
          <label for="floatingInput">Email Address</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" required>
          <label for="floatingPassword">Password</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">Log In</button>
      </form>

      <!-- Display Error Message -->
      <?php if (isset($error)): ?>
        <div class="alert alert-danger mt-3">
          <?= $error ?>
        </div>
      <?php endif; ?>
    </div>
  </body>
</html>
