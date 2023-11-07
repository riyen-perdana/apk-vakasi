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