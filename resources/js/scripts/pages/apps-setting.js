let save_method, table, url, word, type

let mengajar = $('#txt_a_ajr'); 
let koreksi = $('#txt_a_krk');
let pengawas = $('#txt_a_aws');
let pembuat = $('#txt_a_soal');

const rupiah = (number)=> {
    return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR"
    }).format(number);
}

$(function () {

    let dt_basic_table = $('.datatables-basic');

    // DataTable with buttons
    // --------------------------------------------------------------------
    dt_basic_table.dataTable().fnDestroy();
    table = dt_basic_table.DataTable({
        ajax: 'setting-data',
        order: [[ 1, "asc" ]],
        columns : [
            { data : 'id', name:'id', orderable: false, searchable: false, width:'5%' },
            { data : 'fungsional.jbtn_fungsional', width:'15%'},
            { data : 'a_ajr', width:'15%'},
            { data : 'a_soal', width:'15%'},
            { data : 'a_aws', width:'15%'},
            { data : 'a_krk', width:'15%'},
            { data : '', width:'15%'}
        ],
        columnDefs: [
            {
                targets : 2,
                orderable : true,
                render : function (data,type,row) {
                    return rupiah(row.a_ajr)
                }
            },
            {
                targets : 3,
                orderable : true,
                render : function (data,type,row) {
                    return rupiah(row.a_soal)
                }
            },
            {
                targets : 4,
                orderable : true,
                render : function (data,type,row) {
                    return rupiah(row.a_aws)
                }
            },
            {
                targets : 5,
                orderable : true,
                render : function (data,type,row) {
                    return rupiah(row.a_krk)
                }
            },
            {
                // Actions
                targets: -1,
                title: 'Actions',
                orderable: false,
                render: function (data, type, full, meta) {
                    let $id = full['id'];
                    return (
                        '<div class="demo-inline-spacing">'+
                            '<button type="button" style="margin-top:0 !important;" data-toggle="modal" data-target="#setting" class="btn btn-sm btn-icon btn-warning" onClick="editData(\''+$id+'\')">'+
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

    //Save Data Setting Vakasi
    $('#formSetting').on('submit', function(e) {
        e.preventDefault();
        let id = $('#id').val();
    
        if (save_method == "add") {
            url     = "setting";
            type    = "POST";
            word    = "Ditambahkan";
        }
        else {
            url     = "setting/"+id;
            type    = "PATCH";
            word    = "Diubah";
        }
    
        $.ajax({
            url  : url,
            type : type,
            data :$('#formSetting').serialize(),
            success : function() {
                toastr['success'](
                    'Data Setting Vakasi Berhasil '+word+' !!',
                    'Sukses',
                    {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
                table.ajax.reload()
                $('#setting').modal('hide');
            },
            error : function(data) {
                $('.invalid-feedback').text('')
                $('.invalid-feedback').hide();
                $.each(data.responseJSON,function (key, value) {
                    let input = '#formSetting div[id='+key+']';
                    $(input).text(value);
                    $('.invalid-feedback').show()
                });
            }
        })
    });


    if(mengajar.length) {
        new Cleave(mengajar, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
    }

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
})


function add() {
    $('.invalid-feedback').hide()
    save_method = "add";
    $('input[name=method]').val('POST');
    $('#formSetting')[0].reset();
    $('#modalLabel').text('Tambah Data Setting Vakasi');
    $('#btnName').text('Simpan');   
}

function editData(id)
{
    save_method ="edit";
    $('input[name=method]').val('PATCH');
    $('#modalLabel').text('Ubah Data Setting Vakasi');
    $('#btnName').text('Ubah');
    $.ajax ({
        url         : "setting/"+id+"/edit",
        type        : "GET",
        dataType    : "JSON",
        success     : function(data) {
            $('#id').val(id);
            $('#optFungsional').val(data.fungsional.id);
            if(mengajar.length) {
                new Cleave(mengajar.val(data.a_ajr), {
                    numeral : true,
                    numeralThousandsGroupStyle : 'thousand'
                });
            }
            if(koreksi.length) {
                new Cleave(koreksi.val(data.a_krk), {
                    numeral : true,
                    numeralThousandsGroupStyle : 'thousand'
                });
            }
            if(pengawas.length) {
                new Cleave(pengawas.val(data.a_aws), {
                    numeral : true,
                    numeralThousandsGroupStyle : 'thousand'
                });
            }
            if(pembuat.length) {
                new Cleave(pembuat.val(data.a_soal), {
                    numeral : true,
                    numeralThousandsGroupStyle : 'thousand'
                });
            }
        },
        error       : function(data) {
            alert('Tidak Dapat Mengambil Data')
            //console.log(data);
        }
    });
}

function deleteData(id)
{
     Swal.fire({
        title: 'Menghapus Data Setting Vakasi',
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
              text: 'Data Setting Vakasi Batal Dihapus',
              icon: 'error',
              confirmButtonClass: 'btn btn-success'
        });
    });
}

function actDelete(id)
{
    $.ajax({
        url      : "setting/"+id,
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