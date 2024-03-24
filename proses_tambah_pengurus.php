<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('inc/koneksi.php');

// Pastikan data yang diterima valid
if (isset($_POST['divisi']) && isset($_POST['penanggung_jawab'])) {
    $penanggung_jawab = $_POST['penanggung_jawab'];
    $divisi = $_POST['divisi'];
    // $id_jabatan = $_POST['id_jabatan'];
    // $telepon = $_POST['telepon'];
    // $email = $_POST['email'];
    // $alamat = $_POST['alamat'];
    // $jenis_kelamin = $_POST['jenis_kelamin'];

    // Lakukan proses tambah data pengurus ke dalam database
    $query = "INSERT INTO pengurus (divisi,penanggung_jawab) VALUES ('$divisi','$penanggung_jawab')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika proses tambah data berhasil, arahkan kembali ke halaman pengurus
        $_SESSION['berhasil_tambah'] = '<div class="alert alert-success" role="alert">Data berhasil di tambah.</div>';
        header("Location: pengurus_hrd.php");
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
