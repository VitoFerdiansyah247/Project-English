<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $harga = isset($_POST['harga']) ? (float)$_POST['harga'] : 0;
    $qty = isset($_POST['qty']) ? (int)$_POST['qty'] : 0;
    $diskonPersen = isset($_POST['diskon']) ? (float)$_POST['diskon'] : 0;
    $ppnPersen = isset($_POST['ppn']) ? (float)$_POST['ppn'] : 0;
    $jumlahOrang = isset($_POST['jumlah_orang']) ? (int)$_POST['jumlah_orang'] : 1;

    // OPERASI ARITMATIKA
    $subtotalBruto = $harga * $qty;                         // Perkalian
    $nominalDiskon = $subtotalBruto * ($diskonPersen / 100); // Perkalian & Pembagian
    $subtotalNetto = $subtotalBruto - $nominalDiskon;       // Pengurangan
    $nominalPPN = $subtotalNetto * ($ppnPersen / 100);      // Perkalian & Pembagian

    $totalBayar = $subtotalNetto + $nominalPPN;             // Penjumlahan

    $pembagi = $jumlahOrang > 0 ? $jumlahOrang : 1;
    $bayarPerOrang = $totalBayar / $pembagi;                 // Pembagian

} else {

    header('Location: index.html');
    exit;
}

function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Perhitungan Kasir</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">

        <h2>Hasil Rincian Transaksi</h2>

        <div class="result-box">

            <div class="result-row">
                <span>Subtotal Bruto:</span>
                <strong><?= formatRupiah($subtotalBruto) ?></strong>
            </div>

            <div class="result-row text-danger">
                <span>Potongan Diskon (<?= $diskonPersen ?>%):</span>
                <strong>- <?= formatRupiah($nominalDiskon) ?></strong>
            </div>

            <div class="result-row">
                <span>Subtotal Netto:</span>
                <strong><?= formatRupiah($subtotalNetto) ?></strong>
            </div>

            <div class="result-row text-success">
                <span>PPN (<?= $ppnPersen ?>%):</span>
                <strong>+ <?= formatRupiah($nominalPPN) ?></strong>
            </div>

            <div class="result-row total">
                <span>Total Bayar:</span>
                <span><?= formatRupiah($totalBayar) ?></span>
            </div>

            <div class="result-row split">
                <span>Bayar per Orang (<?= $jumlahOrang ?> orang):</span>
                <strong><?= formatRupiah($bayarPerOrang) ?></strong>
            </div>

        </div>

        <a href="index.html" class="btn-back">
            Kembali ke Form Kasir
        </a>

    </div>
</body>
</html>