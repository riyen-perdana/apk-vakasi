/**
 * DataTables Basic
 */

$(function () {
    'use strict';
  
    let dt_basic_table = $('.datatables-basic')
    let table;

    // DataTable with buttons
    // --------------------------------------------------------------------
  
    dt_basic_table.dataTable().fnDestroy();
    table = dt_basic_table.DataTable({
        ajax: 'role-data',
        scrollX: true,
        columns : [
            { data : 'id', name:'id', orderable: false, searchable: false, width:'3%' },
            { data : 'name', width:'12%'},
            { data : 'permissions.[, ].name', width:'70%'},
            { data : 'name', width:'15%'}
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
    
  