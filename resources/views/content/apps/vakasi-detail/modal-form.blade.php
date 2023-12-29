<div
    class="modal fade text-left"
    id="vakasi-detail"
    tabindex="-1"
    role="dialog"
    aria-labelledby="role"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered" id="modal-form" role="dialog" data-backdrop="static">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="modalLabel"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <section id="basic-vertical-layouts">
                    <div class="row">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" id="formAmprahPrint">
                                @csrf
                                <input type="hidden" id="id" name="id">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtTA">Tahun Anggaran<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtTA"
                                                class="form-control"
                                                name="txtTA"
                                                placeholder="Tahun Anggaran"
                                            />
                                            <div class="invalid-feedback" id="txtTA"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtNoBukti">Nomor Bukti<span style="color: red"> (Kosongkan Jika Tidak Ada)</span></label>
                                            <input
                                                type="text"
                                                id="txtNoBukti"
                                                class="form-control"
                                                name="txtNoBukti"
                                                placeholder="Nomor Bukti"
                                            />
                                            <div class="invalid-feedback" id="txtNoBukti"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtMataAnggaran">Mata Anggaran<span style="color: red">*</span></label>
                                            <input
                                                type="text"
                                                id="txtMataAnggaran"
                                                class="form-control"
                                                name="txtMataAnggaran"
                                                placeholder="Mata Anggaran"
                                            />
                                            <div class="invalid-feedback" id="txtMataAnggaran"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtSkRektor">Nomor SK. Rektor<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtSkRektor"
                                                class="form-control"
                                                name="txtSkRektor"
                                                placeholder="Nomor SK. Rektor"
                                            />
                                            <div class="invalid-feedback" id="txtSkRektor"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtTanggalSK">Tanggal SK<span style="color: red"> *</span></label>
                                            <input type="text" id="txtTanggalSK" class="form-control flatpickr-basic" placeholder="DD-MM-YYYY" name="txtTanggalSK" />
                                            <div class="invalid-feedback" id="txtTanggalSK"></div>
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