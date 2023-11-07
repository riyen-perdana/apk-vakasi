<div
    class="modal fade text-left"
    id="role"
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
                            <form class="form form-vertical" method="POST" id="formRole">
                                @csrf
                                <input type="hidden" id="id" name="id">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <input
                                                type="text"
                                                id="txtRole"
                                                class="form-control"
                                                name="txtRole"
                                                placeholder="Masukkan Role Pengguna"
                                            />
                                            <div class="invalid-feedback" id="txtRole"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="permission">Permission</label>
                                            <div class="demo-inline-spacing"">
                                                @foreach ($permissions as $permission)
                                                    <div class="custom-control custom-checkbox" id="cbPermissions">
                                                        <input type="checkbox" class="custom-control-input checkPermissions" id="checkPermissions[{{ $permission['id'] }}]" name="checkPermissions[]" value="{{ $permission['id']}}"/>
                                                        <label class="custom-control-label" for="checkPermissions[{{ $permission['id'] }}]">{{ $permission['name'] }}</label>
                                                    </div>
                                                @endforeach
                                                {{-- <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                                <label for="vehicle1"> I have a bike</label><br> --}}
                                            </div>
                                            <div class="invalid-feedback" id="checkPermissions"></div>
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