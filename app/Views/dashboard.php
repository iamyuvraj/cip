<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard</title>
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
            margin: 0;
            padding-top: 56px; /* Adjusts for fixed navbar */
        }
        .navbar {
            background-color: #ffffff; /* White background for the navbar */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        .hero-section {
            background-color: #ffffff; /* White background for hero section */
            padding: 3rem 1rem;
            margin-bottom: 2rem;
            border-radius: .5rem;
            box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1); /* Subtle shadow */
            position: relative;
            top: -90px; /* Keeps the hero section shifted up */
        }
        .card {
            margin-bottom: 20px;
        }
        .container {
            padding: 2rem;
        }
        .btn-actions {
            display: flex;
            gap: 10px;
        }
        /* Centering container vertically and horizontally */
        .centered-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            flex-direction: column; /* Ensure vertical alignment of items */
        }
        .client-details-container {
            position: relative;
        }
        .export-button-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <!-- Logout Button -->
                    <li class="nav-item">
                        <a class="btn btn-danger" href="<?= site_url('logout') ?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Centered Content -->
    <div class="centered-container">
        <div class="container">
            <!-- Hero Section -->
            <header class="hero-section">
                <div>
                    <h1 class="display-4">Welcome to Your Dashboard</h1>
                    <p class="lead">Here you can find the latest updates and stats.</p>
                </div>
            </header>

            <!-- Client Details Table -->
            <div class="client-details-container">
                <h2>Client Details</h2>
                <p>Add, View or Modify the Records as per your requirements.</p>
                <a href="<?= site_url('add-client') ?>" class="btn btn-success mb-3">Add New Client</a> <!-- Add Button -->

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?= $client['id'] ?></td>
                            <td><?= esc($client['first_name']) ?></td>
                            <td><?= esc($client['last_name']) ?></td>
                            <td><?= esc($client['email']) ?></td>
                            <td>
                                <div class="btn-actions">
                                    <a href="<?= site_url('edit-client/' . $client['id']) ?>" class="btn btn-primary btn-sm">Edit Details</a>
                                    <a href="<?= site_url('delete-client/' . $client['id']) ?>" class="btn btn-danger btn-sm">Delete Client</a>
                                    <?php if (!empty($client['file_path'])): ?>
                                        <a href="<?= base_url('uploads/' . $client['file_path']) ?>" target="_blank" class="btn btn-info btn-sm">View Report</a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Export Excel Button -->
                <div class="export-button-container">
                    <a href="<?= site_url('export-clients') ?>" class="btn btn-success">Export Excel</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
