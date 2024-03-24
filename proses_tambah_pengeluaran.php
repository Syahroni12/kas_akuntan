<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('inc/koneksi.php');

// Pastikan data yang diterima valid

if (isset($_POST['nomor_nota']) && isset($_POST['tanggal']) && isset($_POST['ppppp']) && isset($_POST['jumlah'])&& isset($_POST['id_pengurus'])&& isset($_POST['keterangan']) ) {
    $nomor_nota = $_POST['nomor_nota'];
    $tanggal = $_POST['tanggal'];
    $id_pengurus = $_POST['id_pengurus'];
    $id_uraianpngl = $_POST['ppppp'];
    $keterangan = $_POST['keterangan'];

    $jumlah = $_POST['jumlah'];
    $jumlah_fix = preg_replace("/[^0-9]/", "", $jumlah);

    // Lakukan proses tambah penerimaan kas ke database
    $query = "INSERT INTO pengeluaran (nomor_nota, tanggal, id_pengurus,  id_uraianpngl, jumlah,keterangan) VALUES ('$nomor_nota', '$tanggal', '$id_pengurus', '$id_uraianpngl', '$jumlah_fix','$keterangan')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $_SESSION['berhasil_tambah'] = '<div class="alert alert-success" role="alert">Data berhasil di tambah.</div>';
        header("Location: pengeluaran.php");
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
} else {
    // Jika data tidak lengkap, tampilkan pesan error
    echo "Data yang diterima tidak lengkap";
}
?>
