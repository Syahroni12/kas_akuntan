<?php
// Ambil data uraian pengeluaran dari database
include('inc/koneksi.php');
$query = "SELECT * FROM uraian_pngl";
$result = mysqli_query($koneksi, $query);

// Inisialisasi array untuk menyimpan data uraian pengeluaran
$uraianPengeluaran = [];

// Loop melalui hasil query dan masukkan data ke dalam array
while ($row = mysqli_fetch_assoc($result)) {
    $uraianPengeluaran[] = [
        'id' => $row['id'],
        'uraian' => $row['uraian']
        
    ];
}
?>

<div class="modal fade" id="tambahPengeluaranModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pengeluaran Kas</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Penerimaan Kas -->
                <form action="proses_tambah_pengeluaran.php" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nomor_nota">Nomor Nota:</label>
                            <input type="text" class="form-control" id="nomor_nota" name="nomor_nota" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tanggal">Tanggal:</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_pengurus">Nama Pengurus/Pegawai</label>
                        <select class="form-control" id="id_pengurus" name="id_pengurus" required>
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
                    
                        <div class="form-group">
                            <label for="id_uraianpngl">Opsi Pengeluaran</label>
                            <select class="form-control" id="id_uraianpngl" name="ppppp" required>
                                <option value="">Pilih Opsi Pengeluaran terlebih dahulu</option>
                                <?php
                                foreach ($uraianPengeluaran as $uraian) {
                                    echo "<option value='" . $uraian['id'] . "'>" . $uraian['uraian'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                        </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah:</label>
                        <input type="text" class="form-control" id="jumlah" name="jumlah" oninput="formatCurrency(this)" required>
                    </div>
                   
                    <button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    // Definisikan objek JavaScript yang akan menyimpan data uraian pengeluaran
   

    // Fungsi untuk mengaktifkan dan mengisi dropdown "uraian pengeluaran"
    function updateUraianPengeluaran() {
    var selectedOption = document.getElementById("opsi_pengeluaran").value;
    var uraianDropdown = document.getElementById("id_uraianpngl");

    // Kosongkan dropdown "uraian pengeluaran"
    uraianDropdown.innerHTML = "";

    // Tambahkan opsi-opsi ke dropdown "uraian pengeluaran" berdasarkan opsi yang dipilih
    for (var i = 0; i < uraianPengeluaran.length; i++) {
        if (uraianPengeluaran[i].kategori_pengeluaran === selectedOption) {
            var option = document.createElement("option");
            option.text = uraianPengeluaran[i].uraian;
            option.value = uraianPengeluaran[i].id;
            uraianDropdown.appendChild(option);
        }
    }

    // Aktifkan dropdown "uraian pengeluaran"
    // uraianDropdown.disabled = false;
}
</script> -->
<script>
    function formatCurrency(input) {
        // Hapus tanda titik atau koma jika ada
        let valueWithoutCommas = input.value.replace(/[,.]/g, '');

        // Format angka dengan tanda titik sebagai pemisah ribuan
        let formattedValue = new Intl.NumberFormat('id-ID').format(valueWithoutCommas);

        // Tampilkan nilai yang diformat pada input
        input.value = formattedValue;
    }
</script>