
@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Vakasi')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
  {{-- Page css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce">
  <div class="row match-height">
    <!-- Medal Card -->
    <div class="col-xl-4 col-md-6 col-12">
      <div class="card card-congratulation-medal">
        <div class="card-body">
          <h4>{{ config('custom.app_name') }}</h4>
          <h5>{{ config('custom.app_unor') }}</h5>
          <p class="card-text font-small-3" style="font-weight: 500">{{ config('custom.app_satker') }}</p>
          <img src="{{asset('images/logo/logo-uin.png')}}" alt="Logo UIN SUSKA Riau" style="width: 30%;"/>
        </div>
      </div>
    </div>
    <!--/ Medal Card -->

    <!-- Statistics Card -->
    <div class="col-xl-8 col-md-6 col-12">
      <div class="card card-statistics">
        <div class="card-header">
          <h4 class="card-title">Perangkat Administrasi</h4>
        </div>
        <div class="card-body statistics-body">
          <div class="row">
            @foreach ($perangkat as $item)
				<div class="col-xl-6 col-sm-12 col-12 mb-2 mb-xl-0" style="margin-bottom: 10px !important;">
					<div class="media">
					<div class="avatar bg-light-primary mr-2">
						<div class="avatar-content">
						<i data-feather="user" class="avatar-icon"></i>
						</div>
					</div>
					<div class="media-body my-auto">
						<h5 class="font-weight-bolder mb-0">{{ $item->nama_perangkat }}</h5>
						<p class="card-text font-small-3 mb-0">{{ $item->is_jabatan }}</p>
					</div>
					</div>
				</div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <!--/ Statistics Card -->
  </div>

  <!--Count Data 1 -->
  <!-- Line Chart Card -->
  <div class="row">
    <div class="col-lg-4 col-sm-6 col-12">
      <div class="card">
        <div class="card-header">
          <div>
            <h2 class="font-weight-bolder">{{ $count_user }} Orang</h2>
            <p class="card-text">Jumlah Pengguna</p>
          </div>
          <div class="avatar bg-light-primary p-50 m-0">
            <div class="avatar-content">
              <i data-feather="monitor" class="font-medium-5"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-12">
      <div class="card">
        <div class="card-header">
          <div>
            <h2 class="font-weight-bolder">
              @if ($getSemester)
                  {{ $getSemester->nm_semester }}
              @else
                  Data Belum Ada
              @endif
            </h2>
            <p class="card-text">Semester Aktif</p>
          </div>
          <div class="avatar bg-light-success p-50 m-0">
            <div class="avatar-content">
              <i data-feather="bookmark" class="font-medium-5"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-12">
      <div class="card">
        <div class="card-header">
          <div>
            <h2 class="font-weight-bolder">{{ $count_dosenlb }} Orang</h2>
            <p class="card-text">Jumlah Dosen Luar Biasa</p>
          </div>
          <div class="avatar bg-light-warning p-50 m-0">
            <div class="avatar-content">
              <i data-feather="users" class="font-medium-5"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Line Chart Card -->
  <! End Count Data 1 -->
</section>
<!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-script')
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/dashboard-ecommerce.js')) }}"></script>
@endsection
