<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('inc/koneksi.php');

// Pastikan data yang diterima valid
if (isset($_POST['edit_id']) && isset($_POST['edit_divisi'])&& isset($_POST['penanggung_jawab'])) {
    $edit_id = $_POST['edit_id'];
    $edit_divisi = $_POST['edit_divisi'];
    $penanggung_jawab = $_POST['penanggung_jawab'];
    // $edit_id_jabatan = $_POST['edit_id_jabatan'];
    // $edit_telepon = $_POST['edit_telepon'];
    // $edit_email = $_POST['edit_email'];
    // $edit_alamat = $_POST['edit_alamat'];
    // $edit_jenis_kelamin = $_POST['edit_jenis_kelamin'];

    // Lakukan proses update di database
    $query = "UPDATE pengurus SET divisi='$edit_divisi',penanggung_jawab='$penanggung_jawab' WHERE id='$edit_id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika proses update berhasil, arahkan kembali ke halaman pengurus
        $_SESSION['berhasil_ubah'] = '<div class="alert alert-success" role="alert">Data berhasil di ubah.</div>';
        header("Location: pengurus_hrd.php");
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
} else {
    // Jika data tidak lengkap, tampilkan pesan error
    $_SESSION['gagal'] = '<div class="alert alert-danger" role="alert">Data Tidak Lengkap.</div>';
}
?>
