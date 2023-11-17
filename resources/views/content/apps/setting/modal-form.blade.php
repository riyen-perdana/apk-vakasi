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
                                            <label for="optFungsional">Jabatan Fungsional<span style="color: red"> *</span></label>
                                            <select class="form-control" id="optFungsional" name="optFungsional">
                                                <option value="">Pilih Status</option>
                                                    @foreach ($fungsional as $item)
                                                        <option value="{{$item->id}}">{{ $item->jbtn_fungsional }}</option>
                                                    @endforeach
                                              </select>
                                            <div class="invalid-feedback" id="optFungsional"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txt_a_ajr">Honorarium Mengajar<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txt_a_ajr"
                                                class="form-control"
                                                name="txt_a_ajr"
                                                placeholder="Honorarium Mengajar"
                                                autofocus
                                            />
                                            <div class="invalid-feedback" id="txt_a_ajr"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txt_a_soal">Honorarium Membuat Soal<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txt_a_soal"
                                                class="form-control"
                                                name="txt_a_soal"
                                                placeholder="Honorarium Membuat Soal"
                                                
                                            />
                                            <div class="invalid-feedback" id="txt_a_soal"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txt_a_aws">Honorarium Pengawas<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txt_a_aws"
                                                class="form-control"
                                                name="txt_a_aws"
                                                placeholder="Honorarium Pengawas"
                                                
                                            />
                                            <div class="invalid-feedback" id="txt_a_aws"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txt_a_krk">Honorarium Pengoreksi Soal<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txt_a_krk"
                                                class="form-control"
                                                name="txt_a_krk"
                                                placeholder="Honorarium Pengoreksi Soal"
                                                
                                            />
                                            <div class="invalid-feedback" id="txt_a_krk"></div>
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