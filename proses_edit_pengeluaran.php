<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include('inc/koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nomor_nota = $_POST['nomor_notaa'];
    $tanggal = $_POST['tanggal'];
    $pengurus_id = $_POST['id_pengurus'];
    $keterangan = $_POST['id_uraianpngl'];
 
    $jumlah = $_POST['jumlah'];
    $jumlah_fix = preg_replace("/[^0-9]/", "", $jumlah);

    $query = "UPDATE pengeluaran SET nomor_nota='$nomor_nota', tanggal='$tanggal', id_pengurus='$pengurus_id', id_uraianpngl='$keterangan', jumlah='$jumlah_fix' WHERE id='$id'";
    
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['berhasil_ubah'] = '<div class="alert alert-success" role="alert">Data berhasil di ubah.</div>';
        header("Location: pengeluaran.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>
