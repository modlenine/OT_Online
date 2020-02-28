




// Function save ot
function checkDuplicate(ot_empCode,ot_timeName,ot_date_request ,ot_empFname, ot_empLname, ot_empDeptCode, ot_empPosition)
{
    $.ajax({
        url:'main/checkDuplicate',
        method:'POST',
        data:{
            ot_empCode: ot_empCode,
            ot_timeName: ot_timeName,
            ot_date_request: ot_date_request
        },
        success:function(data){
           if(data != 0){
                alert('ข้อมูล '+ ot_empFname +' '+ ot_empLname + ' มีการขอทำโอทีในช่วงเวันและเวลาดังกล่าวแล้ว');
                location.reload();
           }else{
            save_ot(ot_date_request, ot_empFname, ot_empLname, ot_empCode, ot_empDeptCode, ot_empPosition, ot_timeName);
           }
            
        }
    });
}




function save_ot(ot_date_request, ot_empFname, ot_empLname, ot_empCode, ot_empDeptCode, ot_empPosition, ot_timeName) {
    var checkDept = $('#checkDept').val();

    $.ajax({
        url: 'main/saveot',
        method: 'POST',
        data: {
            "ot_date_request": ot_date_request,
            "ot_empFname": ot_empFname,
            "ot_empLname": ot_empLname,
            "ot_empCode": ot_empCode,
            "ot_empDeptCode": ot_empDeptCode,
            "ot_empPosition": ot_empPosition,
            "ot_timeName": ot_timeName
        },
        success: function (data) {
            $('#ot_date_request').val('');
            $('#ot_date_requestS').val('');
            $('#ot_timeName').val('');

            $('#alertEffect').fadeIn();
            $('#alertEffect').html('<div class="alert alert-success" role="alert">บันทึกข้อมูลสำเร็จ</div>');
            $('#alertEffect').fadeOut(3000);

            if (checkDept == 1005) {
                loaddata_list_groupHR();
            } else {
                loaddata_list_group(checkDept);
            }


        }
    });
}






//Update status
function updateStatus(dtot_code_group, dtot_userApprove_group, dtot_user_date_approveshow_group, dtot_result_approve_group) {
    var checkDept = $('#checkDept').val();
    $.ajax({
        url: 'main/approvestatus',
        method: 'POST',
        data: {
            'dtot_code_group': dtot_code_group,
            'dtot_userApprove_group': dtot_userApprove_group,
            'dtot_user_date_approveshow_group': dtot_user_date_approveshow_group,
            'dtot_result_approve_group': dtot_result_approve_group
        },
        success: function (data) {
            $('#alertEffect').fadeIn();
            $('#alertEffect').html('<div class="alert alert-success" role="alert">บันทึกข้อมูลสำเร็จ</div>');
            $('#alertEffect').fadeOut(3000);
            if (checkDept == 1005) {
                loaddata_list_groupHR();
            } else {
                loaddata_list_group(checkDept);
            }

        }
    });
}


function hrnotice(dtotcode, othrname, hrnoticedatetime ,hrnotice_memo) {
    var checkDept = $('#checkDept').val();
    $.ajax({
        url: 'main/hrnotice',
        method: 'POST',
        data: {
            'dtotcode': dtotcode,
            'othrname': othrname,
            'hrnoticedatetime': hrnoticedatetime,
            'hrnotice_memo': hrnotice_memo
        },
        success: function (data) {
            
            $('#alertEffect').fadeIn();
            $('#alertEffect').html('<div class="alert alert-success" role="alert">บันทึกข้อมูลสำเร็จ</div>');
            $('#alertEffect').fadeOut(3000);

            if (checkDept == 1005) {
                loaddata_list_groupHR();
            } else {
                loaddata_list_group(checkDept);
            }
            console.log(data);
        }
    });
}



