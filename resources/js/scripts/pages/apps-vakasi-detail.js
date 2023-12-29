let tgl_sk = $('#txtTanggalSK');
let tgl_sk_soal = $('#txtTanggalSKSoal');
let tgl_sk_mengawas = $('#txtTanggalSKPengawas');
let tgl_sk_periksa = $('#txtTanggalSKPemeriksa');

if (tgl_sk.length) {
    tgl_sk.flatpickr();
}

if (tgl_sk_soal.length) {
    tgl_sk_soal.flatpickr();
}

if (tgl_sk_mengawas.length) {
    tgl_sk_mengawas.flatpickr();
}

if (tgl_sk_periksa.length) {
    tgl_sk_periksa.flatpickr();
}

async function print_data(id) {
    $('.invalid-feedback').hide()
    $('#modalLabel').text('Print Data Honor Mengajar');
    $('#formAmprahPrint')[0].reset();
    $('#id').val(id);
}

async function print_data_pembuat_soal(id) {
    $('.invalid-feedback').hide()
    $('#formPembuatSoalPrint')[0].reset();
    $('#id_ps').val(id);
}

async function print_data_pengawas_ujian(id) {
    $('.invalid-feedback').hide()
    $('#formPengawasUjianPrint')[0].reset();
    $('#id_pu').val(id);
}

async function print_data_pemeriksa_ujian(id) {
    $('.invalid-feedback').hide()
    $('#formPemeriksaUjianPrint')[0].reset();
    $('#id_ku').val(id);
}

$(function () {
    'use strict';

    //Print Data Amprah
    $('#formAmprahPrint').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url  : 'vakasi-amprah-print',
            type : 'POST',
            data :$('#formAmprahPrint').serialize(),
            headers  : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success : function() {
                $('#vakasi-detail').modal('hide');
                window.location.href = '../../download-amprah';
            },
            error : function(data) {
                $('.invalid-feedback').text('')
                $('.invalid-feedback').hide();
                $.each(data.responseJSON,function (key, value) {
                    let input = '#formAmprahPrint div[id='+key+']';
                    $(input).text(value);
                    $('.invalid-feedback').show()
                });
            }
        })
    });

    
    //Print Data Honor Pembuat Soal
    $('#formPembuatSoalPrint').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url  : 'vakasi-soal-print',
            type : 'POST',
            data :$('#formPembuatSoalPrint').serialize(),
            headers  : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success : function() {
                $('#pembuat-soal').modal('hide');
                window.location.href = '../../download-amprah-soal';
            },
            error : function(data) {
                $('.invalid-feedback').text('')
                $('.invalid-feedback').hide();
                $.each(data.responseJSON,function (key, value) {
                    let input = '#formPembuatSoalPrint div[id='+key+']';
                    $(input).text(value);
                    $('.invalid-feedback').show()
                });
            }
        })
    });

    //Print Data Honor Pembuat Soal
    $('#formPengawasUjianPrint').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url  : 'vakasi-pengawas-ujian',
            type : 'POST',
            data : $('#formPengawasUjianPrint').serialize(),
            headers  : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success : function() {
                $('#pengawas-ujian').modal('hide');
                window.location.href = '../../download-amprah-pengawas';
            },
            error : function(data) {
                $('.invalid-feedback').text('')
                $('.invalid-feedback').hide();
                $.each(data.responseJSON,function (key, value) {
                    let input = '#formPengawasUjianPrint div[id='+key+']';
                    $(input).text(value);
                    $('.invalid-feedback').show()
                });
            }
        })
    });

    //Print Data Honor Pembuat Soal
    $('#formPemeriksaUjianPrint').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url  : 'vakasi-pengoreksi-ujian',
            type : 'POST',
            data : $('#formPemeriksaUjianPrint').serialize(),
            headers  : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success : function() {
                $('#pemeriksa-ujian').modal('hide');
                window.location.href = '../../download-amprah-koreksi';
            },
            error : function(data) {
                $('.invalid-feedback').text('')
                $('.invalid-feedback').hide();
                $.each(data.responseJSON,function (key, value) {
                    let input = '#formPemeriksaUjianPrint div[id='+key+']';
                    $(input).text(value);
                    $('.invalid-feedback').show()
                });
            }
        })
    });
    
})