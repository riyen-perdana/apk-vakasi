let save_method, table, url, word, type
let statusObj = {
    '1': { title: 'Aktif', class: 'badge-light-success', action:'Non Aktifkan', icons: feather.icons['x'].toSvg(), class_btn :'btn-flat-danger' },
    '0': { title: 'Tidak Aktif', class: 'badge-light-danger', action:'Aktifkan',icons: feather.icons['check'].toSvg(), class_btn :'btn-flat-success' }
};

document.getElementById('progress').hidden = true;
document.getElementById('example-caption-1').innerText = '';

$(function () {

    let dt_basic_table = $('.datatables-basic');

    // DataTable with buttons
    // --------------------------------------------------------------------
  
    dt_basic_table.dataTable().fnDestroy();
    table = dt_basic_table.DataTable({
        ajax: 'semester-data',
        order: [[ 1, "asc" ]],
        columns : [
            { data : 'id_smt', name:'id', orderable: false, searchable: false, width:'5%' },
            { data : 'id_smt', width: '12%'},
            { data : 'nm_semester'},
            { data : 'a_periode_aktif', width: '15%'},
            { data : '', width:'15%'}
        ],
        columnDefs: [
            {
                targets:3,
                title:'Status',
                render: function (data,type,full,meta) {
                    let $status = full['a_periode_aktif'];
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
                title: 'Actions',
                orderable: false,
                render: function (data, type, full, meta) {
                    let $id = full['id_smt'];
                    let $status = full['a_periode_aktif'];
                    return (
                        '<div class="demo-inline-spacing">'+
                            '<button type="button" style="margin-top:0 !important;" data-toggle="modal" data-target="#fungsional" class="btn '+ statusObj[$status].class_btn +' waves-effect" onClick="editData(\''+$id+'\')">'+
                            statusObj[$status].icons + '<span>'+ statusObj[$status].action +'</span>' +
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
});

/**
 * Show Modal Tambah Data
 * @param void
 */
let add = async function () {
    document.getElementById("add").disabled = true; 
    document.getElementById('progress').removeAttribute('style');
    document.getElementById('progress').hidden = false;
    actDelete();
    // await getData();
}

{   
    

    // actDelete();
    // let response = await fetch('../api/semester-aktif');
    // let data = await response.json();
    // console.log(data.data.length);
    
}

function actDelete()
{
    document.getElementById('example-caption-1').innerText = 'Menghapus Data';
    $.ajax({
        url      : "semester",
        type     : "DELETE",
        dataType : "JSON",
        headers  : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success  : function() {
            setTimeout(function() {
                document.getElementById('example-caption-1').innerText = 'Membaca Data iRaise';
                processData();
            },5000);
            table.ajax.reload();
        },
        error    : function(error) {
            console.log(error);
            // Swal.fire({
            //     icon : 'error',
            //     title: 'Gagal Menghapus Data!',
            //     text: 'Error Saat Penghapusan Data.',
            //     confirmButtonClass: 'btn btn-danger'
            // })
        }
    })
}

function updateProgressBar(progress) {
    document.getElementById('example-caption-1').innerText = `Membaca Data iRaise ${progress}%`
    document.getElementById('pgb').style.width = `${progress}%`;
}

async function processData() {
    let response = await fetch('../api/semester-aktif');
    let data = await response.json();
    let dataLength = data.data.length;
    let countData = 0;

    let intervalId = setInterval(() => {
        persen = parseInt(countData/dataLength * 100).toFixed(0);
        updateProgressBar(persen);
        insertData(data.data[countData]);
        table.ajax.reload();
        if(persen >= 100) {
            clearInterval(intervalId);
            persen = 0;
            document.getElementById('pgb').style.width = 0+'%';
            document.getElementById("add").disabled = false;
            document.getElementById('progress').hidden = true;
            toastr['success'](
                'Data Semester Berhasil Diimport !!',
                'Sukses',
                {
                    closeButton: true,
                    tapToDismiss: false
                }
            );
        }
        countData +=1;

    }, 1000);
}

async function insertData(dataList) {
    if (dataList != undefined) {
        try {
            const response = await fetch('semester', {
                method : "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                body : JSON.stringify(dataList)
            })

            const result = await response.json()
            console.log("Sukses:", result);

        } catch (error) {
            console.error("Error:", error);
        }
    }
}

async function editData(id)
{
    try {
        const response = await fetch('semester/'+id, {
            method : "PATCH",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": $('input[name="_token"]').val()
            },
            body : JSON.stringify({id:id})
        })

        const result = await response.json()
        toastr['success'](
            'Data Semester Berhasil Diimport !!',
            'Sukses',
            {
                closeButton: true,
                tapToDismiss: false
            }
        );
        table.ajax.reload();

    } catch (error) {
        console.error("Error:", error);
        toastr['warning'](
            'Data Semester Gagal Diubah',
            'Gagal',
            {
                closeButton: true,
                tapToDismiss: false
            }
        );
        table.ajax.reload();
    }
}