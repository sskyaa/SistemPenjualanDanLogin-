<?php
echo "<h2> === POLGAN MART === </h2>";

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
}

$no = 1;
foreach ($beli as $i => $barang) {
    $harga = $total[$i] / $jumlah[$i];
    printf("%-3s %-22s %-6s Rp %-10s Rp %-10s\n",
        $no,
        $barang,
        $jumlah[$i],
        number_format($harga, 0, ',', '.'),
        number_format($total[$i], 0, ',', '.')
    );
    $grandtotal += $total[$i];
    $no++;
}
