/*=========================================================================================
  File Name: form-validation.js
  Description: jquery bootstrap validation js
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: PIXINVENT
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {
  'use strict';

  let pageLoginForm = $('.auth-login-form');
  let btn_submit = document.getElementById('btnSubmit');

  pageLoginForm.on('submit', function(e) {
    e.preventDefault();
    $.ajax({
      url     : pageLoginForm.attr('action'),
      type    : "POST",
      data    : pageLoginForm.serialize(),
      success : function() {
        window.location = "/"
      },
      error   : function() {
        btn_submit.disabled = true
        btn_submit.innerText = 'Loading'
        clearData()
        document.getElementById('login-nip').focus();
          toastr['warning'](
            'Nomor Induk Pegawai atau Kata Sandi Anda Salah, Silahkan Ulangi Kembali !!',
            'Error',
            {
              closeButton: true,
              tapToDismiss: false
            }
          );
        btn_submit.disabled = false
        btn_submit.innerText = 'Masuk'
      }
    })
  })

  // var pageLoginForm = $('.auth-login-form');

  // // jQuery Validation
  // // --------------------------------------------------------------------
  // if (pageLoginForm.length) {
  //   pageLoginForm.validate({
  //     /*
  //     * ? To enable validation onkeyup
  //     onkeyup: function (element) {
  //       $(element).valid();
  //     },*/
  //     /*
  //     * ? To enable validation on focusout
  //     onfocusout: function (element) {
  //       $(element).valid();
  //     }, */
  //     rules: {
  //       'login-email': {
  //         required: true,
  //         email: true
  //       },
  //       'login-password': {
  //         required: true
  //       }
  //     }
  //   });
  // }
  function clearData() {
    document.getElementById('login-pengguna').reset();
  }
});