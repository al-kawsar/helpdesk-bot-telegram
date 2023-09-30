<?php
$kata = "azikin";
$panjangKata = strlen($kata);

if ($panjangKata >= 3) {
    $indeksAcak1 = rand(0, $panjangKata - 1);
    $indeksAcak2 = rand(0, $panjangKata - 1);
    $indeksAcak3 = rand(0, $panjangKata - 1);

    // Pastikan indeks yang dihasilkan berbeda-beda
    while ($indeksAcak2 == $indeksAcak1) {
        $indeksAcak2 = rand(0, $panjangKata - 1);
    }

    while ($indeksAcak3 == $indeksAcak1 || $indeksAcak3 == $indeksAcak2) {
        $indeksAcak3 = rand(0, $panjangKata - 1);
    }

    // Ambil karakter dari indeks yang dihasilkan
    $karakter1 = $kata[$indeksAcak1];
    $karakter2 = $kata[$indeksAcak2];
    $karakter3 = $kata[$indeksAcak3];

    // Pastikan karakter yang diambil adalah huruf (bukan angka)
    if (ctype_alpha($karakter1) && ctype_alpha($karakter2) && ctype_alpha($karakter3)) {
        $hasil = $karakter1 . $karakter2 . $karakter3;
        echo "Karakter acak dari kata '$kata' adalah '$hasil'";
    } else {
        echo "Tidak dapat mengambil karakter huruf acak dari kata '$kata'";
    }
} else {
    echo "Kata terlalu pendek untuk mengambil karakter huruf acak.";
}
?>
