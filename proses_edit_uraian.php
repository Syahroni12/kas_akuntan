<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('inc/koneksi.php');

// Pastikan data yang diterima valid
if (isset($_POST['id']) && isset($_POST['uraian'])) {
    $id = $_POST['id'];
    
    $uraian = $_POST['uraian'];
    
    // $edit_id_jabatan = $_POST['edit_id_jabatan'];
    // $edit_telepon = $_POST['edit_telepon'];
    // $edit_email = $_POST['edit_email'];
    // $edit_alamat = $_POST['edit_alamat'];
    // $edit_jenis_kelamin = $_POST['edit_jenis_kelamin'];

    // Lakukan proses update di database
    $query = "UPDATE uraian_pngl SET uraian='$uraian' WHERE id='$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika proses update berhasil, arahkan kembali ke halaman pengurus
        $_SESSION['berhasil_ubah'] = '<div class="alert alert-success" role="alert">Data berhasil di ubah.</div>';
        header("Location: kategori_akun.php");
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        $_SESSION['gagal'] = '<div class="alert alert-danger" role="alert">Data gagal diubah.</div>';
    }
} else {
    // Jika data tidak lengkap, tampilkan pesan error
    $_SESSION['gagal'] = '<div class="alert alert-danger" role="alert">Data Tidak Lengkap.</div>';
}
?>
