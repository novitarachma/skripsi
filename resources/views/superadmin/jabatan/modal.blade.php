<!-- Modal -->
<div class="modal fade" id="modal-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="form">
                <div class="modal-body">
                    <div class="form-row">
                        <input type="hidden" name="id">
                        <div class="col-md-12 col-12 mb-3">
                            <label>Divisi</label>
                            <select class="form-control" name="divisi">
                                <option value="">-- Pilih Divisi --</option>
                                <option value="Keuangan & Umum">Keuangan & Umum</option>
                                <option value="FA & HCGA">FA & HCGA</option>
                                <option value="Operation">Operation</option>
                                <option value="Finance & Tax">Finance & Tax</option>
                                <option value="Maintenance">Maintenance</option>
                            </select>
                            <span class="text-danger">
                                <strong id="divisi"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 col-12 mb-3">
                            <label>Nama Jabatan</label>
                            <input class="form-control" name="nama_jabatan_bidang" placeholder="Masukan Nama Jabatan">
                            <span class="text-danger">
                                <strong id="nama_jabatan_bidang"></strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="save()" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- basic modal end -->