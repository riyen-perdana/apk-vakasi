@extends('layouts/fullLayoutMaster')

@section('title', 'Halaman Login')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-v2">
  <div class="auth-inner row m-0">
      <!-- Left Text-->
      <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
          <img class="img-fluid" src="{{asset('images/pages/login-v2.svg')}}" alt="Login V2" />
        </div>
      </div>
      <!-- /Left Text-->
      <!-- Login-->
      <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
          <h2 class="card-title font-weight-bold mb-1" style="font-size: 20px !important;font-weight:500">{{ config('custom.app_name')}}</h2>
          <h3 class="card-title font-weight-bold mb-1" style="font-size: 16px !important;font-weight:500; margin-top:-10px">{{ config('custom.app_unor')}}</h3>
          <h3 class="card-title font-weight-bold mb-1" style="font-size: 16px !important;font-weight:500; margin-top:-10px">{{ config('custom.app_satker')}}</h3>
          <p class="card-text mb-2">Masukkan Nomor Induk Pegawai dan Kata Sandi</p>
          <form id="login-pengguna" class="auth-login-form mt-2" action={{ route('login') }} method="POST">
            @csrf
            <div class="form-group">
              <label class="form-label" for="login-nip">Nomor Induk Pegawai</label>
              <input class="form-control" id="login-nip" type="text" name="nip" aria-describedby="login-nip" autofocus="" tabindex="1" />
            </div>
            <div class="form-group">
              <div class="d-flex justify-content-between">
                <label for="login-password">Kata Sandi</label>
                <a href="{{url("auth/forgot-password-v2")}}">
                  <small>Lupa Kata Sandi ?</small>
                </a>
              </div>
              <div class="input-group input-group-merge form-password-toggle">
                <input class="form-control form-control-merge" id="login-password" type="password" name="password" placeholder="············" aria-describedby="login-password" tabindex="2" />
                <div class="input-group-append">
                  <span class="input-group-text cursor-pointer">
                    <i data-feather="eye"></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div div class="custom-control custom-checkbox">
                <input class="custom-control-input" id="remember-me" type="checkbox" tabindex="3" />
                <label class="custom-control-label" for="remember-me">Ingat Saya</label>
              </div>
            </div>
            <button id="btnSubmit" class="btn btn-primary btn-block" tabindex="4">Masuk</button>
          </form>
      </div>
    </div>
    <!-- /Login-->
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection

@section('page-script')
<script src="{{asset(mix('js/scripts/pages/page-auth-login.js'))}}"></script>
@endsection
