<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('inc/koneksi.php');

// Pastikan data yang diterima valid
if (isset($_POST['nomor_nota']) && isset($_POST['tanggal']) && isset($_POST['id_pengurus']) && isset($_POST['jumlah'])) {
    $nomor_nota = $_POST['nomor_nota'];
    $tanggal = $_POST['tanggal'];
    $id_pengurus = $_POST['id_pengurus'];
    $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
    $jumlah = $_POST['jumlah'];

    // Lakukan proses tambah penerimaan kas ke database
    $query = "INSERT INTO pengeluaran (nomor_nota, tanggal, id_pengurus,  keterangan, jumlah) VALUES ('$nomor_nota', '$tanggal', '$id_pengurus', '$keterangan', '$jumlah')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika proses tambah berhasil, arahkan kembali ke halaman penerimaan kas
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
