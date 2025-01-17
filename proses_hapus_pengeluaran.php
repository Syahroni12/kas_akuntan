<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('inc/koneksi.php');

// Pastikan ID pengurus yang akan dihapus tersedia
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lakukan proses hapus data dari database
    $query = "DELETE FROM pengeluaran WHERE id='$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika proses hapus berhasil, arahkan kembali ke halaman pengurus
        $_SESSION['berhasil_hapus'] = '<div class="alert alert-success" role="alert">Data berhasil di hapus.</div>';
        
        header("Location: pengeluaran.php");
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
} else {
    // Jika ID tidak tersedia, tampilkan pesan error
    echo "ID pengurus tidak tersedia";
}
?>
