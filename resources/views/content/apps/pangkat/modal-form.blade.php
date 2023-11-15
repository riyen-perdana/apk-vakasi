<div
    class="modal fade text-left"
    id="pangkat"
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
                            <form class="form form-vertical" method="POST" id="formPangkat">
                                @csrf
                                <input type="hidden" id="id" name="id">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="txtPangkat">Pangkat<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtPangkat"
                                                class="form-control"
                                                name="txtPangkat"
                                                placeholder="Pangkat"
                                                autofocus
                                            />
                                            <div class="invalid-feedback" id="txtPangkat"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="txtGolongan">Golongan<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtGolongan"
                                                class="form-control"
                                                name="txtGolongan"
                                                placeholder="Golongan"
                                            />
                                            <div class="invalid-feedback" id="txtGolongan"></div>
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