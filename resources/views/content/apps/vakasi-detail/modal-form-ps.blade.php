<div
    class="modal fade text-left"
    id="pembuat-soal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="role"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered" id="modal-form" role="dialog" data-backdrop="static">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="modalLabelPembuatSoal">Print Data Honor Pembuat Soal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <section id="basic-vertical-layouts">
                    <div class="row">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" id="formPembuatSoalPrint">
                                @csrf
                                <input type="hidden" id="id_ps" name="id_ps">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtTASoal">Tahun Anggaran<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtTASoal"
                                                class="form-control"
                                                name="txtTASoal"
                                                placeholder="Tahun Anggaran"
                                            />
                                            <div class="invalid-feedback" id="txtTASoal"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtNoBuktiSoal">Nomor Bukti<span style="color: red"> (Kosongkan Jika Tidak Ada)</span></label>
                                            <input
                                                type="text"
                                                id="txtNoBuktiSoal"
                                                class="form-control"
                                                name="txtNoBuktiSoal"
                                                placeholder="Nomor Bukti"
                                            />
                                            <div class="invalid-feedback" id="txtNoBuktiSoal"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtMataAnggaranSoal">Mata Anggaran<span style="color: red">*</span></label>
                                            <input
                                                type="text"
                                                id="txtMataAnggaranSoal"
                                                class="form-control"
                                                name="txtMataAnggaranSoal"
                                                placeholder="Mata Anggaran"
                                            />
                                            <div class="invalid-feedback" id="txtMataAnggaranSoal"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtSkRektorSoal">Nomor SK. Rektor<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtSkRektorSoal"
                                                class="form-control"
                                                name="txtSkRektorSoal"
                                                placeholder="Nomor SK. Rektor"
                                            />
                                            <div class="invalid-feedback" id="txtSkRektorSoal"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtTanggalSKSoal">Tanggal SK<span style="color: red"> *</span></label>
                                            <input type="text" id="txtTanggalSKSoal" class="form-control flatpickr-basic" placeholder="DD-MM-YYYY" name="txtTanggalSKSoal" />
                                            <div class="invalid-feedback" id="txtTanggalSKSoal"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary mr-1" id="btnName">Cetak</button>
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
        </form>
        </div>
    </div>
</div>