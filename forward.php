<?php include 'header.php'; ?>


<div class="wrapper">
    <main class="container my-5 flex-grow-1">
        <?php include 'pil_gejala.php'; ?>
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

    .container {
        max-width: 1200px; /* Membatasi lebar maksimum untuk desktop */
    }

    .flex-grow-1 {
        flex-grow: 1; /* Konten utama mengisi ruang yang tersisa */
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .container {
            padding: 0 15px; /* Padding samping untuk mobile */
        }

        .card {
            margin: 0 10px; /* Mengurangi margin di layar kecil */
        }

        .card-header h5 {
            font-size: 1.2rem; /* Menyesuaikan ukuran font */
        }

        .diagnose-btn {
            font-size: 1rem; /* Menyesuaikan ukuran tombol */
            padding: 10px;
        }
    }

    @media (max-width: 576px) {
        .card {
            margin: 0 5px;
        }

        .form-check-label {
            font-size: 0.9rem; /* Mengurangi ukuran teks di mobile */
        }

        .diagnose-btn {
            font-size: 0.9rem;
            padding: 8px;
        }
    }
</style>