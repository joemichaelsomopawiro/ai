<?php
include 'koneksi.php';
include 'header.php';

// Fungsi untuk mendapatkan deskripsi kriteria berdasarkan kode
function getKriteriaDesc($kon, $kode) {
    $query = "SELECT kriteria FROM tb_kriteria WHERE kode='$kode'";
    $result = mysqli_query($kon, $query);
    $row = mysqli_fetch_array($result);
    return $row ? $row['kriteria'] : "Kriteria tidak ditemukan";
}

// Ambil data aturan dari database
$db_rule = mysqli_query($kon, "SELECT * FROM tb_rule");
$arr_rule = [];
while ($d = mysqli_fetch_array($db_rule)) {
    $arr_rule[] = $d;
}

$rule = [];
foreach ($arr_rule as $row) {
    $sub_rule = [];
    foreach ($row as $key => $value) {
        if (!is_numeric($key) && $value == 1 && $key != 'id') {
            $sub_rule[] = $key; // Kode seperti W001, W002, dll.
        }
    }
    $rule[$row['id']] = $sub_rule; // Index berdasarkan id tujuan
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-4 animate__animated animate__bounceIn" style="color: #2c3e50;">Diagnosa Backward Chaining</h1>
    
    <!-- Form untuk memilih tujuan -->
    <form method="POST" class="col-md-6 mx-auto mb-4">
        <div class="card shadow-sm animate__animated animate__fadeIn">
            <div class="card-header" style="background: linear-gradient(135deg, #2ecc71, #27ae60); color: #fff;">
                <h5 class="mb-0">Pilih Tujuan Wisata</h5>
            </div>
            <div class="card-body" style="background: #f8f9fa;">
                <select name="goal" class="form-select mb-3" required>
                    <option value="">-- Pilih Tujuan --</option>
                    <?php
                    $tujuan_query = mysqli_query($kon, "SELECT * FROM tb_tujuan");
                    while ($t = mysqli_fetch_array($tujuan_query)) {
                        echo "<option value='{$t['id']}'>{$t['tujuan']}</option>";
                    }
                    ?>
                </select>
                <button type="submit" name="submit" class="btn diagnose-btn w-100">Tampilkan Kriteria</button>
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $goal = $_POST['goal'];
        
        // Ambil data tujuan
        $tujuan_data = mysqli_fetch_array(mysqli_query($kon, "SELECT * FROM tb_tujuan WHERE id='$goal'"));
        
        // Ambil kriteria yang diperlukan dari aturan
        $required_premises = isset($rule[$goal]) ? $rule[$goal] : [];
        $criteria_list = [];
        foreach ($required_premises as $premise) {
            $criteria_list[] = getKriteriaDesc($kon, $premise);
        }
        
        echo '<div class="card shadow-sm animate__animated animate__fadeInUp">';
        echo '<div class="card-header" style="background: linear-gradient(135deg, #3498db, #2c3e50); color: #fff;">Kriteria untuk ' . $tujuan_data['tujuan'] . '</div>';
        echo '<div class="card-body" style="background: #f8f9fa;">';
        
        echo "<h3 style='color: #3498db;'>Tujuan: {$tujuan_data['tujuan']}</h3>";
        echo "<div class='result-item'>";
        
        if (!empty($criteria_list)) {
            echo "<h5 style='color: #2c3e50;'>Kriteria yang Diperlukan:</h5>";
            echo "<ul class='timeline'>";
            foreach ($criteria_list as $criteria) {
                echo "<li>$criteria</li>";
            }
            echo "</ul>";
            echo "<p><strong>Info:</strong> {$tujuan_data['info']}</p>";
            echo "<p><strong>Saran:</strong> {$tujuan_data['saran']}</p>";
        } else {
            echo "<div class='alert alert-warning animate__animated animate__shakeX'>";
            echo "Tidak ada kriteria yang ditemukan untuk {$tujuan_data['tujuan']}.";
            echo "</div>";
        }
        
        echo "</div>";
        echo '</div>';
        echo '<div class="card-footer" style="background: #ecf0f1;">';
        echo '<button class="btn print-btn" onclick="window.print()">CETAK</button>';
        echo '</div>';
        echo '</div>';
    }
    ?>
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

    /* Form Select */
    .form-select {
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .form-select:focus {
        border-color: #f1c40f;
        box-shadow: 0 0 10px rgba(241, 196, 15, 0.5);
    }

    /* Result Item */
    .result-item {
        padding: 20px;
        border-radius: 8px;
        background: #fff;
        transition: all 0.3s ease;
    }

    .result-item:hover {
        background-color: #e9ecef;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .result-item p {
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .result-item strong {
        color: #3498db;
    }

    /* Timeline */
    .timeline {
        list-style: none;
        padding: 0 0 0 20px;
        position: relative;
    }

    .timeline li {
        margin-bottom: 15px;
        padding-left: 15px;
        position: relative;
        color: #2c3e50;
        transition: all 0.3s ease;
    }

    .timeline li:hover {
        color: #f1c40f;
        transform: translateX(5px);
    }

    .timeline li:before {
        content: "•";
        position: absolute;
        left: 0;
        color: #3498db;
        font-size: 20px;
    }

    /* Diagnose Button */
    .diagnose-btn {
        background: linear-gradient(135deg, #3498db, #2c3e50);
        border: none;
        border-radius: 8px;
        font-weight: bold;
        padding: 12px;
        color: #fff;
        transition: all 0.3s ease;
    }

    .diagnose-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        background: linear-gradient(135deg, #f1c40f, #3498db);
    }

    /* Print Button */
    .print-btn {
        background: linear-gradient(135deg, #2ecc71, #27ae60);
        border: none;
        border-radius: 8px;
        font-weight: bold;
        padding: 12px 30px;
        color: #fff;
        transition: all 0.3s ease;
    }

    .print-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        background: linear-gradient(135deg, #f1c40f, #2ecc71);
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<?php include 'footer.php'; ?>