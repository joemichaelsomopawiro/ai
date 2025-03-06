<?php include 'header.php'; ?>

<div class="wrapper">
    <main class="container my-5 flex-grow-1 text-center">
        <div class="welcome-card shadow-sm animate__animated animate__fadeIn">
            <div class="card-header" style="background: linear-gradient(135deg, #2c3e50, #3498db); color: #fff;">
                <h1 class="mb-0 animate__animated animate__bounceIn">Selamat Datang</h1>
            </div>
            <div class="card-body" style="background: #f8f9fa;">
                <p class="lead" style="color: #2c3e50;">Sistem Pakar Wisata Indonesia</p>
                <p style="color: #2c3e50;">Temukan destinasi wisata impian Anda dengan metode Forward dan Backward Chaining!</p>
                <div class="button-group mt-4">
                    <a href="forward.php" class="btn welcome-btn forward-btn">Mulai Forward Chaining</a>
                    <a href="backward.php" class="btn welcome-btn backward-btn">Mulai Backward Chaining</a>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</div>

<style>
    /* Ensure full height layout */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .flex-grow-1 {
        flex-grow: 1; /* Konten utama mengisi ruang yang tersisa */
    }

    /* Welcome Card */
    .welcome-card {
        border: none;
        border-radius: 10px;
        max-width: 600px;
        margin: 0 auto;
        transition: all 0.3s ease;
    }

    .welcome-card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        transform: translateY(-5px);
    }

    /* Button Group */
    .button-group {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .welcome-btn {
        border: none;
        border-radius: 8px;
        font-weight: bold;
        padding: 12px 30px;
        color: #fff;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .forward-btn {
        background: linear-gradient(135deg, #3498db, #2c3e50);
    }

    .forward-btn:hover {
        background: linear-gradient(135deg, #f1c40f, #3498db);
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .backward-btn {
        background: linear-gradient(135deg, #2ecc71, #27ae60);
    }

    .backward-btn:hover {
        background: linear-gradient(135deg, #f1c40f, #2ecc71);
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .welcome-card {
            margin: 0 15px;
        }

        .button-group {
            flex-direction: column;
            gap: 15px;
        }

        .welcome-btn {
            width: 100%;
            padding: 10px;
        }
    }

    @media (max-width: 576px) {
        .welcome-card h1 {
            font-size: 1.5rem;
        }

        .lead {
            font-size: 1rem;
        }
    }
</style>
