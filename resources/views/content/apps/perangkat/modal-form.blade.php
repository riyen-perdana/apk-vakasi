<div
    class="modal fade text-left"
    id="perangkat"
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
                            <form class="form form-vertical" method="POST" id="formPerangkat">
                                @csrf
                                <input type="hidden" id="id" name="id">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="txtNIP">Nomor Induk Pegawai<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtNIP"
                                                class="form-control"
                                                name="txtNIP"
                                                placeholder="Nomor Induk Pegawai"
                                            />
                                            <div class="invalid-feedback" id="txtNIP"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="txtNama">Nama Perangkat<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtNama"
                                                class="form-control"
                                                name="txtNama"
                                                placeholder="Nama Perangkat"
                                            />
                                            <div class="invalid-feedback" id="txtNama"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="txtGlrDpn">Gelar Depan<span style="color: red"> (Kosongkan Jika Tidak Ada)</span></label>
                                            <input
                                                type="text"
                                                id="txtGlrDpn"
                                                class="form-control"
                                                name="txtGlrDpn"
                                                placeholder="Gelar Depan"
                                            />
                                            <div class="invalid-feedback" id="txtGlrDpn"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="txtGlrBlk">Gelar Belakang<span style="color: red"> (Kosongkan Jika Tidak Ada)</span></label>
                                            <input
                                                type="text"
                                                id="txtGlrBlk"
                                                class="form-control"
                                                name="txtGlrBlk"
                                                placeholder="Gelar Belakang"
                                            />
                                            <div class="invalid-feedback" id="txtGlrBlk"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="optJabatan">Jabatan<span style="color: red"> *</span></label>
                                            <select class="form-control" id="optJabatan" name="optJabatan">
                                                <option value="">Pilih Jabatan</option>
                                                @foreach ($jabatan as $item)
                                                    <option value="{{ $item->name }}">{{ str_replace("_"," ",$item->name) }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback" id="optJabatan"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="optStatus">Status Aktif<span style="color: red"> *</span></label>
                                            <select class="form-control" id="optStatus" name="optStatus">
                                                <option value="">Pilih Status</option>
                                                <option value="Y">Aktif</option>
                                                <option value="N">Tidak Aktif</option>
                                            </select>
                                            <div class="invalid-feedback" id="optStatus"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="optPlt">Status Plt<span style="color: red"> *</span></label>
                                            <select class="form-control" id="optPlt" name="optPlt">
                                                <option value="">Pilih Status</option>
                                                <option value="Y">Aktif</option>
                                                <option value="N">Tidak Aktif</option>
                                            </select>
                                            <div class="invalid-feedback" id="optPlt"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="txtAwalJabatan">Awal Jabatan<span style="color: red"> *</span></label>
                                            <input type="text" id="awljbtn" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" name="txtAwalJabatan" />
                                            <div class="invalid-feedback" id="txtAwalJabatan"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="txtAkhirJabatan">Akhir Jabatan<span style="color: red"> *</span></label>
                                            <input type="text" id="akhjbtn" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" name="txtAkhirJabatan" />
                                            <div class="invalid-feedback" id="txtAkhirJabatan"></div>
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