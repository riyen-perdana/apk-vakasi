@php
$configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Error 405')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-misc.css')) }}">
@endsection
@section('content')
<!-- Error page-->
<div class="misc-wrapper">
  <div class="misc-inner p-2 p-sm-3">
    <div class="w-100 text-center">
      <h2 class="mb-1">Kesalahan Penggunaan Aplikasi</h2>
      <p class="mb-2">Fungsi Tidak Diperbolehkan</p>
      <a class="btn btn-primary mb-2 btn-sm-block" href="{{url('/')}}">Kembali</a>

      @if($configData['theme'] === 'dark')
      <img class="img-fluid" src="{{asset('images/pages/error-dark.svg')}}" alt="Error page" />
      @else
      <img class="img-fluid" src="{{asset('images/pages/error.svg')}}" alt="Error page" />
      @endif
    </div>
  </div>
</div>
<!-- / Error page-->
@endsection
