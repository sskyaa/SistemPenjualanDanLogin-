<?php
session_start();

// Cek login
if (!isset($_SESSION['username'])) {
    header("Location: ../LOGIN/login.php");
    exit;
}

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Tambah barang ke keranjang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_item'])) {

    $kode   = trim($_POST['kode']);
    $nama   = trim($_POST['nama']);
    $harga  = intval($_POST['harga']);
    $jumlah = intval($_POST['jumlah']);

    if ($kode !== "" && $nama !== "" && $harga > 0 && $jumlah > 0) {
        $_SESSION['cart'][] = [
            "kode"   => $kode,
            "nama"   => $nama,
            "harga"  => $harga,
            "jumlah" => $jumlah,
            "total"  => $harga * $jumlah
        ];
    }
}

// Kosongkan keranjang
if (isset($_POST['clear'])) {
    $_SESSION['cart'] = [];
}

// Hitung total
$subtotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $subtotal += $item['total'];
}

// Diskon
if ($subtotal <= 50000) {
    $persen = 5;
} elseif ($subtotal <= 100000) {
    $persen = 10;
} else {
    $persen = 20;
}

$diskon = ($persen / 100) * $subtotal;
$total_bayar = $subtotal - $diskon;

?>
<!DOCTYPE html>
<html>
<head>
    <title>POLGAN MART</title>
    <link rel="stylesheet" href="style.css?v=4">
</head>
<body>

<!-- HEADER -->
<div class="header-penjualan">
  <div class="header-left">
      <div class="logo">PM</div>
      <div>
          <div class="title">🤍 POLGAN MART 🤍</div>
      </div>
  </div>

    <div class="right">
        <h3>Selamat datang, <?= $_SESSION['username']; ?>!</h3>
        <span>Role: <?= $_SESSION['role']; ?></span>
        <a href="../LOGIN/logout.php" class="logout-btn">Logout</a>
    </div>
</div>


<div class="container">

<h2>INPUT PEMBELIAN</h2>
<?php
$barang_list = [
    "BRG001" => ["nama" => "Sabun Mandi", "harga" => 15000],
    "BRG002" => ["nama" => "Sikat Gigi", "harga" => 8000],
    "BRG003" => ["nama" => "Pasta Gigi", "harga" => 12000],
    "BRG004" => ["nama" => "Shampoo", "harga" => 20000],
    "BRG005" => ["nama" => "Handuk", "harga" => 30000]
];
?>
<form action="" method="POST" class="form-box">

    <label>Kode Barang</label>
    <select name="kode" id="kodeBarang" required>
        <option value="" disabled selected class="placeholder">Pilih Kode Barang</option>
        <?php foreach ($barang_list as $kode => $data): ?>
            <option value="<?= $kode ?>"><?= $kode ?> - <?= $data['nama'] ?></option>
        <?php endforeach; ?>
    </select>

    <label>Nama Barang</label>
    <input type="text" id="namaBarang" name="nama" readonly required>

    <label>Harga</label>
    <input type="number" id="hargaBarang" name="harga" readonly required>

    <label>Jumlah</label>
    <input type="number" name="jumlah" placeholder="Masukkan Jumlah" required>

    <div class="button-group">
        <button name="add_item" class="btn save">Simpan</button>
        <button type="reset" class="btn cancel">Batal</button>
    </div>

</form>


<h2>Daftar Pembelian</h2>

<table>
    <tr>
        <th>Kode</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Total</th>
    </tr>

    <?php if (empty($_SESSION['cart'])) : ?>
        <tr><td colspan="5" style="text-align:center !important;">Belum ada barang</td></tr>
    <?php else: ?>
        <?php foreach ($_SESSION['cart'] as $item): ?>
        <tr>
            <td><?= $item['kode']; ?></td>
            <td><?= $item['nama']; ?></td>
            <td>Rp <?= number_format($item['harga'],0,',','.'); ?></td>
            <td><?= $item['jumlah']; ?></td>
            <td>Rp <?= number_format($item['total'],0,',','.'); ?></td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<div class="total-box">
    <p><strong>Total Belanja:</strong> Rp <?= number_format($subtotal,0,',','.'); ?></p>
    <p><strong>Diskon:</strong> Rp <?= number_format($diskon,0,',','.'); ?> (<?= $persen; ?>%)</p>
    <p><strong>Total Bayar:</strong> Rp <?= number_format($total_bayar,0,',','.'); ?></p>
</div>

<form method="POST">
    <button name="clear" class="btn-clear">Kosongkan Keranjang</button>
</form>

</div>
<script>
    const barangData = <?= json_encode($barang_list); ?>;

    document.getElementById("kodeBarang").addEventListener("change", function () {
        const kode = this.value;

        if (kode && barangData[kode]) {
            document.getElementById("namaBarang").value = barangData[kode]["nama"];
            document.getElementById("hargaBarang").value = barangData[kode]["harga"];
        } else {
            document.getElementById("namaBarang").value = "";
            document.getElementById("hargaBarang").value = "";
        }
    });
</script>

</body>
</html>
