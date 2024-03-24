<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include('inc/koneksi.php');

$query = "SELECT * FROM uraian_pngl";
$result = mysqli_query($koneksi, $query);

// Simpan hasil query dalam array
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data Kategori Akun</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'partials/navbar_hrd.php'; ?>
    <div class="container-fluid">
        <div class="col-lg-10 mx-auto">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Master Data Uraian Pengeluaran</h1>
            </div>

            <!-- Daftar pengurus -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <?php
                    if (isset($_SESSION['berhasil_tambah'])) {

                        echo $_SESSION['berhasil_tambah'];
                        unset($_SESSION['berhasil_tambah']);
                    }
                    if (isset($_SESSION['berhasil_hapus'])) {

                        echo $_SESSION['berhasil_hapus'];
                        unset($_SESSION['berhasil_hapus']);
                    }
                    if (isset($_SESSION['berhasil_ubah'])) {

                        echo $_SESSION['berhasil_ubah'];
                        unset($_SESSION['berhasil_ubah']);
                    }
                    if (isset($_SESSION['gagal'])) {

                        echo $_SESSION['gagal'];
                        unset($_SESSION['gagal']);
                    }
                    ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahUraianModal">
                        <i class="fas fa-plus-circle mr-2"></i> Tambah Data Uraian pengeluaran
                    </button>
                    <?php include 'form/form_tambah_uraian.php'; ?>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                             
                                    <th class="text-center">Kategori</th>
                                    <!-- <th class="text-center">Nama Kategori</th> -->
                                    <!-- <th class="text-center">Divisi</th> -->
                                    <!-- <th class="text-center">Telepon</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Jenis Kelamin</th> -->
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Daftar pengurus dari database -->

                                <?php foreach ($data as $row) : ?>
                                    <tr>
                                      
                                        <td class='text-center'><?php echo $row['uraian']; ?></td>
                                    
                                        <td class='text-center'>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" onclick='edit(<?= json_encode($row); ?>)'>
                                                <i class="fas fa-pen"></i>edit
                                            </button>
                                            <span class='mx-1'></span>
                                            <a href='proses_hapus_uraian.php?id=<?php echo $row['id']; ?>' class='btn btn-danger btn-sm' onclick='return confirm("Anda yakin ingin menghapus pengurus ini?")'><i class='fas fa-trash'></i> Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Uraian</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Tambah Pengurus -->
                        <form action="proses_edit_uraian.php" method="POST">
                            <div class="form-row">
                                <!-- <div class="form-group col-md-12">
                                    <label for="id">id</label>
                                    <input type="number" class="form-control" id="id_edit" name="idd" required>
                                </div> -->
                                <input type="hidden" id="edit_as" name="id">
                          
                                <div class="form-group col-md-12">
                                    <label for="uraian">Uraian</label>
                                    <input type="text" class="form-control" id="uraian_edit" name="uraian" required>
                                </div>
                                <!-- <div class="form-group col-md-12">
                                    <label for="Kategori"> Kategori Uraian</label>
                                    <select class="form-control" id="kategori_pengeluaran_edit" name="kategori_pengeluaran" required> -->
                                        <!-- <option value="">Pilih Kategori</option> -->
                                        <!-- <option value="administrasi dan umum">administrasi dan umum</option>
                                        <option value="operasional">operasional</option>
                                    </select>
                                </div> -->
                                <!-- <div class="form-group col-md-6">
                <label for="id_jabatan">Divisi:</label>
                <select class="form-control" id="id_jabatan" name="id_jabatan" required>
                            <option value="">Pilih Divisi</option>
                           
                        </select>
            </div>  -->
                            </div>
                            <!-- <div class="form-row">
            <div class="form-group col-md-6">
                <label for="telepon">Telepon:</label>
                <input type="text" class="form-control" id="telepon" name="telepon" required>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div> -->
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Simpan</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>



        <script>
            function edit(data) {
                // console.log(data);


                // document.getElementById('id_edit').value = data.id
                document.getElementById('edit_as').value = data.id
                document.getElementById('uraian_edit').value = data.uraian
                // var select = document.getElementById('kategori_pengeluaran_edit');
                // for (var i = 0; i < select.options.length; i++) {
                //     if (select.options[i].value === data.kategori_pengeluaran) {
                //         select.selectedIndex = i;
                //         break;
                //     }
                // }
            }
        </script>

        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/script.js"></script>
</body>

</html>