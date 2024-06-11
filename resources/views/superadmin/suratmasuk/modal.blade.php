<!-- Modal -->
<div class="modal fade" id="modal-form">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <input type="hidden" name="id">
                        <div class="col-md-6 col-12 mb-3">
                            <label>Instansi Pengirim</label>
                            <input class="form-control" name="dari_instansi" placeholder="Masukan Instansi Pengirim">
                            <span class="text-danger">
                                <strong id="dari_instansi"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Nomor Surat</label>
                            <input class="form-control" name="no_surat" placeholder="Masukan Nomor Surat">
                            <span class="text-danger">
                                <strong id="no_surat"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Tanggal Pelaksanaan Kegiatan</label>
                            <input type="date" class="form-control" name="tanggal_surat" placeholder="Masukan Tanggal Surat">
                            <span class="text-danger">
                                <strong id="tanggal_surat"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Tanggal Terima</label>
                            <input type="date" class="form-control" name="tanggal_terima" placeholder="Masukan Tanggal Terima">
                            <span class="text-danger">
                                <strong id="tanggal_terima"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>No Agenda</label>
                            <input class="form-control" name="no_urut" placeholder="Masukan No Urut" readonly="true" value="{{ $newNoUrut}}">
                            <span class="text-danger">
                                <strong id="no_urut"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                        <label>Kepada</label>
                            <select class="form-control" name="kategori_surat">
                                <option value="">-- Disposisi Kepada --</option>
                                <option value="Direktur Keuangan & Umum">Direktur Keuangan & Umum</option>
                                <option value="General Manager FA & HCGA">General Manager FA & HCGA</option>
                                <option value="General Manager Operation">General Manager Operation</option>
                                <option value="Manager Finance & Tax">Manager Finance & Tax</option>
                                <option value="Manager HCGA">Manager HCGA</option>
                                <option value="Manager Operaional">Manager Operaional</option>
                                <option value="Manager Maintenance">Manager Maintenance</option>
                                <option value="Secretary">Secretary</option>
                                <option value="Staf">Staf</option>
                            </select>
                            <span class="text-danger">
                                <strong id="kepada"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Perihal</label>
                            <input class="form-control" name="perihal" placeholder="Masukan Perihal">
                            <span class="text-danger">
                                <strong id="perihal"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Kategori</label>
                            <select class="form-control" name="kategori_surat">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="penting">Penting</option>
                                <option value="biasa">Biasa</option>
                            </select>
                            <span class="text-danger">
                                <strong id="kategori_surat"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Klasifikasi</label>
                            <select class="form-control" name="klasifikasi">
                                <option value="">-- Pilih Klasifikasi --</option>
                                <option value="internal">Internal</option>
                                <option value="eksternal">Eksternal</option>
                            </select>
                            <span class="text-danger">
                                <strong id="klasifikasi"></strong>
                            </span>
                        </div>
                        {{-- <div class="col-md-6 col-12 mb-3">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="">-- Pilih Status --</option>
                                <option value="diajukan">Diajukan Kembali</option>
                                <option value="ditolak">Ditolak</option>
                                <option value="didisposisi">Didisposisi</option>
                                <option value="dilaksanakan">Dilaksanakan</option>
                                <option value="selesai">Didisposisi</option>
                            </select>
                            <span class="text-danger">
                                <strong id="status"></strong>
                            </span>
                        </div> --}}
                        <div class="col-md-6 col-12 mb-3">
                            <label>File Lampiran</label>
                            <input type="file" class="form-control" name="lampiran" placeholder="Masukkan Lampiran">
                            <span class="text-danger">
                                <strong id="lampiran"></strong>
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