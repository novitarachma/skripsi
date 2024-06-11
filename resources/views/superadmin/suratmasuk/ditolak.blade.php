<!-- Modal -->
<div class="modal fade" id="modal-form-ditolak">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="form-ditolak" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <input type="hidden" name="id">
                        <div class="col-md-5 col-12 mb-3">
                        </div>
                        <h6>Isi Form Dibawah Ini :</h6>
                        <div class="col-md-12 col-12 mb-3">
                            <hr>
                        </div>
                        <div class="col-md-3 col-12 mb-3">
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="">-- Pilih Status --</option>
                                <option value="ditolak">Ditolak</option>
                                <option value="diajukan">Diajukan Kembali</option>
                            </select>
                            <span class="text-danger">
                                <strong id="status"></strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="save_ditolak()" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- basic modal end -->