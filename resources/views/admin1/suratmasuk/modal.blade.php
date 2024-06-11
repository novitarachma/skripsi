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
                            <input class="form-control" name="dari_instansi" placeholder="Masukan Instansi Pengirim" readonly>
                            <span class="text-danger">
                                <strong id="dari_instansi"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Nomor Surat</label>
                            <input class="form-control" name="no_surat" placeholder="Masukan Nomor Surat" readonly>
                            <span class="text-danger">
                                <strong id="no_surat"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Tanggal Surat</label>
                            <input type="date" class="form-control" name="tanggal_surat" placeholder="Masukan Tanggal Surat" readonly>
                            <span class="text-danger">
                                <strong id="tanggal_surat"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Tanggal Terima</label>
                            <input type="date" class="form-control" name="tanggal_terima" placeholder="Masukan Tanggal Terima" readonly>
                            <span class="text-danger">
                                <strong id="tanggal_terima"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>No Agenda</label>
                            <input class="form-control" name="no_urut" placeholder="Masukan No Urut" readonly>
                            <span class="text-danger">
                                <strong id="no_urut"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Kepada Yth</label>
                            <select name="kepada" id="" class="form-control">
                                <option value="">.: Pilih Kepada Yth :.</option>
                                @foreach ($dataKaryawan as $item)
                                <option value="{{ $item->karyawan['id'].' - '. $item->id }}">
                                    {{ (!empty($item->bagian) ? $item->bagian : '') }}
                                </option>
                                @endforeach
                            </select>
                            {{-- <input class="form-control" name="kepada" placeholder="Masukan Kepada Yth" readonly> --}}
                            <span class="text-danger">
                                <strong id="kepada"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Perihal</label>
                            <input class="form-control" name="perihal" placeholder="Masukan Perihal" readonly>
                            <span class="text-danger">
                                <strong id="perihal"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Kategori</label>
                            <select class="form-control" name="kategori_surat" readonly>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="penting">Penting</option>
                                <option value="biasa">Biasa</option>
                            </select>
                            <span class="text-danger">
                                <strong id="kategori_surat"></strong>
                            </span>
                        </div>
                        <div class="col-md-5 col-12 mb-3">
                        </div>
                        <h6>Isi Form Dibawah Ini :</h6>
                        <div class="col-md-12 col-12 mb-3">
                            <hr>
                        </div>
                     
                        <div class="col-md-6 col-12 mb-3">
                            <label>Tindakan</label>
                            <select class="form-control selectpicker" name="tindakan">
                                <option value="">-- Pilih Tindakan --</option>
                                <option value="Diketahui dan File">Diketahui dan File</option>
                                <option value="Proses Selesai">Proses Selesai</option>
                                <option value="Teliti dan Pendapat">Teliti dan Pendapat</option>
                                <option value="Buatkan Resume">Buatkan Resume</option>
                                <option value="Edaran">Edaran</option>
                                <option value="Sesuai Disposisi">Sesuai Disposisi</option>
                                <option value="Bicarakan dengan Saya">Bicarakan dengan Saya</option>
                            </select>
                            <span class="text-danger">
                                <strong id="tindakan"></strong>
                            </span>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <label>Catatan</label>
                            <textarea class="form-control" name="catatan" id="catatan" cols="30" rows="10"></textarea>
                            <span class="text-danger">
                                <strong id="tindakan"></strong>
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