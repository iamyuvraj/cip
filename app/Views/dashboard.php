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
        /* Add margin-top to the table to move it up */
        .client-details-table {
            margin-top: -1.5rem; /* Adjust this value to move the table up */
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
            <div class="client-details-table">
                <h2>Client Details</h2>
                <p>View, Edit and Delete the Records as per your requirements.</p>
                <a href="<?= site_url('add-client') ?>" class="btn btn-success mb-3">Add</a> <!-- Add Button -->
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
                        <tr>
                            <td>1</td>
                            <td>John</td>
                            <td>Doe</td>
                            <td>john@example.com</td>
                            <td>
                                <div class="btn-actions">
                                    <a href="edit.php?id=1" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="delete.php?id=1" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <!-- More rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
