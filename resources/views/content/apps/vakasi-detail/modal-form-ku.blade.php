<div
    class="modal fade text-left"
    id="pemeriksa-ujian"
    tabindex="-1"
    role="dialog"
    aria-labelledby="role"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered" id="modal-form" role="dialog" data-backdrop="static">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="modalLabelPengawasUjian">Print Data Honor Pemeriksa Ujian</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <section id="basic-vertical-layouts">
                    <div class="row">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" id="formPemeriksaUjianPrint">
                                @csrf
                                <input type="hidden" id="id_ku" name="id_ku">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtTAPemeriksa">Tahun Anggaran<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtTAPemeriksa"
                                                class="form-control"
                                                name="txtTAPemeriksa"
                                                placeholder="Tahun Anggaran"
                                            />
                                            <div class="invalid-feedback" id="txtTAPemeriksa"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtNoBuktiPemeriksa">Nomor Bukti<span style="color: red"> (Kosongkan Jika Tidak Ada)</span></label>
                                            <input
                                                type="text"
                                                id="txtNoBuktiPemeriksa"
                                                class="form-control"
                                                name="txtNoBuktiPemeriksa"
                                                placeholder="Nomor Bukti"
                                            />
                                            <div class="invalid-feedback" id="txtNoBuktiPemeriksa"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtMataAnggaranPemeriksa">Mata Anggaran<span style="color: red">*</span></label>
                                            <input
                                                type="text"
                                                id="txtMataAnggaranPemeriksa"
                                                class="form-control"
                                                name="txtMataAnggaranPemeriksa"
                                                placeholder="Mata Anggaran"
                                            />
                                            <div class="invalid-feedback" id="txtMataAnggaranPemeriksa"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtSkRektorPemeriksa">Nomor SK. Rektor<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtSkRektorPemeriksa"
                                                class="form-control"
                                                name="txtSkRektorPemeriksa"
                                                placeholder="Nomor SK. Rektor"
                                            />
                                            <div class="invalid-feedback" id="txtSkRektorPemeriksa"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtTanggalSKPemeriksa">Tanggal SK<span style="color: red"> *</span></label>
                                            <input type="text" id="txtTanggalSKPemeriksa" class="form-control flatpickr-basic" placeholder="DD-MM-YYYY" name="txtTanggalSKPemeriksa" />
                                            <div class="invalid-feedback" id="txtTanggalSKPemeriksa"></div>
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