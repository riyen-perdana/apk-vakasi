let save_method, table, url, word, type;
let awal_jbtn = $('#awljbtn');
let akhr_jbtn = $('#akhjbtn');

let statusObj = {
    'Y': { title: 'Aktif', class: 'badge-light-success' },
    'N': { title: 'Tidak Aktif', class: 'badge-light-danger' }
};

let pltObj = {
    'Y': { title: 'PLT', class: 'badge-light-success' },
    'N': { title: 'Bukan PLT', class: 'badge-light-danger' }
};

if (awal_jbtn.length) {
    awal_jbtn.flatpickr();
}

if (akhr_jbtn.length) {
    akhr_jbtn.flatpickr();
}

$(function () {
    'use strict';

    //Save Data Perangkat
    $('#formPerangkat').on('submit', function(e) {
        e.preventDefault();
        let id = $('#id').val();

        if (save_method == "add") {
            url     = "perangkat";
            type    = "POST";
            word    = "Ditambahkan";
        }
        else {
            url     = "perangkat/"+id;
            type    = "PATCH";
            word    = "Diubah";
        }

        $.ajax({
            url  : url,
            type : type,
            data :$('#formPerangkat').serialize(),
            success : function() {
                toastr['success'](
                    'Data Perangkat Berhasil '+word+' !!',
                    'Sukses',
                    {
                      closeButton: true,
                      tapToDismiss: false
                    }
                  );
                table.ajax.reload()
                $('#perangkat').modal('hide');
            },
            error : function(data) {
                $('.invalid-feedback').text('')
                $('.invalid-feedback').hide();
                $.each(data.responseJSON,function (key, value) {
                    let input = '#formPerangkat div[id='+key+']';
                    $(input).text(value);
                    $('.invalid-feedback').show()
                });
            }
        })
    });

    //DataTable
    let dt_basic_table = $('.datatables-basic');

    // DataTable with buttons
    // --------------------------------------------------------------------
  
    dt_basic_table.dataTable().fnDestroy();
    table = dt_basic_table.DataTable({
        ajax: 'perangkat-data',
        //scrollX: true,
        columns : [
            { data : 'id', name:'id', orderable: false, searchable: false, width:'5%' },
            { data : 'nip', width:'10%'},
            { data : 'nama_perangkat',width:'20%',
                render: function ( data, type, row ) {
                    return row.nama_perangkat+'<br><strong>'+row.is_jabatan+'</strong>';
                }
            },
            { data : 'awal_jabatan',width:'10%'},
            { data : 'akhir_jabatan', width:'10%'},
            { data : 'is_plt', width:'10%'},
            { data : 'is_aktif', width:'10%'},
            { data : '', width:'15%'}
        ],
        columnDefs: [
            {
                targets:5,
                render: function (data,type,full,meta) {
                    let $status = full['is_plt'];
                    return (
                        '<span class="badge badge-pill ' +
                        pltObj[$status].class +
                        '" text-capitalized>' +
                        pltObj[$status].title +
                        '</span>'
                      );
                }
            },
            {
                targets:6,
                render: function (data,type,full,meta) {
                    let $status = full['is_aktif'];
                    return (
                        '<span class="badge badge-pill ' +
                        statusObj[$status].class +
                        '" text-capitalized>' +
                        statusObj[$status].title +
                        '</span>'
                      );
                }
            },
            {
                // Actions
                targets: -1,
                orderable: false,
                render: function (data, type, full, meta) {
                    let $id = full['id'];
                    return (
                        '<div class="demo-inline-spacing">'+
                            '<button type="button" data-toggle="modal" data-target="#modals-slide-in" style="margin-top:0 !important;" class="btn btn-sm btn-icon btn-danger" onClick="viewData(\''+$id+'\')">'+
                                feather.icons['info'].toSvg() +
                            '</button>'+
                            '<button type="button" style="margin-top:0 !important;" data-toggle="modal" data-target="#perangkat" class="btn btn-sm btn-icon btn-warning" onClick="editData(\''+$id+'\')">'+
                                feather.icons['edit-3'].toSvg() +
                            '</button>'+
                            '<button type="button" style="margin-top:0 !important;" class="btn btn-sm btn-icon btn-danger" onClick="deleteData(\''+$id+'\')">'+
                                feather.icons['trash-2'].toSvg() +
                            '</button>'+
                        '</div>'                    
                    );
                }
            }
        ],
        dom:
        '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        displayLength: 10,
        lengthMenu: [10, 25, 50, 75, 100],
    });

    table.on('order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1+'.';
        });
    }).draw();
})


function add() {
    $('.invalid-feedback').hide()
    save_method = "add";
    $('input[name=method]').val('POST');
    $('#formPerangkat')[0].reset();
    $('#modalLabel').text('Tambah Data Perangkat');
    $('#btnName').text('Simpan');
}

async function viewData(id)
{
    console.log(id);
    $('#viewModalLabel').text('Detail Data Perangkat');
    $.ajax ({
        url         : "perangkat/"+id,
        type        : "GET",
        dataType    : "JSON",
        success     : function(data) {
            $('#txtNIPView').text(data.nip);
            $('#txtNamaPerangkat').text(data.nama);
            data.glr_dpn !=null ? $('#txtGlrDpnView').text(data.glr_dpn) : $('#txtGlrDpnView').text("-");
            data.glr_blk !=null ? $('#txtGlrBlkView').text(data.glr_blk) : $('#txtGlrBlkView').text("-");
            $('#txtJabatan').text(data.is_jabatan);
            data.is_plt == 'Y' ? $('#txtPLT').append('PLT') : $('#txtPLT').append('Bukan PLT');
            data.is_aktif == 'Y' ? $('#txtStatus').append('Aktif') : $('#txtStatus').append('Tidak Aktif');
            $('#txtAwalMenjabat').text(data.awal_jabatan);
            $('#txtAkhirMenjabat').text(data.akhir_jabatan);
        },
        error       : function(data) {
            alert('Tidak Dapat Mengambil Data')
            //console.log(data);
        }
    });
}

function editData(id)
{
    save_method ="edit";
    $('input[name=method]').val('PATCH');
    $('#modalLabel').text('Ubah Data Perangkat');
    $('#btnName').text('Ubah');
    $.ajax ({
        url         : "perangkat/"+id+"/edit",
        type        : "GET",
        dataType    : "JSON",
        success     : function(data) {
            $('#id').val(id);
            $('#txtNIP').val(data.nip);
            $('#txtNama').val(data.nama);
            $('#txtGlrDpn').val(data.glr_dpn);
            $('#txtGlrBlk').val(data.glr_blk);
            $('#optJabatan').val((data.is_jabatan).replaceAll(' ','_'));
            $('#optStatus').val(data.is_aktif);
            $('#optPlt').val(data.is_plt);
            // $('#txtAwalJabatan').val(data.awal_jabatan);
            $('#awljbtn').flatpickr({
                defaultDate : data.awal_jabatan
            });
            $('#akhjbtn').flatpickr({
                defaultDate : data.akhir_jabatan
            });    
        },
        error       : function(data) {
            alert('Tidak Dapat Mengambil Data')
            //console.log(data);
        }
    });
}