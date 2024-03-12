<?php
include('inc/koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    // $gaji = $_POST['gaji'];
    // $tunjangan = $_POST['tunjangan'];

    $query = "INSERT INTO jabatan (kode, nama) VALUES ('$kode', '$nama')";
    
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['success_message'] = "Data jabatan berhasil diperbarui.";
        header("Location: jabatan_hrd.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>
