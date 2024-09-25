<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Client</title>
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
      .alert-custom {
        margin-bottom: 1rem; /* Space between error message and form */
      }
    </style>
</head>
<body>
    <div class="form-container">
        <h1 class="text-center">Edit Client</h1>

        <!-- Display a unified validation error message if any errors exist -->
        <?php if (session()->getFlashdata('validation')): ?>
            <div class="alert alert-danger alert-custom">
                All fields are required.
            </div>
        <?php endif; ?>

        <!-- Form with action pointing to the backend route -->
        <?php if (isset($client['id'])): ?>
          <form action="<?= site_url('update-client/' . esc($client['id'])) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="firstName" name="firstName" value="<?= esc($client['first_name']) ?>" placeholder="First Name" required maxlength="255">
        <label for="firstName">First Name</label>
    </div>
    
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="lastName" name="lastName" value="<?= esc($client['last_name']) ?>" placeholder="Last Name" required maxlength="255">
        <label for="lastName">Last Name</label>
    </div>
    
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" name="email" value="<?= esc($client['email']) ?>" placeholder="Email" required>
        <label for="email">Email Address</label>
    </div>
    
    <div class="form-floating mb-3">
        <input type="file" class="form-control" id="file" name="file">
        <label for="file">Upload New Report</label>
    </div>
    
    <input type="hidden" name="existing_file_path" value="<?= esc($client['file_path']) ?>">
    
    <button type="submit" class="btn btn-primary w-100">Update Client</button>
</form>

<?php else: ?>
    <p>Client data not available.</p>
<?php endif; ?>

    </div>
</body>
</html>
