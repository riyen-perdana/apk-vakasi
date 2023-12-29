let id_smt;
let id_vakasi;
let table, url, word, type;

let smt = document.getElementById('basicSelect');
smt.addEventListener("change", function handleChange(e) {
    id_smt = e.target.value;
});

const get = async (url, params) => {
    const response = await fetch(url + '?' + new URLSearchParams(params));
    const data = await response.json();
    return data;
}

async function proses() {
    if(id_smt) {
        document.getElementById('proses').disabled = 'true';
        document.getElementById('progress').removeAttribute('style');
        document.getElementById('progress').hidden = false;
        getDataDosen();
    }    
}

async function getDataPerangkatSemester()
{
    let response = await get('http://apk-vakasi.test/api/semester-perangkat', {
        id_smt:id_smt
    });
    await saveDataPerangkatSemester(response);
}

async function saveDataPerangkatSemester(data)
{
    if (data != undefined) {
        try {
            const response = await fetch('vakasi', {
                method : "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                body : JSON.stringify(data)
            })

                id_vakasi = await response.json();
                if(id_vakasi === 'error') {
                    Swal.fire({
                        icon : 'error',
                        title: 'Gagal Sinkorinasi Data!',
                        text: 'Error Saat Sinkronisasi Data.',
                        confirmButtonClass: 'btn btn-danger'
                    })
                    document.getElementById('proses').disabled = false;
                    document.getElementById('progress').hidden = true;
                }

                //Panggil getDosen
                setTimeout(function() {
                    document.getElementById('example-caption-1').innerText = 'Membaca Data BAD Dosen Luar Biasa';        
                    return (
                        fetch('../api/get-data-dosen-lb')
                        .then(response => response.json())
                        .then(data => {
                            getDataBad(data);
                            // console.log(data)
                        })
                        .catch(err => {
                            console.log(err)
                        })
                    );
                },5000);            
        } catch (error) {
            console.log(error);
        }
    }
}

async function getDataDosen()
{
    document.getElementById('example-caption-1').innerText = 'Persiapan Proses Sinkronisasi Data';
    setTimeout(function(async) {
        document.getElementById('example-caption-1').innerText = 'Menyimpan Data Perangkat dan Semester';
        getDataPerangkatSemester();
    },5000);
    
}

function updateProgressBar(progress) {
    document.getElementById('example-caption-1').innerText = `Membaca Data BAD Dosen Luar Biasa ${progress}%`
    document.getElementById('pgb').style.width = `${progress}%`;
}

async function getDataBad(dosen) {
    let dataLength = dosen.length;
    let countData = 0;
    let intervalId = setInterval(async() => {
        persen = parseInt(countData/dataLength * 100).toFixed(0);
        updateProgressBar(persen);
        if(dosen[countData] != undefined) {
            //Simpan Data Berdasarkan nup_nidn
            await saveDataBad(dosen[countData]['id'],dosen[countData]['nup_nidn']);
            //console.log(dosen[countData]['nup_nidn']);
        }
        if(persen >= 100) {
            clearInterval(intervalId);
            persen = 0;
            document.getElementById('pgb').style.width = 0+'%';
            document.getElementById("proses").disabled = false;
            document.getElementById('progress').hidden = true;
            toastr['success'](
                'Data BAD Dosen Luar Biasa Berhasil Disimpan !!',
                'Sukses',
                {
                    closeButton: true,
                    tapToDismiss: false
                }
            );
            table.ajax.reload();
        }
        countData +=1;
    }, 3000);
}

async function saveDataBad(id_dsn,nup) {
    let dsn_id = id_dsn;
    let nup_nidn = nup;
    let response = await get('http://apk-vakasi.test/api/get-data-bad', {
        id_smt : id_smt,
        nup_nidn : nup_nidn
    });

    let data_bad = {}
    data_bad['id_vakasi'] = id_vakasi;
    data_bad['id_dsn'] = dsn_id;
    data_bad['bad'] = response;

    await insertDataBad(data_bad);
}

async function insertDataBad(dataList)
{
    if(dataList != undefined ) {
        try {
            const response = await fetch('vakasi-detail', {
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

$(function () {
    let dt_basic_table = $('.datatables-basic');
    dt_basic_table.dataTable().fnDestroy();

    table = dt_basic_table.DataTable({
        ajax: 'vakasi-data',
        order: [[ 1, "asc" ]],
        columns : [
            { data : 'semester.id_smt', name:'id', orderable: false, searchable: false, width:'5%' },
            { data : 'semester.id_smt', width: '12%'},
            { data : 'semester.nm_semester'},
            { data : 'semester.nm_semester', width:'15%'}
        ],
        columnDefs: [
            {
                // Actions
                targets: -1,
                title: 'Actions',
                orderable: false,
                render: function (data, type, full, meta) {
                    let $id = full['id'];
                    return (
                        '<div class="demo-inline-spacing">'+
                            '<button type="button" data-toggle="modal" data-target="#modals-slide-in" style="margin-top:0 !important;" class="btn btn-sm btn-icon btn-info" onClick="infoData(\''+$id+'\')">'+
                                feather.icons['info'].toSvg() +
                            '</button>'+
                            '<button type="button" style="margin-top:0 !important;" class="btn btn-sm btn-icon btn-success" onClick="detailData(\''+$id+'\')">'+
                                feather.icons['database'].toSvg() +
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

async function infoData(id)
{
    $('#viewModalLabel').text('Detail Data Vakasi');
    $.ajax ({
        url         : "vakasi/"+id,
        type        : "GET",
        dataType    : "JSON",
        success     : function(data) {
            $('#txtIdSemester').text(data.id_smt);
            $('#txtNamaSemester').text(data.semester.nm_semester);
            $('#txtNmDekan').text(data.nm_dkn);
            $('#txtNIPDekan').text('NIP. '+data.nip_dkn);
            $('#txtPPK').text(data.nm_ppk);
            $('#txtNIPPPK').text('NIP. '+data.nip_ppk);
            $('#txtPPKRM').text(data.nm_ppk_rm);
            $('#txtNIPPPKRM').text('NIP. '+data.nip_ppk_rm);
            $('#txtBP').text(data.nm_bp);
            $('#txtNIPBP').text('NIP. '+data.nip_bp);
            $('#txtBPP').text(data.nm_bpp_rm);
            $('#txtNIPBPP').text('NIP. '+data.nip_bpp_rm);
        },
        error       : function(data) {
            alert('Tidak Dapat Mengambil Data')
            //console.log(data);
        }
    });
}

async function detailData(id)
{
    let link = document.createElement("a");
    link.href = "vakasi-detail/"+id;
    link.target = "_blank"
    link.click()
    console.log(link.href);
}
