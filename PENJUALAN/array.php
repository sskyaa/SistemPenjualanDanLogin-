<?php

$nama_barang   = ["Tas Ransel", "Sepatu", "Seragam", "Hijab Segi Empat", "Dasi"];
$harga_barang  = [120000, 200000, 400000, 30000, 10000];
$kode_barang   = ["AR01", "AR02", "AR03", "AR04", "AR05"];

shuffle($nama_barang);

$jumlah_produk = rand(1, count($nama_barang));

$beli = [];
$jumlah = [];
$total = [];
$grandtotal = 0;

for ($i = 0; $i < $jumlah_produk; $i++) {
    $beli[$i] = $nama_barang[$i];       // nama barang yang dibeli
    $jumlah[$i] = rand(1, 5);           // jumlah barang acak
    $index_harga = array_search($beli[$i], ["Tas Ransel", "Sepatu", "Seragam", "Hijab Segi Empat", "Dasi"]);
    $total[$i] = $harga_barang[$index_harga] * $jumlah[$i]; // total per barang
    $grandtotal += $total[$i];
}


// Hitung diskon
if ($grandtotal <= 50000) {
    $persen_diskon = 5;
} elseif ($grandtotal <= 100000) {
    $persen_diskon = 10;
} else {
    $persen_diskon = 20;
}

$diskon = ($persen_diskon / 100) * $grandtotal;
$grandtotal_akhir = $grandtotal - $diskon;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>POLGAN MART</title>
    <!-- Taruh link CSS di sini, di dalam <head> -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>🛍 POLGAN MART 🛍</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total</th>
        </tr>
        <?php
        $no = 1;
        foreach ($beli as $i => $barang) {
            $harga = $total[$i] / $jumlah[$i];
            echo "<tr>
                    <td>$no</td>
                    <td>$barang</td>
                    <td>$jumlah[$i]</td>
                    <td>Rp ".number_format($harga,0,',','.')."</td>
                    <td>Rp ".number_format($total[$i],0,',','.')."</td>
                  </tr>";
            $no++;
        }
        ?>
    </table>
    <div class="total">
    <div class="total-row">
        <span>Subtotal:</span>
        <span>Rp <?php echo number_format($grandtotal,0,',','.'); ?></span>
    </div>
    <div class="total-row">
        <span>Diskon (<?php echo $persen_diskon; ?>%):</span>
        <span>-Rp <?php echo number_format($diskon,0,',','.'); ?></span>
    </div>
    <div class="total-row">
        <span>Total Bayar:</span>
        <span>Rp <?php echo number_format($grandtotal_akhir,0,',','.'); ?></span>
    </div>
</div>
</div>
</body>
</html>
