<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include('inc/koneksi.php');
include('inc/koneksi.php');

$query = "SELECT p.*, pengurus.divisi AS divisi,pengurus.penanggung_jawab AS penanggung_jawab, uraian_pngl.uraian AS uraian FROM pengeluaran p JOIN pengurus ON p.id_pengurus = pengurus.id JOIN uraian_pngl ON p.id_uraianpngl = uraian_pngl.id";
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
    <title>pengeluaran Kas</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'partials/navbar.php'; ?>
    <div class="container-fluid">
        <div class="col-lg-10 mx-auto">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Pengeluaran Kas</h1>
            </div>

            <!-- Tabel Data pengeluaran Kas -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
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
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahPengeluaranModal">
                        <i class="fas fa-plus-circle mr-2"></i> Tambah pengeluaran kas
                    </button>
                    <?php include 'form/form_tambah_pengeluaran.php'; ?>
                    <?php include 'form/form_edit_pengeluaran.php'; ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">Nomor Nota</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Nama Penanggung Jawab</th>
                                    <th class="text-center">Divisi</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $row_pengeluaran) : ?>
                                    <tr>
                                        <td><?= $row_pengeluaran['nomor_nota'] ?></td>
                                        <td><?= $row_pengeluaran['tanggal'] ?></td>
                                        <td><?= $row_pengeluaran['penanggung_jawab'];?></td>
                                        <td><?= $row_pengeluaran['divisi'];?></td>
                                        <td><?= $row_pengeluaran['uraian'] ?></td>
                                        <td><?= $row_pengeluaran['keterangan'] ?></td>
                                        <td>Rp <?= number_format($row_pengeluaran['jumlah'], 0, ',', '.') ?></td>
                                        <td class="text-center">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" onclick='edit(<?= json_encode($row_pengeluaran); ?>)'>
                                                <i class="fas fa-pen"></i>edit
                                            </button>
                                            <span class="mx-1"></span>
                                            <a href="proses_hapus_pengeluaran.php?id=<?= $row_pengeluaran['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus pengurus ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
// Ambil data uraian pengeluaran dari database
include('inc/koneksi.php');
$query = "SELECT * FROM uraian_pngl";
$result = mysqli_query($koneksi, $query);

// Inisialisasi array untuk menyimpan data uraian pengeluaran
$uraianPengeluarann = [];

// Loop melalui hasil query dan masukkan data ke dalam array
while ($row = mysqli_fetch_assoc($result)) {
    $uraianPengeluarann[] = [
        'id' => $row['id'],
        'uraian' => $row['uraian']
    ];
}
?>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pengeluaran Kas</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Penerimaan Kas -->
                <form action="proses_edit_pengeluaran.php" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nomor_nota">Nomor Nota:</label>
                            <input type="text" class="form-control" id="nomor_notaa" name="nomor_notaa" required>
                        </div>
                        <input type="hidden"name="id"id="id_no">
                        <div class="form-group col-md-6">
                            <label for="tanggal">Tanggal:</label>
                            <input type="date" class="form-control" id="tanggal_edit" name="tanggal" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_pengurus">Nama Pengutus/Pegawai</label>
                        <select class="form-control" id="id_pengurus_edit" name="id_pengurus" required>
                            <option value="">Pilih Divisi</option>
                            <?php
                            include('inc/koneksi.php');
                            $query = "SELECT * FROM pengurus";
                            $result = mysqli_query($koneksi, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['id'] . "'>" . $row['penanggung_jawab'] . '( ' . $row['divisi'] . ')' .  "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- <div class="form-group">
                            <label for="opsi_pengeluaran_edit">Opsi Pengeluaran</label>
                            <select class="form-control" id="opsi_pengeluaran_edit" name="opsi_pengeluaran" required onchange="updateUraianPengeluarann()">
                                <option value="">Pilih Opsi</option>
                                <option value="administrasi dan umum">Administrasi dan Umum</option>
                                <option value="operasional">Operasional</option>
                            </select>
                        </div> -->
                        <div class="form-group">
                            <label for="id_uraianpngl">Opsi Pengeluaran</label>
                            <select class="form-control" id="id_uraianpngl_edit" name="id_uraianpngl" required>
                                <option value="">Pilih Opsi Pengeluaran terlebih dahulu</option>
                                <?php
                                foreach ($uraianPengeluarann as $uraiann) {
                                    echo "<option value='" . $uraiann['id'] . "'>" . $uraiann['uraian'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan_edit" name="keterangan"required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah:</label>
                        <input type="text" class="form-control" id="jumlah_edit" name="jumlah" oninput="formatCurrency(this)" required>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Definisikan objek JavaScript yang akan menyimpan data uraian pengeluaran
    // var uraianPengeluarann = <?php echo json_encode($uraianPengeluarann); ?>;

    // // Fungsi untuk mengaktifkan dan mengisi dropdown "uraian pengeluaran"
    // function updateUraianPengeluarann() {
    // var selectedOptionn = document.getElementById("opsi_pengeluaran_edit").value;
    // var uraianDropdownn = document.getElementById("id_uraianpngl_edit");

    // // Kosongkan dropdown "uraian pengeluaran"
    // uraianDropdownn.innerHTML = "";

    // // Tambahkan opsi-opsi ke dropdown "uraian pengeluaran" berdasarkan opsi yang dipilih
    // for (var i = 0; i < uraianPengeluarann.length; i++) {
    //     if (uraianPengeluarann[i].kategori_pengeluaran === selectedOptionn) {
    //         var option = document.createElement("option");
    //         option.text = uraianPengeluarann[i].uraian;
    //         option.value = uraianPengeluarann[i].id;
    //         uraianDropdownn.appendChild(option);
    //     }
    // }

    // Aktifkan dropdown "uraian pengeluaran"
    // uraianDropdownn.disabled = true;

</script>
<script>
    function formatCurrency(input) {
        // Hapus tanda titik atau koma jika ada
        let valueWithoutCommas = input.value.replace(/[,.]/g, '');

        // Format angka dengan tanda titik sebagai pemisah ribuan
        let formattedValue = new Intl.NumberFormat('id-ID').format(valueWithoutCommas);

        // Tampilkan nilai yang diformat pada input
        input.value = formattedValue;
    }

    function edit(data) {
                // console.log(data);


                document.getElementById('nomor_notaa').value = data.nomor_nota
                document.getElementById('id_no').value = data.id
                document.getElementById('tanggal_edit').value = data.tanggal
                document.getElementById('jumlah_edit').value = data.jumlah
                var select = document.getElementById('id_pengurus_edit');
                for (var i = 0; i < select.options.length; i++) {
                    if (select.options[i].value === data.id_pengurus) {
                        select.selectedIndex = i;
                        break;
                    }
                }
                // var select = document.getElementById('opsi_pengeluaran_edit');
                // for (var i = 0; i < select.options.length; i++) {
                //     if (select.options[i].value === data.kategori) {
                //         select.selectedIndex = i;
                //         break;
                //     }
                // }
                var select = document.getElementById('id_uraianpngl_edit');
                for (var i = 0; i < select.options.length; i++) {
                    if (select.options[i].value === data.id_uraianpngl) {
                        select.selectedIndex = i;
                        break;
                    }
                }
            }

</script>


    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>