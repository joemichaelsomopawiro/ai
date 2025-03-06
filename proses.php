<?php
include 'koneksi.php';
include 'header.php';

// Fungsi untuk mendapatkan deskripsi kriteria berdasarkan kode
function getKriteriaDesc($kon, $kode) {
    $query = "SELECT kriteria FROM tb_kriteria WHERE kode='$kode'";
    $result = mysqli_query($kon, $query);
    $row = mysqli_fetch_array($result);
    return $row ? $row['kriteria'] : $kode;
}

// Fungsi Backward Chaining
function backwardChaining($goal, $rules, $facts, &$chain, $kon) {
    if (in_array($goal, $facts)) {
        $chain[] = "Fakta ditemukan: " . getKriteriaDesc($kon, $goal);
        return true;
    }
    
    foreach ($rules as $rule) {
        if ($rule['conclusion'] == $goal) {
            $allPremisesMet = true;
            foreach ($rule['premises'] as $premise) {
                if (!in_array($premise, $facts)) {
                    $allPremisesMet = false;
                    if (backwardChaining($premise, $rules, $facts, $chain, $kon)) {
                        $facts[] = $premise;
                        $chain[] = "Ditemukan: " . getKriteriaDesc($kon, $premise);
                    }
                }
            }
            if ($allPremisesMet) {
                $tujuan_data = mysqli_fetch_array(mysqli_query($kon, "SELECT tujuan FROM tb_tujuan WHERE id='$goal'"));
                $chain[] = "Kesimpulan: {$tujuan_data['tujuan']}";
                return true;
            }
        }
    }
    return false;
}

if (isset($_POST['submit'])) {
    // Forward Chaining
    array_pop($_POST);
    $db_rule = mysqli_query($kon, "SELECT * FROM tb_rule");
    $arr_rule = [];
    while ($d = mysqli_fetch_array($db_rule)) {
        $arr_rule[] = $d;
    }
    
    $rule = [];
    $rule_ids = [];
    foreach ($arr_rule as $row) {
        $sub_rule = [];
        foreach ($row as $key => $value) {
            if (!is_numeric($key) && $value == 1 && $key != 'id') {
                $sub_rule[] = $key;
            }
        }
        $rule[] = [
            'premises' => $sub_rule,
            'conclusion' => $row['id']
        ];
        $rule_ids[] = $row['id'];
    }
    
    $facts = array_values($_POST);
    $matched_rules = [];
    
    // Forward Chaining Process
    foreach ($rule as $index => $r) {
        $match_count = count(array_intersect($facts, $r['premises']));
        $total_count = count($r['premises']);
        $percentage = ($total_count > 0) ? ($match_count / $total_count) * 100 : 0;
        
        if ($percentage > 0) {
            $matched_rules[] = [
                'id' => $rule_ids[$index],
                'percentage' => $percentage
            ];
        }
    }
    
    echo '<div class="container mt-5">';
    echo '<h1 class="text-center mb-4 animate__animated animate__bounceIn" style="color: #2c3e50;">Hasil Diagnosa</h1>';
    
    // Backward Chaining Process
    $backward_results = [];
    foreach ($rule_ids as $goal) {
        $chain = [];
        if (backwardChaining($goal, $rule, $facts, $chain, $kon)) {
            $backward_results[$goal] = $chain;
        }
    }
    
    if (!empty($matched_rules) || !empty($backward_results)) {
        // Forward Chaining Results
        if (!empty($matched_rules)) {
            usort($matched_rules, function($a, $b) {
                return $b['percentage'] <=> $a['percentage'];
            });
            
            echo '<div class="card mb-4 shadow-sm animate__animated animate__fadeInUp">';
            echo '<div class="card-header" style="background: linear-gradient(135deg, #3498db, #2c3e50); color: #fff;">Hasil Forward Chaining</div>';
            echo '<div class="card-body" style="background: #f8f9fa;">';
            
            $top_matches = array_slice($matched_rules, 0, 3);
            foreach ($top_matches as $match) {
                $query_tujuan = "SELECT * FROM tb_tujuan WHERE id='{$match['id']}'";
                $result_tujuan = mysqli_query($kon, $query_tujuan);
                
                while ($tujuan_data = mysqli_fetch_array($result_tujuan)) {
                    echo "<div class='result-item'>";
                    echo "<h3 style='color: #3498db;'>{$tujuan_data['tujuan']} <span class='badge bg-success'>" . round($match['percentage'], 2) . "%</span></h3>";
                    echo "<p><strong>Info:</strong> {$tujuan_data['info']}</p>";
                    echo "<p><strong>Saran:</strong> {$tujuan_data['saran']}</p>";
                    echo "</div>";
                }
            }
            echo '</div></div>';
        }
        
        // Backward Chaining Results
        if (!empty($backward_results)) {
            echo '<div class="card shadow-sm animate__animated animate__fadeInUp">';
            echo '<div class="card-header" style="background: linear-gradient(135deg, #2ecc71, #27ae60); color: #fff;">Hasil Backward Chaining</div>';
            echo '<div class="card-body" style="background: #f8f9fa;">';
            foreach ($backward_results as $goal => $chain) {
                $tujuan_data = mysqli_fetch_array(mysqli_query($kon, "SELECT * FROM tb_tujuan WHERE id='$goal'"));
                echo "<div class='result-item'>";
                echo "<h3 style='color: #2ecc71;'>{$tujuan_data['tujuan']}</h3>";
                echo "<ul class='timeline'>";
                foreach ($chain as $step) {
                    echo "<li>$step</li>";
                }
                echo "</ul>";
                echo "<p><strong>Info:</strong> {$tujuan_data['info']}</p>";
                echo "<p><strong>Saran:</strong> {$tujuan_data['saran']}</p>";
                echo "</div>";
            }
            echo '</div></div>';
        }
    } else {
        include 'error.php';
    }
    echo '<div class="text-center mt-4"><button class="btn print-btn" onclick="window.print()">CETAK</button></div>';
    echo '</div>';
}

include 'footer.php';
?>

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

    /* Result Item */
    .result-item {
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 8px;
        background: #fff;
        transition: all 0.3s ease;
    }

    .result-item:hover {
        background-color: #e9ecef;
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .result-item h3 {
        margin-bottom: 15px;
    }

    .result-item p {
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .result-item strong {
        color: #3498db;
    }

    /* Timeline for Backward Chaining */
    .timeline {
        list-style: none;
        padding: 0 0 0 20px;
        position: relative;
    }

    .timeline li {
        margin-bottom: 10px;
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
        color: #2ecc71;
        font-size: 20px;
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