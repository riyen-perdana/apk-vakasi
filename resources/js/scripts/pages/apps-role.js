/**
 * DataTables Basic
 */

let save_method, table, url, word, type

$(function () {
    'use strict';

    let dt_basic_table = $('.datatables-basic');

    // DataTable with buttons
    // --------------------------------------------------------------------
  
    dt_basic_table.dataTable().fnDestroy();
    table = dt_basic_table.DataTable({
        ajax: 'role-data',
        scrollX: true,
        columns : [
            { data : 'id', name:'id', orderable: false, searchable: false, width:'3%' },
            { data : 'name', width:'17%'},
            { data : 'permissions.[, ].name'},
            { data : '', width:'15%'}
        ],
        columnDefs: [
            {
                // Actions
                targets: 3,
                title: 'Actions',
                orderable: false,
                render: function (data, type, full, meta) {
                    let $id = full['id'];
                    return (
                        '<div class="demo-inline-spacing">'+
                            '<button type="button" style="margin-top:0 !important;" data-toggle="modal" data-target="#role" class="btn btn-sm btn-icon btn-warning" onClick="editData('+$id+')">'+
                                feather.icons['edit-3'].toSvg() +
                            '</button>'+
                            '<button type="button" style="margin-top:0 !important;" class="btn btn-sm btn-icon btn-danger" onClick="deleteData('+$id+')">'+
                                feather.icons['trash-2'].toSvg() +
                            '</button>'+
                        '</div>'                    
                    );
                }
            },
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

    //Save Data Role
    $('#formRole').on('submit', function(e) {
        e.preventDefault();
        let id = $('#id').val();

        if (save_method == "add") {
            url     = "roles";
            type    = "POST";
            word    = "Ditambahkan";
        }
        else {
            url     = "roles/"+id;
            type    = "PATCH";
            word    = "Diubah";
        }

        $.ajax({
            url  : url,
            type : type,
            data :$('#formRole').serialize(),
            success : function() {
                toastr['success'](
                    'Data Role Pengguna Berhasil '+word+' !!',
                    'Sukses',
                    {
                      closeButton: true,
                      tapToDismiss: false
                    }
                  );
                table.ajax.reload()
                $('#role').modal('hide');
            },
            error : function(data) {
                $('.invalid-feedback').text('')
                $('.invalid-feedback').hide();
                $.each(data.responseJSON,function (key, value) {
                    let input = '#formRole div[id='+key+']';
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
    $('.checkPermissions').removeAttr('checked');
    $('.invalid-feedback').hide()
    save_method = "add";
    $('input[name=method]').val('POST');
    $('#formRole')[0].reset();
    $('#modalLabel').text('Tambah Data Role');
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
    $('#modalLabel').text('Ubah Data Role');
    $('#btnName').text('Ubah');
    $.ajax ({
        url         : "roles/"+id+"/edit",
        type        : "GET",
        dataType    : "JSON",
        success     : function(data) {
            $('#id').val(id);
            $('#txtRole').val(data.name);
            $('.checkPermissions').removeAttr('checked');
            data.permissions.forEach(permission => {
                $('[value='+permission.id+']').attr('checked','true');
                console.log(permission.id);
            });            
        },
        error       : function() {
            alert('Tidak Dapat Mengambil Data')
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
        title: 'Menghapus Data Role',
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
              text: 'Data Role Batal Dihapus',
              icon: 'error',
              confirmButtonClass: 'btn btn-success'
        });
    });
}
    
function actDelete(id)
{
    $.ajax({
        url      : "roles/"+id,
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