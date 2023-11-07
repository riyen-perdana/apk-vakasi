<div
    class="modal fade text-left"
    id="pengguna"
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
                            <form class="form form-vertical" method="POST" id="formPengguna">
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
                                            <label for="txtNama">Nama Pegawai<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtNama"
                                                class="form-control"
                                                name="txtNama"
                                                placeholder="Nama Pegawai"
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
                                            <label for="password">Kata Sandi<span style="color: red"> *</span></label>
                                            <input
                                                type="password"
                                                id="password"
                                                class="form-control"
                                                name="password"
                                                placeholder="Kata Sandi"
                                                onpaste="return false"
                                            />
                                            <div class="invalid-feedback" id="password"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password_confirmation">Ulangi Kata Sandi<span style="color: red"> *</span></label>
                                            <input
                                                type="password"
                                                id="password_confirmation"
                                                class="form-control"
                                                name="password_confirmation"
                                                placeholder="Ulangi Kata Sandi"
                                                onpaste="return false"
                                            />
                                            <div class="invalid-feedback" id="password_confirmation"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="txtEmail">Email<span style="color: red"> *</span></label>
                                            <input
                                                type="text"
                                                id="txtEmail"
                                                class="form-control"
                                                name="txtEmail"
                                                placeholder="Email"
                                            />
                                            <div class="invalid-feedback" id="txtEmail"></div>
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
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="optRole">Role<span style="color: red"> *</span></label>
                                            <select class="form-control" id="optRole" name="optRole">
                                                <option value="">Pilih Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                              </select>
                                            <div class="invalid-feedback" id="optRole"></div>
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