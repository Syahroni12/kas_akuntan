<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include('inc/koneksi.php');

$query = "SELECT * FROM pengurus";
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
    <title>Master Data Pengurus</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'partials/navbar_hrd.php'; ?>
    <div class="container-fluid">
        <div class="col-lg-10 mx-auto">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Master Data Penanggung jawab</h1>
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
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahPengurusModal">
                        <i class="fas fa-plus-circle mr-2"></i> Tambah Penanggung Jawab
                    </button>
                    <?php include 'form/form_tambah_pengurus.php'; ?>
            
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <!-- <th class="text-center">Kode Penanggung Jawab</th> -->
                                    <th class="text-center">Divisi</th>
                                    <th class="text-center">Nama Penanggung Jawab</th>
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
            <!-- <td class='text-center'><?php echo $row['id']; ?></td> -->
            <td class='text-center'><?= $row['divisi']; ?></td>
            <td class='text-center'><?= $row['penanggung_jawab']; ?></td>
            
            <td class='text-center'>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPengurusModal" onclick='edit(<?= json_encode($row); ?>)'>
            edit
            </button>
            <span class='mx-1'></span>

                |
                <a href='proses_hapus_pengurus.php?id=<?= $row['id']; ?>' class='btn btn-danger btn-sm' onclick='return confirm("Anda yakin ingin menghapus pengurus ini?")'><i class='fas fa-trash'></i> Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="editPengurusModal" tabindex="-1" role="dialog" aria-labelledby="editPengurusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="editPengurusModalLabel">Edit Divisi</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <!-- Form Edit Pengurus -->
                <form id="editPengurusForm" action="proses_edit_pengurus.php" method="POST">
                    <input type="hidden" id="edit_id" name="edit_id">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="edit_divisi">Divisi</label>
                            <input type="text" class="form-control" id="edit_divisi" name="edit_divisi" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="penanggung_jawab">Penanggung Jawab</label>
                            <input type="text" class="form-control" id="edit_pngj" name="penanggung_jawab" required>
                        </div>
                        <!-- <div class="form-group col-md-6">
                            <label for="edit_id_jabatan">Jabatan:</label>
                            <select class="form-control" id="edit_id_jabatan" name="edit_id_jabatan" required>
                                <option value="">Pilih Jabatan</option>
                                
                            </select>
                        </div> -->
                    </div>
                    <!-- <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="edit_telepon">Telepon:</label>
                            <input type="text" class="form-control" id="edit_telepon" name="edit_telepon" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edit_email">Email:</label>
                            <input type="email" class="form-control" id="edit_email" name="edit_email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_alamat">Alamat:</label>
                        <textarea class="form-control" id="edit_alamat" name="edit_alamat" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_jenis_kelamin">Jenis Kelamin:</label>
                        <select class="form-control" id="edit_jenis_kelamin" name="edit_jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div> -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info"><i class="fas fa-edit mr-2"></i>Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function edit(data) {
        // console.log(data);
        

        document.getElementById('edit_id').value = data.id
        // document.getElementById('edit_as').value = data.id
        document.getElementById('edit_divisi').value = data.divisi
        document.getElementById('edit_pngj').value = data.penanggung_jawab
       
     }
</script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
       
        <!-- <script>
    // Menangani ketika tombol "Edit" diklik
    $('.editBtn').click(function() {
        // Mendapatkan nilai atribut data dari tombol "Edit"
        var id = $(this).data('id');
        var divisi = $(this).data('divisi');
        var penanggung_jawab = $(this).data('penanggung_jawab'); // Mendapatkan data penanggung jawab

        // Menetapkan nilai data ke dalam input di modal edit
        $('#edit_id').val(id);
        $('#edit_divisi').val(divisi);
        $('#penanggung_jawab').val(penanggung_jawab);

        // Menampilkan modal edit
        $('#editPengurusModal').modal('show');
    });
</script> -->
<script>

</script>

</body>

</html>