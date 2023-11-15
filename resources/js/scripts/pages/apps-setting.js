let save_method, table, url, word, type
let statusObj = {
    '1': { title: 'Aktif', class: 'badge-light-success', action:'Non Aktifkan', icons: feather.icons['x'].toSvg(), class_btn :'btn-flat-danger' },
    '0': { title: 'Tidak Aktif', class: 'badge-light-danger', action:'Aktifkan',icons: feather.icons['check'].toSvg(), class_btn :'btn-flat-success' }
};

let koreksi = $('#txtHonorKoreksiSoal');
let pengawas = $('#txtHonorPengawas');
let pembuat = $('#txtHonorPembuatSoal');
let pph21 = $('#txtPajakPasal21');


$(function () {
    'use strict';

    if(koreksi.length) {
        new Cleave(koreksi, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
    }

    if(pengawas.length) {
        new Cleave(pengawas, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
    }

    if(pembuat.length) {
        new Cleave(pembuat, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
    }

    if(pph21.length) {
        new Cleave(pph21, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
    }
    

})


function add() {
    $('.invalid-feedback').hide()
    save_method = "add";
    $('input[name=method]').val('POST');
    $('#formSetting')[0].reset();
    $('#modalLabel').text('Tambah Data Setting Vakasi');
    $('#btnName').text('Simpan');   
}