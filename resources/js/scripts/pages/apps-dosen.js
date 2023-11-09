let save_method, table, url, word, type, assetPath;
let statusObj = {
    'Y': { title: 'Aktif', class: 'badge-light-success' },
    'N': { title: 'Tidak Aktif', class: 'badge-light-danger' }
};

if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
}

let customDelimiter = $('.custom-delimiter-mask');

$(function () {

    let dt_basic_table = $('.datatables-basic');

    // DataTable with buttons
    // --------------------------------------------------------------------
  
    dt_basic_table.dataTable().fnDestroy();
    table = dt_basic_table.DataTable({
        ajax: 'dosen-data',
        columns : [
            { data : 'id', name:'id', orderable: false, searchable: false, width:'5%' },
            { data : 'nup_nidn', width:'10%'},
            { data : 'nama_dosen',width:'25%',
                render: function ( data, type, row ) {
                    return row.nama_dosen+'<br><strong>'+row.fungsional.jbtn_fungsional+'</strong>';
                }
            },
            { data : 'pangkat.pangkat' ,width:'10%'},
            { data : 'pangkat.golongan',width:'15%'},
            { data : 'fungsional.jbtn_fungsional',width:'15%'},
            { data : 'is_aktif', name: 'status', width:'10%'},
            { data : '', width:'15%'}
        ],
        columnDefs: [
            {
                targets:6,
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
                targets: 7,
                title: 'Actions',
                orderable: false,
                render: function (data, type, full, meta) {
                    let $id = full['id'];
                    return (
                        '<div class="demo-inline-spacing">'+
                            '<button type="button" data-toggle="modal" data-target="#modals-slide-in" style="margin-top:0 !important;" class="btn btn-sm btn-icon btn-info" onClick="viewData(\''+$id+'\')">'+
                                feather.icons['info'].toSvg() +
                            '</button>'+
                            '<button type="button" style="margin-top:0 !important;" data-toggle="modal" data-target="#dosen" class="btn btn-sm btn-icon btn-warning" onClick="editData(\''+$id+'\')">'+
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

    table.columns([5]).visible(false);

    table.on('order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1+'.';
        });
    }).draw();


    //Save Data Pengguna
    $('#formDosen').on('submit', function(e) {
        e.preventDefault();
        let id = $('#id').val();
    
        if (save_method == "add") {
            url     = "dosen";
            type    = "POST";
            word    = "Ditambahkan";
        }
        else {
            url     = "dosen/"+id;
            type    = "PATCH";
            word    = "Diubah";
        }
    
        $.ajax({
            url  : url,
            type : type,
            data :$('#formDosen').serialize(),
            success : function() {
                toastr['success'](
                    'Data Dosen Luar Biasa Berhasil '+word+' !!',
                    'Sukses',
                    {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
                table.ajax.reload()
                $('#dosen').modal('hide');
            },
            error : function(data) {
                $('.invalid-feedback').text('')
                $('.invalid-feedback').hide();
                $.each(data.responseJSON,function (key, value) {
                    let input = '#formDosen div[id='+key+']';
                    $(input).text(value);
                    $('.invalid-feedback').show()
                });
            }
        })
    });

    // Custom Delimiter
  if (customDelimiter.length) {
    new Cleave(customDelimiter, {
      delimiters: ['.', '.', '.', '-', '.'],
      blocks: [2, 3, 3, 1, 3, 3],
      uppercase: true
    });
  }
});


async function editData(id)
{
    save_method ="edit";
    $('input[name=method]').val('PATCH');
    $('#modalLabel').text('Ubah Data Dosen Luar Biasa');
    $('#btnName').text('Ubah');
    $.ajax ({
        url         : "dosen/"+id+"/edit",
        type        : "GET",
        dataType    : "JSON",
        success     : function(data) {
            $('#id').val(id);
            $('#txtNUPNIDN').val(data.nup_nidn);
            $('#txtNamaDsnLb').val(data.name);
            $('#txtGlrDpn').val(data.glr_dpn);
            $('#txtGlrBlk').val(data.glr_blk);
            $('#txtNPWP').val(data.npwp);
            $('#txtNoRek').val(data.no_rek);
            $('#txtNamaNoRek').val(data.name_no_rek);
            $('#optPangkat').val(data.pangkat);
            $('#optJafung').val(data.fungsional);
            $('#optStatus').val(data.is_aktif);    
        },
        error       : function(data) {
            alert('Tidak Dapat Mengambil Data')
            //console.log(data);
        }
    });
}


/**
 * Show Modal Tambah Data
 * @param void
 */
async function add()
{
    $('.invalid-feedback').hide()
    save_method = "add";
    $('input[name=method]').val('POST');
    $('#formDosen')[0].reset();
    $('#modalLabel').text('Tambah Data Dosen Luar Biasa');
    $('#btnName').text('Simpan');   
}

async function viewData(id)
{
    $('#viewModalLabel').text('Detail Data Dosen Luar Biasa');
    $.ajax ({
        url         : "dosen/"+id,
        type        : "GET",
        dataType    : "JSON",
        success     : function(data) {
            $('#txtNUPNIDNView').text(data.nup_nidn);
            $('#txtNamaDsnLbView').text(data.name);
            data.glr_dpn !=null ? $('#txtGlrDpnView').text(data.glr_dpn) : $('#txtGlrDpnView').text("-");
            data.glr_blk !=null ? $('#txtGlrBlkView').text(data.glr_blk) : $('#txtGlrBlkView').text("-");
            $('#txtNPWPView').text(data.npwp);
            $('#txtNoRekView').text(data.no_rek);
            $('#txtNamaNoRekView').text(data.name_no_rek);
            $('#txtPangkatGolonganView').text(data.pangkat.pangkat+'-'+data.pangkat.golongan);
            $('#txtFungsionalView').text(data.fungsional.jbtn_fungsional);
            data.is_aktif == 'Y' ? $('#txtStatus').text('Aktif') : $('#txtStatus').text('Tidak Aktif');
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
        title: 'Menghapus Data Dosen Luar Biasa',
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
              text: 'Data Dosen Luar Biasa Batal Dihapus',
              icon: 'error',
              confirmButtonClass: 'btn btn-success'
        });
    });
}

function actDelete(id)
{
    $.ajax({
        url      : "dosen/"+id,
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