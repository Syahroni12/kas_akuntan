<div class="modal fade" id="tambahUraianModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Uraian</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
    <!-- Form Tambah Pengurus -->
    <form action="proses_tambah_uraian.php" method="POST">
        <div class="form-row">
            <!-- <div class="form-group col-md-12">
                <label for="id">id</label>
                <input type="number" class="form-control" id="id" name="id" required>
            </div> -->
            <div class="form-group col-md-12">
                <label for="uraian">Uraian</label>
                <input type="text" class="form-control" id="uraian" name="uraian" required>
            </div>
            <!-- <div class="form-group col-md-12">
                <label for="Kategori"> Kategori Uraian</label>
                <select class="form-control" id="kategori_pengeluaran" name="kategori_pengeluaran" required> -->
                            <!-- <option value="">Pilih Kategori</option> -->
                            <!-- <option value="administrasi dan umum">administrasi dan umum</option>
                            <option value="operasional">operasional</option>
                        </select>
            </div> -->
            <!-- <div class="form-group col-md-6">
                <label for="id_jabatan">Divisi:</label>
                <select class="form-control" id="id_jabatan" name="id_jabatan" required>
                            <option value="">Pilih Divisi</option>
                            <?php
                            include('inc/koneksi.php');
                            $query = "SELECT * FROM jabatan";
                            $result = mysqli_query($koneksi, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                // echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                            }
                            ?>
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
