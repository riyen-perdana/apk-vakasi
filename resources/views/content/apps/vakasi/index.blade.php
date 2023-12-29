@extends('layouts/contentLayoutMaster')

@section('title', 'Vakasi')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <link rel="stylesheet" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}">
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <p style="font-weight: 500">Halaman Manajemen Data Vakasi Dosen Luar Biasa {{ config('custom.app_satker')}}</a></p>
  </div>
</div>

<section id="addVakasi">
  <div class="row">
    <div class="col-12">
      <div class="card text-center mb-3">
        <div class="card-body">
          <p class="card-text"><strong>Pilih Semester Untuk Pengambilan Data iRaise.</strong></p>
            <div class="form-group">
              <select class="form-control mx-auto" id="basicSelect" style="max-width: 500px;">
                <option value="">Pilih Semester</option>
                @foreach ($semester as $item)
                    <option value="{{ $item->id_smt }}">{{ $item->nm_semester }} - [{{ $item->a_periode_aktif === '1' ? 'Aktif' : 'Tidak Aktif' }}]</option>
                @endforeach
              </select>
            </div>
            <button type="submit" class="btn btn-outline-primary" id="proses" onclick="proses()">
                <i data-feather="play" class="mr-25"></i>
                <span> Proses Data</span>
            </button>
            <div class="mt-2" id="progress" style="display: none;">
              <div class="demo-spacing-0">
                <div class="alert alert-danger" role="alert">
                  <div class="alert-body"><strong>Perhatian!</strong> Jangan Menutup Halaman Ini Atau Pindah Ke Halaman Lain Ketika Progres Sinkronisasi Data Berlangsung.</div>
                </div>
              </div><br>
              <div class="progress-wrapper">
                <div id="example-caption-1" style="margin-bottom: 5px;text-align:left !important;"></div>
                <div class="progress progress-bar-primary">
                  <div id="pgb" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" aria-describedby="example-caption-1"></div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="basic-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <table class="datatables-basic table">
          <thead>
            <tr>
              <th>No</th>
              <th>ID Semester</th>
              <th>Nama Semester</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</section>

@include('content.apps.vakasi.detail')

@endsection

@section('vendor-script')
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/apps-vakasi.js')) }}"></script>
@endsection
