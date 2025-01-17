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
                            <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" required>
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
                    <button type="submit" class="btn btn-info"><i class="fas fa-edit mr-2"></i>Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>