<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <title>Sistem Pakar Wisata</title>
    <style>
        /* Styling Navbar */
        .navbar {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.4s ease;
            padding: 1rem 2rem;
        }

        .navbar:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        /* Brand Styling */
        .navbar-brand {
            color: #fff !important;
            font-weight: bold;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .navbar-brand img {
            margin-right: 10px;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            color: #f1c40f !important;
        }

        .navbar-brand:hover img {
            transform: rotate(360deg);
        }

        /* Nav Links */
        .nav-link {
            color: #fff !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: #f1c40f;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: #f1c40f !important;
            transform: translateY(-2px);
        }

        .nav-link.active {
            color: #f1c40f !important;
            font-weight: bold;
        }

        /* Toggler Icon */
        .navbar-toggler {
            border: none;
            transition: all 0.3s ease;
        }

        .navbar-toggler:hover {
            transform: scale(1.1);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Animation for Navbar */
        .navbar {
            animation: slideInDown 0.5s ease-in-out;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand animate__animated animate__fadeInLeft" href="index.php">
                <img src="home.svg" width="30" height="30" alt="Home"> HOME
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav animate__animated animate__fadeInRight">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">Forward Chaining</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'backward.php' ? 'active' : ''; ?>" href="backward.php">Backward Chaining</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>