// Load data list
function loaddata_list(queryByDept, filterstatus, filtertimename) {
    $.ajax({
        url: "main/getlistot",
        method: 'POST',
        data: {
            "queryByDept": queryByDept,
            "filterstatus": filterstatus,
            "filtertimename": filtertimename
        },
        success: function (data) {
            $('#result_otlist').html(data);
            var tt = $('#listot').DataTable({
                "columnDefs": [{
                    "searching": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'desc']
                ],
                responsive: true
            });

            tt.on('order.dt search.dt', function () {
                tt.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        }
    });
}



// Load data list group
function loaddata_list_group(queryByDept, filterstatus, filtertimename) {
    $.ajax({
        url: "main/getlistot_group",
        method: 'POST',
        data: {
            "queryByDept": queryByDept,
            "filterstatus": filterstatus,
            "filtertimename": filtertimename
        },
        success: function (data) {
            $('#result_otlist_group').html(data);
            var tt = $('#listot_group').DataTable({
                "columnDefs": [{
                    "searching": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'desc']
                ],
                responsive: true
            });

            tt.on('order.dt search.dt', function () {
                tt.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        }
    });
}

function loaddata_list_groupHR(filterstatus, filtertimename) {
    $.ajax({
        url: "main/getlistot_groupHR",
        method: 'POST',
        data: {
            "filterstatus": filterstatus,
            "filtertimename": filtertimename
        },
        success: function (data) {
            $('#result_otlist_group').html(data);
            var tt = $('#listot_group').DataTable({
                "columnDefs": [{
                    "searching": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'desc']
                ],
                responsive: true
            });

            tt.on('order.dt search.dt', function () {
                tt.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        }
    });
}









// Load data list
function loaddata_list_group_detail(otcoderequest) {
    $.ajax({
        url: "main/getlistot_group_detail",
        method: 'POST',
        data: {
            "otcoderequest": otcoderequest
        },
        success: function (data) {
            $('#result_otlist_group_detail').html(data);
            var tt = $('#listot_group_detail').DataTable({
                "columnDefs": [{
                    "searching": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'desc']
                ],
                responsive: true
            });

            tt.on('order.dt search.dt', function () {
                tt.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        }
    });
}




//Load data list for HR
function loaddata_list_hr(filterstatus, filtertimename) {
    $.ajax({
        url: 'main/getlistothr',
        method: 'POST',
        data: {
            "filterstatus": filterstatus,
            "filtertimename": filtertimename
        },
        success: function (data) {
            $('#result_otlist').html(data);
            var tt = $('#listot').DataTable({
                "columnDefs": [{
                    "searching": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'desc']
                ]
            });

            tt.on('order.dt search.dt', function () {
                tt.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        }
    });
}






//############ FUNCTION FOR SEARCH DATA ##################

// Search By date
function searchByDateHR(datestart, dateend, filterstatus, filtertimename) {
    $.ajax({
        url: 'main/searchByDateHR',
        method: 'POST',
        data: {
            "datestart": datestart,
            "dateend": dateend,
            "filterstatus": filterstatus,
            "filtertimename": filtertimename
        },
        success: function (data) {
            $('#result_otlist_group').html(data);
            var tt = $('#listot_group').DataTable({
                "columnDefs": [{
                    "searching": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'desc']
                ]
            });

            tt.on('order.dt search.dt', function () {
                tt.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        }
    });
}

function searchByDate(datestart, dateend, deptcode, filterstatus, filtertimename) {
    $.ajax({
        url: 'main/searchByDate',
        method: 'POST',
        data: {
            "datestart": datestart,
            "dateend": dateend,
            "deptcode": deptcode,
            "filterstatus": filterstatus,
            "filtertimename": filtertimename
        },
        success: function (data) {
            $('#result_otlist_group').html(data);
            var tt = $('#listot_group').DataTable({
                "columnDefs": [{
                    "searching": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'desc']
                ]
            });

            tt.on('order.dt search.dt', function () {
                tt.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        }
    });
}
// Search By date


// Search By dept
function searchByDept(dept, filterstatus, filtertimename) {
    $.ajax({
        url: 'main/searchByDept',
        method: 'POST',
        data: {
            "dept": dept,
            "filterstatus": filterstatus,
            "filtertimename": filtertimename
        },
        success: function (data) {
            $('#result_otlist_group').html(data);
            var tt = $('#listot_group').DataTable({
                "columnDefs": [{
                    "searching": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'desc']
                ]
            });

            tt.on('order.dt search.dt', function () {
                tt.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        }
    });
}
// Search By dept


// Search By Name
function searchByNameHR(name, filterstatus, filtertimename) {
    $.ajax({
        url: 'main/searchByNameHR',
        method: 'POST',
        data: {
            "name": name,
            "filterstatus": filterstatus,
            "filtertimename": filtertimename
        },
        success: function (data) {
            $('#result_otlist_group').html(data);
            var tt = $('#listot_group').DataTable({
                "columnDefs": [{
                    "searching": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'desc']
                ]
            });

            tt.on('order.dt search.dt', function () {
                tt.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        }
    });
}

function searchByName(name, deptcode, filterstatus, filtertimename) {
    $.ajax({
        url: 'main/searchByName',
        method: 'POST',
        data: {
            "name": name,
            "deptcode": deptcode,
            "filterstatus": filterstatus,
            "filtertimename": filtertimename
        },
        success: function (data) {
            $('#result_otlist_group').html(data);
            var tt = $('#listot_group').DataTable({
                "columnDefs": [{
                    "searching": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'desc']
                ]
            });

            tt.on('order.dt search.dt', function () {
                tt.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        }
    });
}


// Search By Employee Code
function searchByEmpCodeHR(empcode, filterstatus, filtertimename) {
    $.ajax({
        url: 'main/searchByEmpCodeHR',
        method: 'POST',
        data: {
            "empcode": empcode,
            "filterstatus": filterstatus,
            "filtertimename": filtertimename
        },
        success: function (data) {
            $('#result_otlist_group').html(data);
            var tt = $('#listot_group').DataTable({
                "columnDefs": [{
                    "searching": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'desc']
                ]
            });

            tt.on('order.dt search.dt', function () {
                tt.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        }
    });
}

function searchByEmpCode(empcode, deptcode, filterstatus, filtertimename) {
    $.ajax({
        url: 'main/searchByEmpCode',
        method: 'POST',
        data: {
            "empcode": empcode,
            "deptcode": deptcode,
            "filterstatus": filterstatus,
            "filtertimename": filtertimename
        },
        success: function (data) {
            $('#result_otlist_group').html(data);
            var tt = $('#listot_group').DataTable({
                "columnDefs": [{
                    "searching": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'desc']
                ]
            });

            tt.on('order.dt search.dt', function () {
                tt.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        }
    });
}




//Function for report#####################
function getdatareport(filterstatus, filtertime) {
    var datetimenow = $('#datetimenow').val();
    $.ajax({
        url: 'main/getdatareport',
        method: 'POST',
        data: {
            "filterstatus": filterstatus,
            "filtertime": filtertime
        },
        success: function (data) {
            $('#result_report').html(data);
            var tt = $('#list_report').DataTable({
                "columnDefs": [{
                    "searching": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [0, 'desc']
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        title: 'Report OT Online By Department on '+datetimenow
                    },
                    {
                        extend: 'excelHtml5',
                        autoFilter: true,
                        title: 'Report OT Online By Department on '+datetimenow
                    }
                ]
            });

        }
    });
}



function getdatareport_bydept(dept, filterstatus, filtertime) {
    var datetimenow = $('#datetimenow').val();
    $.ajax({
        url: 'main/getdatareport_bydept',
        method: 'POST',
        data: {
            "dept": dept,
            "filterstatus": filterstatus,
            "filtertime": filtertime
        },
        success: function (data) {
            $('#result_report').html(data);
            var tt = $('#list_report').DataTable({
                "columnDefs": [{
                    "searching": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [0, 'desc']
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        title: 'Report OT Online By Department on '+datetimenow
                    },
                    {
                        extend: 'excelHtml5',
                        autoFilter: true,
                        title: 'Report OT Online By Department on '+datetimenow
                    }
                ]
            });

        }
    });
}




// Report by Dept
function reportByDept(dept, filterstatus, filtertime) {
    var datetimenow = $('#datetimenow').val();
    $.ajax({
        url: 'main/reportByDept',
        method: 'POST',
        data: {
            "dept": dept,
            "filterstatus": filterstatus,
            "filtertime": filtertime
        },
        success: function (data) {
            $('#result_report').html(data);
            var tt = $('#list_report').DataTable({
                "columnDefs": [{
                    "searching": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'desc']
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        title: 'Report OT Online By Department on '+datetimenow
                    },
                    {
                        extend: 'excelHtml5',
                        autoFilter: true,
                        title: 'Report OT Online By Department on '+datetimenow
                    }
                ]
            });


        }
    });
}



// Report By date
function reportByDate(datestart, dateend, filterstatus, filtertime) {
    $.ajax({
        url: 'main/reportByDate',
        method: 'POST',
        data: {
            "datestart": datestart,
            "dateend": dateend,
            "filterstatus": filterstatus,
            "filtertime": filtertime
        },
        success: function (data) {
            $('#result_report').html(data);
            var tt = $('#list_report').DataTable({
                "columnDefs": [{
                    "searching": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'desc']
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        title: 'Report OT Online By Department on '+datetimenow
                    },
                    {
                        extend: 'excelHtml5',
                        autoFilter: true,
                        title: 'Report OT Online By Department on '+datetimenow
                    }
                ]
            });
        }
    });
}

function reportByDate_focusDept(dept, datestart, dateend, filterstatus, filtertime) {
    $.ajax({
        url: 'main/reportByDate_focusDept',
        method: 'POST',
        data: {
            "dept": dept,
            "datestart": datestart,
            "dateend": dateend,
            "filterstatus": filterstatus,
            "filtertime": filtertime
        },
        success: function (data) {
            $('#result_report').html(data);
            var tt = $('#list_report').DataTable({
                "columnDefs": [{
                    "searching": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'desc']
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            });
        }
    });
}




// JSON DATA QUERY TO DATATABLE
function loadreportjson(dept,report_filter_status,report_filter_timename)
{
   $.ajax({
        url:'main/getreportJsonFilter',
        method: 'POST',
        data:{
            dept: dept,
            report_filter_status: report_filter_status,
            report_filter_timename : report_filter_timename
        },
        dataType:'json',
        success:function(data){
            console.log(data);
            
        }

   });
}


function loadreportjsonHR(report_filter_status,report_filter_timename)
{
   var dataTable = $('#example').DataTable({
        // "processing" : true,
        // "serverSide" : true,
        // "order" : [],
        // "searching" : false,
        "ajax" : {
            url: "main/getreportJsonFilterHR",
            type: "POST",
            data : {
                report_filter_status:report_filter_status,
                report_filter_timename:report_filter_timename
            }

        }
   });
}



//LOAD OT LIST NEW
function loadlist(checkDept)
{
    $.ajax({
        url:'main/loadlist',
        method:'POST',
        data:{
            checkDept: checkDept
        },
        success:function(data){
            $('#result_otlist_group_new').html(data);
        }
    });
}






