<div
    class="modal fade text-left"
    id="dosen"
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
                            <form class="form form-vertical" method="POST" id="formDosen">
                                @csrf
                                <input type="hidden" id="id" name="id">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="txtNUPNIDN">NUP/NIDN<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtNUPNIDN"
                                                class="form-control"
                                                name="txtNUPNIDN"
                                                placeholder="NUP/NIDN"
                                            />
                                            <div class="invalid-feedback" id="txtNUPNIDN"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="txtNamaDsnLb">Nama Dosen Luar Biasa<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtNamaDsnLb"
                                                class="form-control"
                                                name="txtNamaDsnLb"
                                                placeholder="Nama Dosen Luar Biasa"
                                            />
                                            <div class="invalid-feedback" id="txtNamaDsnLb"></div>
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
                                            <label for="txtNPWP">Nomor Pokok Wajib Pajak<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtNPWP"
                                                class="form-control custom-delimiter-mask"
                                                name="txtNPWP"
                                                placeholder="75.379.040.1-221.000"
                                            />
                                            <div class="invalid-feedback" id="txtNPWP"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="txtNoRek">Nomor Rekening Bank<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtNoRek"
                                                class="form-control"
                                                name="txtNoRek"
                                                placeholder="Nomor Rekening Bank"
                                            />
                                            <div class="invalid-feedback" id="txtNoRek"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="txtNamaNoRek">Nama Sesuai Nomor Rekening<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtNamaNoRek"
                                                class="form-control"
                                                name="txtNamaNoRek"
                                                placeholder="Nama Sesuai Nomor Rekening"
                                            />
                                            <div class="invalid-feedback" id="txtNamaNoRek"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="optPangkat">Pangkat dan Golongan<span style="color: red"> *</span></label>
                                            <select class="form-control" id="optPangkat" name="optPangkat">
                                                <option value="">Pilih Pangkat dan Golongan</option>
                                                    @foreach ($pangkat as $item)
                                                        <option value="{{$item->id}}">{{$item->pangkat}} - {{$item->golongan}}</option>
                                                    @endforeach
                                              </select>
                                            <div class="invalid-feedback" id="optPangkat"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="optJafung">Jabatan Fungsional<span style="color: red"> *</span></label>
                                            <select class="form-control" id="optJafung" name="optJafung">
                                                <option value="">Pilih Jabatan Fungsional</option>
                                                    @foreach ($fungsional as $item)
                                                        <option value="{{$item->id}}">{{$item->jbtn_fungsional}}</option>
                                                    @endforeach
                                              </select>
                                            <div class="invalid-feedback" id="optJafung"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="optStatus">Status<span style="color: red"> *</span></label>
                                            <select class="form-control" id="optStatus" name="optStatus">
                                                <option value="">Pilih Status</option>
                                                <option value="Y">Aktif</option>
                                                <option value="N">Tidak Aktif</option>
                                              </select>
                                            <div class="invalid-feedback" id="optStatus"></div>
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