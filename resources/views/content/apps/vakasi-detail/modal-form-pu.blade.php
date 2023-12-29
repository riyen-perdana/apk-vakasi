<div
    class="modal fade text-left"
    id="pengawas-ujian"
    tabindex="-1"
    role="dialog"
    aria-labelledby="role"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered" id="modal-form" role="dialog" data-backdrop="static">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="modalLabelPengawasUjian">Print Data Honor Pengawas Ujian</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <section id="basic-vertical-layouts">
                    <div class="row">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" id="formPengawasUjianPrint">
                                @csrf
                                <input type="hidden" id="id_pu" name="id_pu">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtTAPengawas">Tahun Anggaran<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtTAPengawas"
                                                class="form-control"
                                                name="txtTAPengawas"
                                                placeholder="Tahun Anggaran"
                                            />
                                            <div class="invalid-feedback" id="txtTAPengawas"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtNoBuktiPengawas">Nomor Bukti<span style="color: red"> (Kosongkan Jika Tidak Ada)</span></label>
                                            <input
                                                type="text"
                                                id="txtNoBuktiPengawas"
                                                class="form-control"
                                                name="txtNoBuktiPengawas"
                                                placeholder="Nomor Bukti"
                                            />
                                            <div class="invalid-feedback" id="txtNoBuktiPengawas"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtMataAnggaranPengawas">Mata Anggaran<span style="color: red">*</span></label>
                                            <input
                                                type="text"
                                                id="txtMataAnggaranPengawas"
                                                class="form-control"
                                                name="txtMataAnggaranPengawas"
                                                placeholder="Mata Anggaran"
                                            />
                                            <div class="invalid-feedback" id="txtMataAnggaranPengawas"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtSkRektorPengawas">Nomor SK. Rektor<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtSkRektorPengawas"
                                                class="form-control"
                                                name="txtSkRektorPengawas"
                                                placeholder="Nomor SK. Rektor"
                                            />
                                            <div class="invalid-feedback" id="txtSkRektorPengawas"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtTanggalSKPengawas">Tanggal SK<span style="color: red"> *</span></label>
                                            <input type="text" id="txtTanggalSKPengawas" class="form-control flatpickr-basic" placeholder="DD-MM-YYYY" name="txtTanggalSKPengawas" />
                                            <div class="invalid-feedback" id="txtTanggalSKPengawas"></div>
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