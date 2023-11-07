/**
 * DataTables Basic
 */

let save_method, table, url, word, type, assetPath;
let statusObj = {
    'Y': { title: 'Aktif', class: 'badge-light-success' },
    'N': { title: 'Tidak Aktif', class: 'badge-light-danger' }
};

if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
}

$(function () {
    'use strict';

    let dt_basic_table = $('.datatables-basic');

    // DataTable with buttons
    // --------------------------------------------------------------------
  
    dt_basic_table.dataTable().fnDestroy();
    table = dt_basic_table.DataTable({
        ajax: 'pengguna-data',
        columns : [
            { data : 'id', name:'id', orderable: false, searchable: false, width:'5%' },
            { data : 'nip', width:'10%'},
            { data : 'nama_pengguna',width:'25%'},
            { data : 'email',width:'20%'},
            { data : 'is_aktif', name: 'status', width:'10%'},
            { data : '', width:'15%'}
        ],
        columnDefs: [
            {
                targets:4,
                title:'Status',
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
                targets: 5,
                title: 'Actions',
                orderable: false,
                render: function (data, type, full, meta) {
                    let $id = full['code_red'];
                    return (
                        '<div class="demo-inline-spacing">'+
                            '<button type="button" data-toggle="modal" data-target="#modals-slide-in" style="margin-top:0 !important;" class="btn btn-sm btn-icon btn-danger" onClick="viewData(\''+$id+'\')">'+
                                feather.icons['info'].toSvg() +
                            '</button>'+
                            '<button type="button" style="margin-top:0 !important;" data-toggle="modal" data-target="#pengguna" class="btn btn-sm btn-icon btn-warning" onClick="editData(\''+$id+'\')">'+
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

    //Save Data Pengguna
    $('#formPengguna').on('submit', function(e) {
        e.preventDefault();
        let id = $('#id').val();

        if (save_method == "add") {
            url     = "pengguna";
            type    = "POST";
            word    = "Ditambahkan";
        }
        else {
            url     = "pengguna/"+id;
            type    = "PATCH";
            word    = "Diubah";
        }

        $.ajax({
            url  : url,
            type : type,
            data :$('#formPengguna').serialize(),
            success : function() {
                toastr['success'](
                    'Data Pengguna Berhasil '+word+' !!',
                    'Sukses',
                    {
                      closeButton: true,
                      tapToDismiss: false
                    }
                  );
                table.ajax.reload()
                $('#pengguna').modal('hide');
            },
            error : function(data) {
                $('.invalid-feedback').text('')
                $('.invalid-feedback').hide();
                $.each(data.responseJSON,function (key, value) {
                    let input = '#formPengguna div[id='+key+']';
                    $(input).text(value);
                    $('.invalid-feedback').show()
                });
            }
        })
    });
});

/**
 * Show Modal Tambah Data
 * @param void
 */
async function add()
{
    $('.invalid-feedback').hide()
    save_method = "add";
    $('input[name=method]').val('POST');
    $('#formPengguna')[0].reset();
    $('#modalLabel').text('Tambah Data Pengguna');
    $('#btnName').text('Simpan');   
}

/**
 * Show Modal Ubah Data
 * @param {*} id 
 */
async function editData(id)
{
    save_method ="edit";
    $('input[name=method]').val('PATCH');
    $('#modalLabel').text('Ubah Data Pengguna');
    $('#btnName').text('Ubah');
    $.ajax ({
        url         : "pengguna/"+id+"/edit",
        type        : "GET",
        dataType    : "JSON",
        success     : function(data) {
            $('#id').val(id);
            $('#txtNIP').val(data.nip);
            $('#txtNama').val(data.name);
            $('#txtGlrDpn').val(data.glr_dpn);
            $('#txtGlrBlk').val(data.glr_blk);
            $('#txtEmail').val(data.email);
            $('#optStatus').val(data.is_aktif);
            $('#optRole').val(data.roles[0].id);
            // $('#modalLabel').text('Ubah Data Pengguna '+data.nip);       
        },
        error       : function(data) {
            alert('Tidak Dapat Mengambil Data')
            //console.log(data);
        }
    });
}


/**
 * Hapus Data
 * @param {*} id 
 */
async function deleteData(id)
{
     Swal.fire({
        title: 'Menghapus Data Pengguna',
        text: "Apakah Anda Yakin ?",
        icon: 'warning',
        showCancelButton: !0,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus !',
        cancelButtonText: 'Batalkan',
        confirmButtonClass: 'btn btn-primary',
        cancelButtonClass: 'btn btn-danger ml-1',
        buttonsStyling: !1
      }).then(function (t) {
        t.value
          ? actDelete(id)
          : t.dismiss === Swal.DismissReason.cancel &&
            Swal.fire({
              title: 'Dibatalkan',
              text: 'Data Pengguna Batal Dihapus',
              icon: 'error',
              confirmButtonClass: 'btn btn-success'
        });
    });
}
    
function actDelete(id)
{
    $.ajax({
        url      : "pengguna/"+id,
        type     : "DELETE",
        dataType : "JSON",
        headers  : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //data     : {'_token': '{{csrf_token()}}'},
        success  : function() {
            Swal.fire({
                icon : 'success',
                title: 'Dihapus!',
                text: 'Data Sukses Dihapus.',
                confirmButtonClass: 'btn btn-success'
            });
            table.ajax.reload();
        },
        error    : function() {
            Swal.fire({
                icon : 'error',
                title: 'Gagal Menghapus Data!',
                text: 'Error Saat Penghapusan Data.',
                confirmButtonClass: 'btn btn-danger'
            })
        }
    })
}

async function viewData(id)
{
    $('#viewModalLabel').text('Detail Data Pengguna');
    $.ajax ({
        url         : "pengguna/"+id+"/edit",
        type        : "GET",
        dataType    : "JSON",
        success     : function(data) {
            $('#txtNIPView').text(data.nip);
            $('#txtNamaView').text(data.name);
            $('#txtNamaGelarView').text(data.nama_pengguna);
            $('#txtEmailView').text(data.email);
            $('#txtRole').text(data.roles[0].name);
            data.is_aktif == 'Y' ? $('#txtStatus').text('Aktif') : $('#txtStatus').text('Tidak Aktif');
            data.glr_dpn !=null ? $('#txtGlrDpnView').text(data.glr_dpn) : $('#txtGlrDpnView').text("-");
            data.glr_blk !=null ? $('#txtGlrBlkView').text(data.glr_blk) : $('#txtGlrBlkView').text("-");
            // $('#txtGlrDpnView').text(data.glr_dpn);
            // $('#txtGlrBlk').val(data.glr_blk);
            // $('#txtEmail').val(data.email);
            // $('#optStatus').val(data.is_aktif);
            // $('#optRole').val(data.roles[0].id);
            // $('#modalLabel').text('Ubah Data Pengguna '+data.nip);       
        },
        error       : function(data) {
            alert('Tidak Dapat Mengambil Data')
            //console.log(data);
        }
    });

}