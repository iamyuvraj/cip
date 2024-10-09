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

        /* Flash message styling */
        .flash-message {
            position: absolute;
            top: 80px; /* Adjust */
            right: 20px;
            width: auto;
            padding: 10px;
            border-radius: .25rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1050; /* Ensure it’s above other content */
            display: none; /* Hide initially */
        }

        .flash-message.success {
            background-color: #d4edda;
            color: #155724;
        }

        /* Add a fade-out effect */
        .fade-out {
            transition: opacity 0.5s ease-out;
        }

        .flash-message {
        position: absolute;
        top: 80px; /* Adjust */
        right: 20px;
        width: auto;
        padding: 10px;
        border-radius: .25rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1050; /* Ensure it’s above other content */
        display: none; /* Hide initially */
    }

    .flash-message.success {
        background-color: #d4edda;
        color: #155724;
    }

    .flash-message.error {
        background-color: #f8d7da;
        color: #721c24;
    }

    .fade-out {
        transition: opacity 0.5s ease-out;
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
                    <!-- Chip showing the role -->
                <li class="nav-item">
                    <?php if (session()->get('role') == 'Admin'): ?>
                        <span class="chip chip-admin">Welcome Admin</span>
                    <?php else: ?>
                        <span class="chip chip-user">Welcome User</span>
                    <?php endif; ?>
                </li>

                    <!-- Logout Button -->
                    <li class="nav-item">
                        <a class="btn btn-danger" href="<?= site_url('logout') ?>">Logout</a>
                        <a href="<?= site_url('generate-pdf') ?>" class="btn btn-primary" target="_blank">Save Page as PDF</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <style>
    .chip {
        display: inline-block;
        padding: 0 10px;
        height: 38px;
        font-size: 16px;
        line-height: 35px;
        border-radius: 20px;
        background-color: #e0e0e0;
        color: #000;
        font-weight: bold;
        margin-right: 10px;
    }
    .chip-admin {
        background-color: #ff5722;
        color: #fff;
    }
    .chip-user {
        background-color: #4caf50;
        color: #fff;
    }
</style>

    <!-- Flash Message -->
    <?php if (session()->getFlashdata('status') || session()->getFlashdata('error')): ?>
    <?php if (session()->getFlashdata('status')): ?>
        <div class="flash-message success fade-out">
            <?= session()->getFlashdata('status') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="flash-message error fade-out">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    <?php endif; ?>

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

            <!-- Search Form -->
            <div class="search-container mb-4">
            <form action="<?= site_url('dashboard/search') ?>" method="get" class="d-flex">
            <input type="text" name="query" class="form-control me-2" placeholder="Search..." />
            <select name="filter" class="form-select me-2">
            <option value="">Select Filter</option>
            <option value="id">ID</option>
            <option value="first_name">First Name</option>
            <option value="last_name">Last Name</option>
            <option value="email">Email Address</option>
            </select>
            <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

            <!-- Client Details Table -->
            <div class="client-details-container">
                <h2>Client Details</h2>
                <p>Add, View or Modify the Records as per your requirements.</p>
                <a href="<?= site_url('add-client') ?>" class="btn btn-success mb-3">Add New Client</a>                <!-- Import Clients Button -->
                <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#importModal">Import Clients</a>

                <!-- Modal for File Upload -->
                <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Clients</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="<?= site_url('home/import') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="excel_file" class="form-label">Select Excel File</label>
                        <input type="file" name="excel_file" class="form-control" accept=".xlsx, .xls" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email Address</th>
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
                                    
                                    <!-- Conditional rendering for delete button -->
                        <?php if (session()->get('role') == 'Admin'): ?>
                            <form action="<?= site_url('delete-client/' . $client['id']) ?>" method="post" style="display:inline;">
                                <?= csrf_field(); ?> <!-- CSRF protection -->
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this client?');">Delete Client</button>
                            </form>
                        <?php endif; ?>
                                    
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

    <!-- Flash message auto-hide script -->
    <script>
       document.addEventListener('DOMContentLoaded', function() {
        var flashMessage = document.querySelector('.flash-message');
        if (flashMessage) {
            flashMessage.style.display = 'block'; // Show the flash message
            setTimeout(function() {
                flashMessage.style.opacity = '0'; // Fade out the message
                setTimeout(function() {
                    flashMessage.style.display = 'none'; // Hide it after fade-out
                }, 500); // Match this with the fade-out duration
            }, 5000); // Show for 5 seconds
        }
    });
    </script>
</body>
</html>
