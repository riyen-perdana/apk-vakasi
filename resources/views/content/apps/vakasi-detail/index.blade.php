@extends('layouts/contentLayoutMaster')

@section('title', 'Vakasi Detail')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <p style="font-weight: 500">Halaman Manajemen Data Vakasi Detail Dosen Luar Biasa {{ config('custom.app_satker')}}</a></p>
  </div>
</div>

<section id="basic-tabs-components">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <h4 class="card-title">Vakasi Detail Dosen Luar Biasa Tahun 2023/2024 Ganjil</h4>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a
                  class="nav-link active"
                  id="amprahDosen-tab"
                  data-toggle="tab"
                  href="#amprahDosen"
                  aria-controls="amprah-dosen"
                  role="tab"
                  aria-selected="true"
                  ><i data-feather="archive"></i> Honor Mengajar Dosen</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  id="pembuatSoal-tab"
                  data-toggle="tab"
                  href="#pembuatSoal"
                  aria-controls="pembuat-soal"
                  role="tab"
                  aria-selected="false"
                  ><i data-feather="edit-2"></i> Honor Pembuat Soal</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  id="pengawas-tab"
                  data-toggle="tab"
                  href="#pengawas"
                  aria-controls="pengawas"
                  role="tab"
                  aria-selected="false"
                  ><i data-feather="watch"></i> Honor Pengawas Ujian</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  id="pemeriksaUjian-tab"
                  data-toggle="tab"
                  href="#pemeriksaUjian"
                  aria-controls="pemeriksa-ujian"
                  role="tab"
                  aria-selected="false"
                  ><i data-feather="check"></i> Honor Pemeriksa Ujian</a
                >
              </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="amprahDosen" aria-labelledby="amprahDosen-tab" role="tabpanel">
                  <div class="row" id="table-amprah">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-header">
                          <h4 class="card-title">Honor Mengajar Dosen</h4>
                        </div>
                        <div class="card-body">
                          {{-- <p class="card-text">
                            Add <code>.table-hover-animation</code> to enable a hover stat with animation on table rows within a
                            <code class="highlighter-rouge">&lt;tbody&gt;</code>.
                          </p> --}}
                        </div>
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">Nama/NIP</th>
                                <th rowspan="2">Gol</th>
                                <th rowspan="2">Nama Sesuai Rekening</th>
                                <th rowspan="2">No.Rekening</th>
                                <th rowspan="2">NPWP</th>
                                <th colspan="4" style="text-align: center">Jumlah Honor</th>
                                <th rowspan="2">PPH Pasal 21</th>
                                <th rowspan="2">Jumlah</th>
                              </tr>
                              <tr>
                                <th>Honor</th>
                                <th>SKS</th>
                                <th>TTM</th>
                                <th>Jumlah</th>
                            </tr>
                            </thead>
                            <tbody>
                              @php
                                  $i = 1;
                              @endphp
                              @foreach ($query_amprah as $item)
                              <tr>
                                  <td>{{ $i }}.</td>
                                  <td>
                                    @if ($item->glr_dpn === NULL)
                                        {{ $item->name}}. {{ $item->glr_blk }}
                                    @elseif ($item->glr_blk === NULL)
                                        {{ $item->glr_dpn }}. {{ $item->name }}
                                    @elseif ($item->glr_dpn !=NULL && $item->glr_blk !=NULL)
                                        {{ $item->glr_dpn}}. {{$item->name}}. {{ $item->glr_blk }}
                                    @else
                                        {{ $item->name }}
                                    @endif
                                  </td>
                                  <td>{{ $item->pangkat }}<br>{{ $item->jbtn_fungsional }}</td>
                                  <td>{{ $item->name_no_rek }}</td>
                                  <td>{{ $item->no_rek }}</td>
                                  <td>{{ $item->npwp }}</td>
                                  <td>{{ number_format($item->a_ajr,0,',','.') }}</td>
                                  <td>{{ $item->SKS }}</td>
                                  <td>15</td>
                                  <td>{{ number_format($item->TOT,0,',','.') }}</td>
                                  <td>{{ number_format($item->PPH,0,',','.') }}</td>
                                  <td>{{ number_format($item->JLM,0,',','.') }}</td>
                              </tr>
                              @php
                                  $i++;
                              @endphp
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                        <div class="d-flex flex-row-reverse bd-highlight">
                          <div class="p-2 bd-highlight" style="padding-right: 0px !important;">
                            <button
                              id="add"
                              data-toggle="modal"
                              data-target="#vakasi-detail"
                              type="button"
                              class="btn btn-primary" 
                              onclick="print_data(`{{$id}}`)">
                                <i data-feather="printer" class="mr-25"></i>
                                <span> Print Data Amprah Mengajar Dosen</span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="pembuatSoal" aria-labelledby="pembuatSoal-tab" role="tabpanel">
                    <div class="row" id="table-amprah">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h4 class="card-title">Honor Pembuat Soal</h4>
                          </div>
                          <div class="card-body">
                            {{-- <p class="card-text">
                              Add <code>.table-hover-animation</code> to enable a hover stat with animation on table rows within a
                              <code class="highlighter-rouge">&lt;tbody&gt;</code>.
                            </p> --}}
                          </div>
                          <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th rowspan="2">No.</th>
                                  <th rowspan="2">Nama/NIP</th>
                                  <th rowspan="2">Gol</th>
                                  <th rowspan="2">Nama Sesuai Rekening</th>
                                  <th rowspan="2">No.Rekening</th>
                                  <th rowspan="2">NPWP</th>
                                  <th rowspan="2">Naskah</th>
                                  <th colspan="2" style="text-align: center">Jumlah Honor</th>
                                  <th rowspan="2">PPH Pasal 21</th>
                                  <th rowspan="2">Jumlah</th>
                                </tr>
                                <tr>
                                  <th>Honor</th>
                                  <th>Jumlah Honor</th>
                              </tr>
                              </thead>
                              <tbody>
                                @php
                                    $i_soal = 1;
                                @endphp
                                @foreach ($query_buat_soal as $item_soal)
                                <tr>
                                    <td>{{ $i_soal }}.</td>
                                    <td>
                                      @if ($item_soal->glr_dpn === NULL)
                                          {{ $item_soal->name}}. {{ $item_soal->glr_blk }}
                                      @elseif ($item_soal->glr_blk === NULL)
                                          {{ $item_soal->glr_dpn }}. {{ $item_soal->name }}
                                      @elseif ($item_soal->glr_dpn !=NULL && $item_soal->glr_blk !=NULL)
                                          {{ $item_soal->glr_dpn}}. {{$item_soal->name}}. {{ $item_soal->glr_blk }}
                                      @else
                                          {{ $item_soal->name }}
                                      @endif
                                    </td>
                                    <td>{{ $item_soal->pangkat }}<br>{{ $item_soal->jbtn_fungsional }}</td>
                                    <td>{{ $item_soal->name_no_rek }}</td>
                                    <td>{{ $item_soal->no_rek }}</td>
                                    <td>{{ $item_soal->npwp }}</td>
                                    <td>{{ $item_soal->jlm_naskah }}</td>
                                    <td>{{ number_format($item_soal->a_soal,0,',','.') }}</td>
                                    <td>{{ number_format($item_soal->jlm_honor,0,',','.') }}</td>
                                    <td>{{ number_format($item_soal->PPH,0,',','.') }}</td>
                                    <td>{{ number_format($item_soal->JLM,0,',','.') }}</td>
                                </tr>
                                @php
                                    $i_soal++;
                                @endphp
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                          <div class="d-flex flex-row-reverse bd-highlight">
                            <div class="p-2 bd-highlight" style="padding-right: 0px !important;">
                              <button
                                id="add"
                                data-toggle="modal"
                                data-target="#pembuat-soal"
                                type="button"
                                class="btn btn-primary" 
                                onclick="print_data_pembuat_soal(`{{$id}}`)">
                                  <i data-feather="printer" class="mr-25"></i>
                                  <span> Print Data Pembuat Soal Ujian Akhir</span>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="tab-pane" id="pengawas" aria-labelledby="pengawas-tab" role="tabpanel">
                  <div class="row" id="table-mengawas">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-header">
                          <h4 class="card-title">Honor Pengawas Ujian</h4>
                        </div>
                        <div class="card-body">
                          {{-- <p class="card-text">
                            Add <code>.table-hover-animation</code> to enable a hover stat with animation on table rows within a
                            <code class="highlighter-rouge">&lt;tbody&gt;</code>.
                          </p> --}}
                        </div>
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">Nama/NIP</th>
                                <th rowspan="2">Gol</th>
                                <th rowspan="2">Nama Sesuai Rekening</th>
                                <th rowspan="2">No.Rekening</th>
                                <th rowspan="2">NPWP</th>
                                <th rowspan="2">Hari</th>
                                <th colspan="2" style="text-align: center">Jumlah Honor</th>
                                <th rowspan="2">PPH Pasal 21</th>
                                <th rowspan="2">Jumlah</th>
                              </tr>
                              <tr>
                                <th>Honor</th>
                                <th>Jumlah Honor</th>
                            </tr>
                            </thead>
                            <tbody>
                              @php
                                  $i_aws = 1;
                              @endphp
                              @foreach ($query_mengawas as $item_aws)
                              <tr>
                                  <td>{{ $i_aws }}.</td>
                                  <td>
                                    @if ($item_aws->glr_dpn === NULL)
                                        {{ $item_aws->name}}. {{ $item_aws->glr_blk }}
                                    @elseif ($item_aws->glr_blk === NULL)
                                        {{ $item_aws->glr_dpn }}. {{ $item_aws->name }}
                                    @elseif ($item_aws->glr_dpn !=NULL && $item_aws->glr_blk !=NULL)
                                        {{ $item_aws->glr_dpn}}. {{$item_aws->name}}. {{ $item_aws->glr_blk }}
                                    @else
                                        {{ $item_aws->name }}
                                    @endif
                                  </td>
                                  <td>{{ $item_aws->pangkat }}<br>{{ $item_aws->jbtn_fungsional }}</td>
                                  <td>{{ $item_aws->name_no_rek }}</td>
                                  <td>{{ $item_aws->no_rek }}</td>
                                  <td>{{ $item_aws->npwp }}</td>
                                  <td>{{ $item_aws->jlm_naskah }}</td>
                                  <td>{{ number_format($item_aws->a_aws,0,',','.') }}</td>
                                  <td>{{ number_format($item_aws->jlm_honor,0,',','.') }}</td>
                                  <td>{{ number_format($item_aws->PPH,0,',','.') }}</td>
                                  <td>{{ number_format($item_aws->JLM,0,',','.') }}</td>
                              </tr>
                              @php
                                  $i_aws++;
                              @endphp
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                        <div class="d-flex flex-row-reverse bd-highlight">
                          <div class="p-2 bd-highlight" style="padding-right: 0px !important;">
                            <button
                              id="add"
                              data-toggle="modal"
                              data-target="#pengawas-ujian"
                              type="button"
                              class="btn btn-primary" 
                              onclick="print_data_pengawas_ujian(`{{$id}}`)">
                                <i data-feather="printer" class="mr-25"></i>
                                <span> Print Data Honor Pengawas Ujian</span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="pemeriksaUjian" aria-labelledby="pemeriksaUjian-tab" role="tabpanel">
                  <div class="row" id="table-mengawas">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-header">
                          <h4 class="card-title">Honor Pemeriksa Ujian</h4>
                        </div>
                        <div class="card-body">
                          {{-- <p class="card-text">
                            Add <code>.table-hover-animation</code> to enable a hover stat with animation on table rows within a
                            <code class="highlighter-rouge">&lt;tbody&gt;</code>.
                          </p> --}}
                        </div>
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">Nama/NIP</th>
                                <th rowspan="2">Gol</th>
                                <th rowspan="2">Nama Sesuai Rekening</th>
                                <th rowspan="2">No.Rekening</th>
                                <th rowspan="2">NPWP</th>
                                <th rowspan="2">Mahasiswa</th>
                                <th colspan="2" style="text-align: center">Jumlah Honor</th>
                                <th rowspan="2">PPH Pasal 21</th>
                                <th rowspan="2">Jumlah</th>
                              </tr>
                              <tr>
                                <th>Honor</th>
                                <th>Jumlah Honor</th>
                            </tr>
                            </thead>
                            <tbody>
                              @php
                                  $i_krk = 1;
                              @endphp
                              @foreach ($query_pengoreksi as $item_krk)
                              <tr>
                                  <td>{{ $i_krk }}.</td>
                                  <td>
                                    @if ($item_krk->glr_dpn === NULL)
                                        {{ $item_krk->name}}. {{ $item_krk->glr_blk }}
                                    @elseif ($item_krk->glr_blk === NULL)
                                        {{ $item_krk->glr_dpn }}. {{ $item_krk->name }}
                                    @elseif ($item_krk->glr_dpn !=NULL && $item_krk->glr_blk !=NULL)
                                        {{ $item_krk->glr_dpn}}. {{$item_krk->name}}. {{ $item_krk->glr_blk }}
                                    @else
                                        {{ $item_krk->name }}
                                    @endif
                                  </td>
                                  <td>{{ $item_krk->pangkat }}<br>{{ $item_krk->jbtn_fungsional }}</td>
                                  <td>{{ $item_krk->name_no_rek }}</td>
                                  <td>{{ $item_krk->no_rek }}</td>
                                  <td>{{ $item_krk->npwp }}</td>
                                  <td>{{ $item_krk->jlm_mhs }}</td>
                                  <td>{{ number_format($item_krk->a_krk,0,',','.') }}</td>
                                  <td>{{ number_format($item_krk->jlm_honor,0,',','.') }}</td>
                                  <td>{{ number_format($item_krk->PPH,0,',','.') }}</td>
                                  <td>{{ number_format($item_krk->JLM,0,',','.') }}</td>
                              </tr>
                              @php
                                  $i_krk++;
                              @endphp
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                        <div class="d-flex flex-row-reverse bd-highlight">
                          <div class="p-2 bd-highlight" style="padding-right: 0px !important;">
                            <button
                              id="add"
                              data-toggle="modal"
                              data-target="#pemeriksa-ujian"
                              type="button"
                              class="btn btn-primary" 
                              onclick="print_data_pemeriksa_ujian(`{{$id}}`)">
                                <i data-feather="printer" class="mr-25"></i>
                                <span> Print Data Honor Pemeriksa Ujian</span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</section>
@include('content.apps.vakasi-detail.modal-form')
@include('content.apps.vakasi-detail.modal-form-ps')
@include('content.apps.vakasi-detail.modal-form-pu')
@include('content.apps.vakasi-detail.modal-form-ku')
@endsection

@section('vendor-script')
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/apps-vakasi-detail.js')) }}"></script>
@endsection