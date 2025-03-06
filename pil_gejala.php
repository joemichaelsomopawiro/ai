<?php include 'koneksi.php'; ?>
<div class="container mt-5">
    <form class="col-md-6 mx-auto" method="POST" action="proses.php">
        <div class="card shadow-sm animate__animated animate__fadeIn">
            <div class="card-header" style="background: linear-gradient(135deg, #2c3e50, #3498db); color: #fff;">
                <h5 class="mb-0">Pilih Kriteria Wisata</h5>
            </div>
            <div class="card-body" style="max-height: 467px; overflow-y: auto; background: #f8f9fa;">
                <?php
                $qry = "SELECT * FROM tb_kriteria";
                $data = mysqli_query($kon, $qry);
                while ($d = mysqli_fetch_array($data)) {
                ?>
                <div class="form-check mb-3 symptom-item animate__animated animate__fadeInUp">
                    <input class="form-check-input" type="checkbox" value="<?= $d['kode'] ?>" name="<?= $d['id'] ?>" id="krit<?= $d['id'] ?>">
                    <label class="form-check-label" for="krit<?= $d['id'] ?>">
                        <?= $d['kriteria'] ?>
                    </label>
                </div>
                <?php } ?>
            </div>
            <div class="card-footer" style="background: #ecf0f1;">
                <input type="submit" class="btn btn-primary btn-lg btn-block diagnose-btn" name="submit" value="CARI">
            </div>
        </div>
    </form>
</div>

<style>
    /* Card Styling */
    .card {
        border: none;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        transform: translateY(-5px);
    }

    /* Symptom Item */
    .symptom-item {
        padding: 10px;
        border-radius: 8px;
        transition: all 0.3s ease;
        position: relative;
    }

    .symptom-item:hover {
        background-color: #e9ecef;
        transform: translateX(8px);
    }

    .form-check-input {
        transition: all 0.3s ease;
    }

    .form-check-input:checked {
        background-color: #3498db;
        border-color: #3498db;
    }

    .form-check-label {
        color: #2c3e50;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .symptom-item:hover .form-check-label {
        color: #f1c40f;
    }

    /* Diagnose Button */
    .diagnose-btn {
        background: linear-gradient(135deg, #3498db, #2c3e50);
        border: none;
        border-radius: 8px;
        font-weight: bold;
        padding: 12px;
        transition: all 0.3s ease;
    }

    .diagnose-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        background: linear-gradient(135deg, #f1c40f, #3498db);
    }

    /* Scrollbar Styling */
    .card-body::-webkit-scrollbar {
        width: 8px;
    }

    .card-body::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .card-body::-webkit-scrollbar-thumb {
        background: #3498db;
        border-radius: 10px;
    }

    .card-body::-webkit-scrollbar-thumb:hover {
        background: #f1c40f;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>