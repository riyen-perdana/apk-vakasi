<div
    class="modal fade text-left"
    id="setting"
    tabindex="-1"
    role="dialog"
    aria-labelledby="role"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered modal-lg" id="modal-form" role="dialog" data-backdrop="static">
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
                            <form class="form form-vertical" method="POST" id="formSetting">
                                @csrf
                                <input type="hidden" id="id" name="id">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtHonorKoreksiSoal">Honor Pengoreksi Soal<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtHonorKoreksiSoal"
                                                class="form-control"
                                                name="txtHonorKoreksiSoal"
                                                placeholder="Honor Pengoreksi Soal"
                                                autofocus
                                            />
                                            <div class="invalid-feedback" id="txtHonorKoreksiSoal"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtHonorPengawas">Honor Pengawas<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtHonorPengawas"
                                                class="form-control"
                                                name="txtHonorPengawas"
                                                placeholder="Honor Pengawas"
                                                
                                            />
                                            <div class="invalid-feedback" id="txtHonorPengawas"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtHonorPembuatSoal">Honor Pembuat Soal<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtHonorPembuatSoal"
                                                class="form-control"
                                                name="txtHonorPembuatSoal"
                                                placeholder="Honor Pembuat Soal"
                                                
                                            />
                                            <div class="invalid-feedback" id="txtHonorPembuatSoal"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtPajakPasal21">PPH Pasal 21<span style="color: red"> * ditulis dengan tidak menyertakan tanda persen</span></label>
                                            <input
                                                type="text"
                                                id="txtPajakPasal21"
                                                class="form-control"
                                                name="txtPajakPasal21"
                                                placeholder="PPJ Pasal 21"
                                                
                                            />
                                            <div class="invalid-feedback" id="txtPajakPasal21"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtPajakPasal21">Status<span style="color: red"> *</span></label>
                                            <select class="form-control" id="optStatus" name="optStatus">
                                                <option value="">Pilih Status</option>
                                                <option value="Y">Aktif</option>
                                                <option value="N">Tidak Aktif</option>
                                              </select>
                                            <div class="invalid-feedback" id="txtPajakPasal21"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary mr-1" id="btnName"></button>
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
        </form>
        </div>
    </div>
</div>