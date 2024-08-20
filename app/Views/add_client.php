<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Add Client</title>
    <style>
      body {
        background-color: #f8f9fa; /* Light gray background */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
      }
      .form-container {
        background-color: #ffffff; /* White background for the form */
        padding: 2rem;
        border-radius: .5rem;
        box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1); /* Subtle shadow */
        max-width: 400px; /* Limit width */
        width: 100%; /* Full width up to max-width */
      }
      .form-container h1 {
        margin-bottom: 1.5rem; /* Space between heading and form */
      }
      .form-floating {
        margin-bottom: 1rem; /* Space between form controls */
      }
    </style>
</head>
<body>
    <div class="form-container">
        <h1 class="text-center">Add Client</h1>
        
        <!-- Display validation errors if any -->
        <!-- <?= \Config\Services::validation()->listErrors() ?> -->
        
        <!-- Form with action pointing to the backend route -->
        <form action="<?= site_url('add-client') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?= old('firstName') ?>" placeholder="First Name" required maxlength="255">
                <label for="firstName">First Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?= old('lastName') ?>" placeholder="Last Name" required maxlength="255">
                <label for="lastName">Last Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Client</button>
        </form>
    </div>
</body>
</html>
