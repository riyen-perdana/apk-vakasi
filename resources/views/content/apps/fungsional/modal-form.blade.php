<div
    class="modal fade text-left"
    id="fungsional"
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
                            <form class="form form-vertical" method="POST" id="formFungsional">
                                @csrf
                                <input type="hidden" id="id" name="id">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtFungsional">Jabatan Fungsional<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtFungsional"
                                                class="form-control"
                                                name="txtFungsional"
                                                placeholder="Jabatan Fungsional"
                                                autofocus
                                            />
                                            <div class="invalid-feedback" id="txtFungsional"></div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="txtAmprahMengajar">Besaran Amprah Mengajar<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtAmprahMengajar"
                                                class="form-control"
                                                name="txtAmprahMengajar"
                                                placeholder="Besaran Amprah Mengajar"
                                                autofocus
                                            />
                                            <div class="invalid-feedback" id="txtAmprahMengajar"></div>
                                        </div>
                                    </div> --}}
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