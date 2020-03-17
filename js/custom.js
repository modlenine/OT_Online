$(document).ready(function () {


	var count = 0;

	// $('#saveuser').click(function () {

	// 	var error_ot_date_request = '';
	// 	var error_ot_empFname = '';
	// 	var error_ot_empLname = '';
	// 	var error_ot_empCode = '';
	// 	var error_ot_empDeptCode = '';
	// 	var error_ot_empPosition = '';
	// 	var error_ot_timeName = '';

	// 	var ot_date_request = '';
	// 	var ot_empFname = '';
	// 	var ot_empLname = '';
	// 	var ot_empCode = '';
	// 	var ot_empDeptCode = '';
	// 	var ot_empPosition = '';
	// 	var ot_timeName = '';


	// 	ot_date_request = $('#ot_date_request').val();
	// 	ot_empFname = $('#ot_empFname').val();
	// 	ot_empLname = $('#ot_empLname').val();
	// 	ot_empCode = $('#ot_empCode').val();
	// 	ot_empDeptCode = $('#ot_empDeptCode').val();
	// 	ot_empPosition = $('#ot_empPosition').val();
	// 	ot_timeName = $('#ot_timeName').val();


	// 	count = count + 1;
	// 	output = '<tr id="row_' + count + '">';
	// 	output += '<td>' + ot_date_request + ' <input type="hidden" name="hidden_ot_date_request[]" id="ot_date_request' + count + '" class="ot_date_request" value="' + ot_date_request + '" /></td>';
	// 	output += '<td>' + ot_empFname + ' <input type="hidden" name="hidden_ot_empFname[]" id="ot_empFname' + count + '" value="' + ot_empFname + '" /></td>';
	// 	output += '<td>' + ot_empLname + ' <input type="hidden" name="hidden_ot_empLname[]" id="ot_empLname' + count + '" value="' + ot_empLname + '" /></td>';
	// 	output += '<td>' + ot_empCode + ' <input type="hidden" name="hidden_ot_empCode[]" id="ot_empCode' + count + '" value="' + ot_empCode + '" /></td>';
	// 	output += '<td>' + ot_empDeptCode + ' <input type="hidden" name="hidden_ot_empDeptCode[]" id="ot_empDeptCode' + count + '" value="' + ot_empDeptCode + '" /></td>';
	// 	output += '<td>' + ot_empPosition + ' <input type="hidden" name="hidden_ot_empPosition[]" id="ot_empPosition' + count + '" value="' + ot_empPosition + '" /></td>';
	// 	output += '<td>' + ot_timeName + ' <input type="hidden" name="hidden_ot_timeName[]" id="ot_timeName' + count + '" value="' + ot_timeName + '" /></td>';
	// 	output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="' + count + '">View</button></td>';
	// 	output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="' + count + '">Remove</button></td>';
	// 	output += '</tr>';
	// 	$('#user_data').append(output);




	// });




	// Date pickup use 	// Date pickup use 	// Date pickup use
	// Date pickup use 	// Date pickup use 	// Date pickup use
	$('.datepicker_emp').pickadate({
		monthsFull: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฏาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
		weekdaysShort: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
		today: 'วันนี้',
		clear: 'ล้าง',
		format: 'dd-mm-yyyy',
		formatSubmit: 'yyyy-mm-dd',
		hiddenName: true,
		min: true,
		max: 7
	});



	$('#dateStart , #dateEnd').pickadate({
		monthsFull: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฏาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
		weekdaysShort: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
		today: 'วันนี้',
		clear: 'ล้าง',
		format: 'dd-mm-yyyy',
		formatSubmit: 'yyyy-mm-dd',
		hiddenName: true
	});

	
	// Date pickup use 	// Date pickup use 	// Date pickup use  
	// Date pickup use 	// Date pickup use 	// Date pickup use








	$('#ot_date_requestS').on('change', function () {
		var showdate = $(this).val();
		if (showdate != '') {
			$('#ot_date_request').val(showdate);
		} else {
			alert('กรุณาเลือกวันที่ด้วย');
		}

	});




	// Verify HR DEPT For display data 
	var checkDept = $('#checkDept').val();
	if (checkDept == 1005) {
		loaddata_list_groupHR();
		$('input[name=filter_status] , input[name=filter_timename]').on('click', function () {
			var filterstatus = $('#filter_status:checked').val();
			var filtertimename = $('#filter_timename:checked').val();
			// loaddata_list_hr(filterstatus, filtertimename);
			loaddata_list_groupHR(filterstatus, filtertimename);
		});
	} else {
		if(checkDept == 1014 || checkDept == 1015){
			var checkDepts = '1014,1015';
			loaddata_list_group(checkDepts, '');
		}else{
			loaddata_list_group(checkDept, '');
		}
		
		$('input[name=filter_status] , input[name=filter_timename]').on('click', function () {
			var filterstatus = $('#filter_status:checked').val();
			var filtertimename = $('#filter_timename:checked').val();
			// loaddata_list(checkDept, filterstatus, filtertimename);
			if(checkDept == 1014 || checkDept == 1015){
				var checkDepts = '1014,1015';
				loaddata_list_group(checkDepts, filterstatus, filtertimename);
			}else{
				loaddata_list_group(checkDept, filterstatus, filtertimename);
			}
			
		});
	}



	// Check Permission Btn Create OT Group
	var checkposi = $('#checkPosi').val();
	$('.checkPermisCreate').css('display' , 'none');
	if(checkposi != 15){
		$('.checkPermisCreate').css('display' , '');
	}else{
		$('.checkPermisCreate').css('display' , 'none');
	}








	//Add OT
	$('#user_insert').click(function () {
		var ot_date_request = $('#ot_date_request').val();
		var ot_empFname = $('#ot_empFname').val();
		var ot_empLname = $('#ot_empLname').val();
		var ot_empCode = $('#ot_empCode').val();
		var ot_empDeptCode = $('#ot_empDeptCode').val();
		var ot_empPosition = $('#ot_empPosition').val();
		var ot_timeName = $('#ot_timeName').val();

		if (ot_date_request == '' || ot_empFname == '' || ot_empLname == '' || ot_empCode == '' || ot_empDeptCode == '' || ot_empPosition == '' || ot_timeName == '') {
			alert('The filed is required');
		} else {
			checkDuplicate(ot_empCode, ot_timeName, ot_date_request, ot_empFname, ot_empLname, ot_empDeptCode, ot_empPosition);

			// save_ot(ot_date_request, ot_empFname, ot_empLname, ot_empCode, ot_empDeptCode, ot_empPosition, ot_timeName);
		}
	});




	// $(document).on("click", ".select_otdata", function () {

	// 	var data_ot_code = $(this).attr('data_ot_code');
	// 	var data_ot_empFname = $(this).attr('data_ot_empFname');
	// 	var data_ot_empLname = $(this).attr('data_ot_empLname');
	// 	var data_ot_empCode = $(this).attr('data_ot_empCode');
	// 	var data_otdept_name = $(this).attr('data_otdept_name');
	// 	var data_ot_empPosition = $(this).attr('data_ot_empPosition');
	// 	var data_ot_timeName = $(this).attr('data_ot_timeName');
	// 	var data_ot_date_create = $(this).attr('data_ot_date_create');
	// 	var data_ot_date_request = $(this).attr('data_ot_date_request');
	// 	var data_ot_status = $(this).attr('data_ot_status');
	// 	var data_ot_userApprove = $(this).attr('data_ot_userApprove');
	// 	var data_ot_user_date_approve = $(this).attr('data_ot_user_date_approve');


	// 	$('#dtot_code').val(data_ot_code);
	// 	$('#dtot_empFname').val(data_ot_empFname);
	// 	$('#dtot_empLname').val(data_ot_empLname);
	// 	$('#dtot_empCode').val(data_ot_empCode);
	// 	$('#dtotdept_name').val(data_otdept_name);
	// 	$('#dtot_empPosition').val(data_ot_empPosition);
	// 	$('#dtot_timeName').val(data_ot_timeName);
	// 	$('#dtot_date_create').val(data_ot_date_create);
	// 	$('#dtot_date_request').val(data_ot_date_request);
	// 	$('#dtot_status').val(data_ot_status);

	// 	$('#dtot_userApprove_show').val(data_ot_userApprove);
	// 	$('#dtot_user_date_approveshow2').val(data_ot_user_date_approve);



	// 	// Event for Approve Section ###############
	// 	var checkposi = $('#checkPosi').val();
	// 	if ($('#dtot_status').val() == 'รออนุมัติ' && checkposi == 75 || checkposi == 65 || checkposi == 55 || checkposi == 45 || checkposi == 35) {

	// 		$('.hidesection').show();
	// 		$('#dtot_userApprove').css('display', '');
	// 		$('#dtot_user_date_approveshow').css('display', '');

	// 		$('#dtot_userApprove_show').css('display', 'none');
	// 		$('#dtot_user_date_approveshow2').css('display', 'none');

	// 	} else {
	// 		$('.hidesection').hide();
	// 		$('#dtot_userApprove_show').css('display', '');
	// 		$('#dtot_user_date_approveshow2').css('display', '');

	// 		$('#dtot_userApprove').css('display', 'none');
	// 		$('#dtot_user_date_approveshow').css('display', 'none');

	// 	}



	// });




	$('.resultApprove').css('display', 'none');
	$('.show_hrzone').css('display', 'none');
	$(document).on("click", ".select_otdata_group", function () {

		var data_ot_code_group = $(this).attr('data_ot_code_group');
		var data_otdept_name_group = $(this).attr('data_otdept_name_group');
		var data_ot_timeName_group = $(this).attr('data_ot_timeName_group');
		var data_ot_date_create_group = $(this).attr('data_ot_date_create_group');
		var data_ot_date_request_group = $(this).attr('data_ot_date_request_group');
		var data_ot_status_group = $(this).attr('data_ot_status_group');
		var data_ot_userApprove_group = $(this).attr('data_ot_userApprove_group');
		var data_ot_user_date_approve_group = $(this).attr('data_ot_user_date_approve_group');
		var data_ot_hrname = $(this).attr('data_ot_hrname');
		var data_ot_hrdate = $(this).attr('data_ot_hrdate');
		var data_ot_hrmemo = $(this).attr('data_ot_hrmemo');


		$('#dtot_code_group').val(data_ot_code_group);
		$('#dtotdept_name_group').val(data_otdept_name_group);
		$('#dtot_timeName_group').val(data_ot_timeName_group);
		$('#dtot_date_create_group').val(data_ot_date_create_group);
		$('#dtot_date_request_group').val(data_ot_date_request_group);
		$('#dtot_status_group').val(data_ot_status_group);

		$('#dtot_userApprove_show_group').val(data_ot_userApprove_group);
		$('#dtot_user_date_approveshow2_group').val(data_ot_user_date_approve_group);

		$('#show_userappr').val(data_ot_userApprove_group);
		$('#show_dateappr').val(data_ot_user_date_approve_group);
		$('#show_statusappr').val(data_ot_status_group);

		$('#show_hrname').val(data_ot_hrname);
		$('#show_hrdate').val(data_ot_hrdate);
		$('#show_hrmemo').val(data_ot_hrmemo);

		loaddata_list_group_detail(data_ot_code_group);



		// Event for Approve Section ###############
		var checkposi = $('#checkPosi').val();
		// CHECK APPROVE SECTION
		if ($('#dtot_status_group').val() == 'รออนุมัติ' && checkposi == 75 || checkposi == 65 || checkposi == 55 || checkposi == 45 || checkposi == 35) {

			$('.hidesection_group').show();
			$('#dtot_userApprove_group').css('display', '');
			$('#dtot_user_date_approveshow_group').css('display', '');

			$('#dtot_userApprove_show_group').css('display', 'none');
			$('#dtot_user_date_approveshow2_group').css('display', 'none');

		} else {
			$('.hidesection_group').hide();
			$('#dtot_userApprove_show_group').css('display', '');
			$('#dtot_user_date_approveshow2_group').css('display', '');

			$('#dtot_userApprove_group').css('display', 'none');
			$('#dtot_user_date_approveshow_group').css('display', 'none');

		}


		// CHECK After APPROVE SECTION
		if ($('#dtot_status_group').val() == 'อนุมัติ') {
			$('.resultApprove').css('display', '');

		} else if ($('#dtot_status_group').val() == 'ฝ่ายบุคคลรับทราบ') {
			$('.resultApprove').css('display', '');
			$('.show_hrzone').css('display', '');
		} else {
			$('.resultApprove').css('display', 'none');
			$('.show_hrzone').css('display', 'none');
		}



		// Check HR SECTION
		$('.hr_hidesection').css('display', 'none');
		if ($('#dtot_status_group').val() == 'อนุมัติ' && checkDept == 1005) {
			$('.hr_hidesection').css('display', '');
		}

	});



	// Supervisor approve
	$('#user_approve_group').on("click", function () {

		var dtot_code_group = $('#dtot_code_group').val();
		var dtot_userApprove_group = $('#dtot_userApprove_group').val();
		var dtot_user_date_approveshow_group = $('#dtot_user_date_approve_group').val();
		var dtot_result_approve_group = $('#dtot_result_approve_group').val();

		updateStatus(dtot_code_group, dtot_userApprove_group, dtot_user_date_approveshow_group, dtot_result_approve_group);
	});









	// Hr Notice
	$('#hrnotice_submit').on('click', function () {
		var othrname = $('#othrname').val();
		var hrnotice_datetime = $('#hrnotice_date').val();
		var dtot_code_group = $('#dtot_code_group').val();
		var hrnotice_memo = $('#hrnotice_memo').val();

		hrnotice(dtot_code_group, othrname, hrnotice_datetime, hrnotice_memo);
	});




	//check employee code
	$('#ot_empCode').blur(function () {
		var empCode = $(this).val();
		var re = /((^M{1})|(^D{1}))[0-9]{4}/g

		if (re.test(empCode) == false) {

			alert("กรุณาระบุรหัสพนักงานให้ถูกต้อง : M หรือ D ต้องเป็นตัวพิมพ์ใหญ่ แล้วตามด้วยตัวเลข 4 ตัว");
		}
	});


	//Fix Color for readonly fill
	$('.readonly').css('background-color', '#DDDDDD');



	// CONTROL SEARCH SECTION ##########################
	$(document).on('change', '#filterData', function () {
		if ($(this).val() == 'searchByDate') {
			$('.datesearch').css('display', '');
		} else {
			$('.datesearch').css('display', 'none');
		}


		if ($(this).val() == 'searchByDept') {
			$('.deptsearch').css('display', '');
		} else {
			$('.deptsearch').css('display', 'none');
		}


		if ($(this).val() == 'searchByName') {
			$('.namesearch').css('display', '');
		} else {
			$('.namesearch').css('display', 'none');
		}


		if ($(this).val() == 'searchByEmpCode') {
			$('.codesearch').css('display', '');
		} else {
			$('.codesearch').css('display', 'none');
		}


		if ($(this).val() == 'searchByStatus') {
			$('.statussearch').css('display', '');
		} else {
			$('.statussearch').css('display', 'none');
		}
	});
	// END ########################################


	// Event Search ##################################
	$(document).on('click', '#btn_search', function () {
		var dateStart = $('#dateStart').val();
		var dateEnd = $('#dateEnd').val();
		var filterstatus = $('#filter_status:checked').val();
		var filtertimename = $('#filter_timename:checked').val();
		var checkDept = $('#checkDept').val();

		if (dateStart != '' || dateEnd != '') {
			if (checkDept == 1005) {
				searchByDateHR(dateStart, dateEnd, filterstatus, filtertimename);
			} else {
				searchByDate(dateStart, dateEnd, checkDept, filterstatus, filtertimename);
			}
		} else {
			if (checkDept == 1005) {
				// loaddata_list_hr(filterstatus, filtertimename);
				loaddata_list_groupHR(filterstatus, filtertimename);
			} else {
				loaddata_list_group(checkDept, filterstatus, filtertimename);
			}
		}

	});


	$('#bydept').on('change', function () {
		var bydept = $('#bydept').val();
		var filterstatus = $('#filter_status:checked').val();
		var filtertimename = $('#filter_timename:checked').val();

		if (bydept != '') {
			searchByDept(bydept, filterstatus, filtertimename);
		} else {
			var checkDept = $('#checkDept').val();
			if (checkDept == 1005) {
				loaddata_list_groupHR(filterstatus, filtertimename);
			} else {
				loaddata_list_group(checkDept, filterstatus, filtertimename);
			}
		}
	});


	$('#btn_empName_search').click(function () {
		var checkDept = $('#checkDept').val();
		var filterstatus = $('#filter_status:checked').val();
		var filtertimename = $('#filter_timename:checked').val();
		var name = $('#byname').val();

		if (name != '') {
			if (checkDept == 1005) {
				searchByNameHR(name, filterstatus, filtertimename);

			} else {
				searchByName(name, checkDept, filterstatus, filtertimename);
			}
		} else {
			if (checkDept == 1005) {
				loaddata_list_groupHR(filterstatus, filtertimename);
			} else {
				loaddata_list_group(checkDept, filterstatus, filtertimename);
			}
		}
	});



	$('#btn_empcode_search').click(function () {
		var checkDept = $('#checkDept').val();
		var filterstatus = $('#filter_status:checked').val();
		var filtertimename = $('#filter_timename:checked').val();
		var empcode = $('#bycode').val();

		if (empcode != '') {
			if (checkDept == 1005) {
				searchByEmpCodeHR(empcode, filterstatus, filtertimename);
			} else {
				searchByEmpCode(empcode, checkDept, filterstatus, filtertimename);
			}
		} else {
			if (checkDept == 1005) {
				loaddata_list_groupHR(filterstatus, filtertimename);
			} else {
				loaddata_list_group(checkDept, filterstatus, filtertimename);
			}
		}
	});





	// LOAD REPORT
	if (checkDept == 1005) {
		getdatareport();
		$('input[name=report_filter_status] ,input[name=report_filter_timename] ').on('click', function () {
			var filterstatus = $('#report_filter_status:checked').val();
			var filtertime = $('#report_filter_timename:checked').val();
			getdatareport(filterstatus, filtertime);
		});
	} else {
		getdatareport_bydept(checkDept);

		$('input[name=report_filter_status] ,input[name=report_filter_timename] ').on('click', function () {
			var filterstatus = $('#report_filter_status:checked').val();
			var filtertime = $('#report_filter_timename:checked').val();
			getdatareport_bydept(checkDept, filterstatus, filtertime);

		});
	}



	$('#report_bydept').on('change', function () {
		var bydept = $('#report_bydept').val();
		var filterstatus = $('#report_filter_status:checked').val();
		var filtertime = $('#report_filter_timename:checked').val();

		if (bydept != '') {
			reportByDept(bydept, filterstatus, filtertime);
		} else {
			getdatareport(filterstatus, filtertime);
		}
	});




	$(document).on('click', '#report_btn_search', function () {
		var dateStart = $('#report_dateStart').val();
		var dateEnd = $('#report_dateEnd').val();
		var filterstatus = $('#report_filter_status:checked').val();
		var filtertime = $('#report_filter_timename:checked').val();

		if (dateStart != '' || dateEnd != '') {
			if (checkDept == 1005) {
				reportByDate(dateStart, dateEnd, filterstatus, filtertime);
			} else {
				reportByDate_focusDept(checkDept, dateStart, dateEnd, filterstatus, filtertime);
			}

		} else {
			if (checkDept == 1005) {
				getdatareport();
				$('input[name=report_filter_status] ,input[name=report_filter_timename] ').on('click', function () {
					var filterstatus = $('#report_filter_status:checked').val();
					var filtertime = $('#report_filter_timename:checked').val();
					getdatareport(filterstatus, filtertime);
				});
			} else {
				getdatareport_bydept(checkDept);
				$('input[name=report_filter_status] ,input[name=report_filter_timename] ').on('click', function () {
					var filterstatus = $('#report_filter_status:checked').val();
					var filtertime = $('#report_filter_timename:checked').val();
					getdatareport_bydept(checkDept, filterstatus, filtertime);
				});
			}
		}

	});



	$('#removeEmp').click(function () {
		var removeEmp = $(this).attr('data_emp_code');
		var removeFname = $(this).attr('data_emp_Fname');
		var removeLname = $(this).attr('data_emp_Lname');

		$('#removeEmpCode').val(removeEmp);
		$('#removeFname').val(removeFname);
		$('#removeLname').val(removeLname);

	});



	$('#alertFlash').fadeOut(3000);

	


	// Check Empty filed
	
$('#user_approve_group').prop('disabled' , true);
$('#dtot_result_approve_group').on('change' , function(){
	if($(this).val() != ''){
		$('#user_approve_group').prop('disabled' , false);
	}else{
		$('#user_approve_group').prop('disabled' , true);
	}
});






	









});

