<?php
class Main extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('addot_model');
		$this->load->model('getot_model');

		$this->load->model("report_model");
        $this->load->library("pagination");
	}



	public function index()
	{
		call_login();
		getHead();
		getContent('dashboard');
		getFooter();
	}

	public function listot()
	{
		call_login();
		getHead();
		getContent('list_ot');
		getFooter();
	}


	public function getlistot()
	{
		call_login();
		$queryByDept = '';
		$filterstatus = '';
		$filtertimename = '';
		if ($this->input->post('queryByDept')) {
			$queryByDept = $this->input->post('queryByDept');
			$filterstatus = $this->input->post('filterstatus');
			$filtertimename = $this->input->post('filtertimename');

			$data['rs'] = getOtList($queryByDept, $filterstatus, $filtertimename);
			$this->load->view('result_listot', $data);
		}
	}


	public function getlistot_group()
	{
		call_login();
		$queryByDept = '';
		$filterstatus = '';
		$filtertimename = '';
		if ($this->input->post('queryByDept')) {
			$queryByDept = $this->input->post('queryByDept');
			$filterstatus = $this->input->post('filterstatus');
			$filtertimename = $this->input->post('filtertimename');

			$data['rs'] = getOtList_group($queryByDept, $filterstatus, $filtertimename);
			$this->load->view('result_listot_group', $data);
		}
	}


	public function getlistot_groupHR()
	{
		call_login();

		$filterstatus = '';
		$filtertimename = '';

		$filterstatus = $this->input->post('filterstatus');
		$filtertimename = $this->input->post('filtertimename');

		$data['rs'] = getOtList_groupHR($filterstatus, $filtertimename);
		$this->load->view('result_listot_group', $data);
	}


	public function getlistot_group_detail()
	{
		call_login();
		$otcoderequest = '';
		if ($this->input->post('otcoderequest')) {
			$otcoderequest = $this->input->post('otcoderequest');

			$data['rs'] = getOtList_group_detail($otcoderequest);
			$this->load->view('result_listot_group_detail', $data);
		}
	}


	public function getlistothr()
	{
		call_login();
		$filterstatus = '';
		$filtertimename = '';
		$filterstatus = $this->input->post('filterstatus');
		$filtertimename = $this->input->post('filtertimename');

		$data['rs'] = getOtListHR($filterstatus, $filtertimename);
		$this->load->view('result_listot', $data);
	}



	// Controller For Search Function
	public function searchByDateHR()
	{
		$datestart = '';
		$dateend = '';
		$filterstatus = '';
		$filtertimename = '';

		if ($this->input->post('datestart')) {
			$datestart = $this->input->post('datestart');
			$condatestart = date("Y-m-d" , strtotime($datestart));
			$dateend = $this->input->post('dateend');
			$condateend = date("Y-m-d" , strtotime($dateend));
			$filterstatus = $this->input->post('filterstatus');
			$filtertimename = $this->input->post('filtertimename');

			$data['rs'] = getOtListHR_byDateHR($condatestart, $condateend, $filterstatus, $filtertimename);
			$this->load->view('result_listot_group', $data);
		}
	}

	public function searchByDate()
	{
		$datestart = '';
		$dateend = '';
		$deptcode = '';
		$filterstatus = '';
		$filtertimename = '';

		if ($this->input->post('datestart')) {
			$datestart = $this->input->post('datestart');
			$condatestart = date("Y-m-d" , strtotime($datestart));
			$dateend = $this->input->post('dateend');
			$condateend = date("Y-m-d" , strtotime($dateend));
			$deptcode = $this->input->post('deptcode');
			$filterstatus = $this->input->post('filterstatus');
			$filtertimename = $this->input->post('filtertimename');

			$data['rs'] = getOtListHR_byDate($condatestart, $condateend, $deptcode, $filterstatus, $filtertimename);
			$this->load->view('result_listot_group', $data);
		}
	}


	public function searchByDept()
	{
		$deptcode = '';
		$filterstatus = '';
		$filtertimename = '';
		if ($this->input->post('dept')) {
			$deptcode = $this->input->post('dept');
			$filterstatus = $this->input->post('filterstatus');
			$filtertimename = $this->input->post('filtertimename');

			$data['rs'] = getOtListHR_byDept($deptcode, $filterstatus, $filtertimename);
			$this->load->view('result_listot_group', $data);
		}
	}

	public function searchByNameHR()
	{
		$name = '';
		$filterstatus = '';
		$filtertimename = '';

		if ($this->input->post('name')) {
			$name = $this->input->post('name');
			$filterstatus = $this->input->post('filterstatus');
			$filtertimename = $this->input->post('filtertimename');

			$data['rs'] = getOtListHR_byNameHR($name, $filterstatus, $filtertimename);
			$this->load->view('result_listot_group', $data);
		}
	}

	public function searchByName()
	{
		$name = '';
		$deptcode = '';
		$filterstatus = '';
		$filtertimename = '';
		if ($this->input->post('name')) {
			$name = $this->input->post('name');
			$deptcode = $this->input->post('deptcode');
			$filterstatus = $this->input->post('filterstatus');
			$filtertimename = $this->input->post('filtertimename');

			$data['rs'] = getOtListHR_byName($name, $deptcode, $filterstatus, $filtertimename);
			$this->load->view('result_listot_group', $data);
		}
	}


	public function searchByEmpCode()
	{
		$empcode = '';
		$deptcode = '';
		$filterstatus = '';
		$filtertimename = '';
		if ($this->input->post('empcode')) {
			$empcode = $this->input->post('empcode');
			$deptcode = $this->input->post('deptcode');
			$filterstatus = $this->input->post('filterstatus');
			$filtertimename = $this->input->post('filtertimename');

			$data['rs'] = getOtListHR_byEmpCode($empcode, $deptcode, $filterstatus, $filtertimename);
			$this->load->view('result_listot_group', $data);
		}
	}

	public function searchByEmpCodeHR()
	{
		$empcode = '';
		$filterstatus = '';
		$filtertimename = '';
		if ($this->input->post('empcode')) {
			$empcode = $this->input->post('empcode');
			$filterstatus = $this->input->post('filterstatus');
			$filtertimename = $this->input->post('filtertimename');

			$data['rs'] = getOtListHR_byEmpCodeHR($empcode, $filterstatus, $filtertimename);
			$this->load->view('result_listot_group', $data);
		}
	}


	// Zone Ajax Query Data #############








	public function createotsmorning()
	{
		call_login();
		getContent('create_otsmorning_new');
	}

	public function createotsevening()
	{
		call_login();
		getContent('create_otsevening');
	}


	public function createot()
	{
		call_login();
		getHead();
		getContent('create_ot');
	}

	// save ot
	public function saveot()
	{
		call_login();
		$this->addot_model->save_ot();
	}

	public function checkDuplicate()
	{
		$otempcodes = $this->input->post('ot_empCode');
		$ot_emptimename = $this->input->post('ot_timeName');
		$ot_date_request = $this->input->post('ot_date_request');

		$checkdata = checkDuplicate($otempcodes, $ot_emptimename, $ot_date_request);

		echo $checkdata;
	}



	public function saveot2()
	{
		call_login();
		$ot_code = getotnumber();
		$ot_date_request = $_POST['ot_date_request'];
		$ot_empDeptCode = $_POST['ot_empDeptCode'];
		$ot_emptimename = $_POST['ot_emptimename'];

		$reportDate = date_create($_POST['ot_date_request']);
		$reportConDate = date_format($reportDate, "d");

		$reportMonth = date_create($_POST['ot_date_request']);
		$reportConMonth = date_format($reportMonth, "m");

		$reportYear = date_create($_POST['ot_date_request']);
		$reportConYear = date_format($reportYear, "Y");

		for ($count = 0; $count < count($_POST['ot_empCode']); $count++) {



			$ar_saveot = array(
				'ot_date_request' => $ot_date_request,
				'ot_empFname' => $_POST['ot_empFname'][$count],
				'ot_empLname' => $_POST['ot_empLname'][$count],
				'ot_empCode' => $_POST['ot_empCode'][$count],
				'ot_empDeptCode' => $ot_empDeptCode,
				'ot_empPosition' => $_POST['ot_empPosition'][$count],
				'ot_timeName' => $ot_emptimename,
				"ot_date_create" => date("Y/m/d H:i:s"),
				"ot_report_date" => $reportConDate,
				"ot_report_month" => $reportConMonth,
				"ot_report_year" => $reportConYear,
				"ot_code" => $ot_code,
				"ot_status" => "รออนุมัติ"

			);
			$this->db->insert("otonline_main", $ar_saveot);
		}
		echo "<script>";
		echo "window.close()";
		echo "</script>";
	}



	public function approvestatus()
	{
		$dtot_code_group = '';
		$dtot_userApprove_group = '';
		$dtot_user_date_approveshow_group = '';
		$dtot_result_approve_group = '';
		if ($this->input->post('dtot_code_group')) {
			$dtot_code_group = $this->input->post('dtot_code_group');
			$dtot_userApprove_group = $this->input->post('dtot_userApprove_group');
			$dtot_user_date_approveshow_group = $this->input->post('dtot_user_date_approveshow_group');
			$dtot_result_approve_group = $this->input->post('dtot_result_approve_group');
			updateStatus($dtot_code_group, $dtot_userApprove_group, $dtot_user_date_approveshow_group, $dtot_result_approve_group);
		}
	}


	public function hrnotice()
	{
		$dtotcode = '';
		$othrname = '';
		$hrnoticedatetime = '';
		$hrnotice_memo = '';
		if ($this->input->post('dtotcode')) {

			$dtotcode = $this->input->post('dtotcode');
			$othrname = $this->input->post('othrname');
			$hrnoticedatetime = $this->input->post('hrnoticedatetime');
			$hrnotice_memo = $this->input->post('hrnotice_memo');

			hrnoticeStatus($dtotcode, $othrname, $hrnoticedatetime ,$hrnotice_memo);
		}
	}




	// REPORT ZONE #################################
	################################################
	################################################
	// REPORT ZONE #################################
	################################################
	################################################
	// REPORT ZONE #################################
	################################################
	################################################
	public function report()
	{
		call_login();
		getHead();
		$this->load->view('report');
		getFooter();
	}




	public function getdatareport()
	{
		$filterstatus = '';
		$filtertime = '';
		$filterstatus = $this->input->post('filterstatus');
		$filtertime = $this->input->post('filtertime');

		$data['rs'] = getDataReport($filterstatus, $filtertime);
		$this->load->view('result_report', $data);


		// 	$data = array();

		// 	$query = $this->db->query("SELECT
		// ot_id,
		// ot_code,
		// ot_empFname,
		// ot_empLname,
		// ot_empCode,
		// ot_empDeptCode,
		// ot_empPosition,
		// ot_timeName,
		// ot_date_create,
		// ot_date_request,
		// ot_userApprove,
		// ot_status,
		// ot_userApprove,
		// ot_user_date_approve,
		// ot_hrnotice_name,
		// ot_hrnotice_datetime,
		// otonline_deptcat.otdept_name
		// FROM otonline_main
		// INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
		// ORDER BY ot_id DESC LIMIT 1000
		// ");

		// foreach($query->result_array() as $row){
		// 	$data[] = array(
		// 		$row['ot_code'],
		// 		$row['ot_empFname'],
		// 		$row['ot_empCode'],
		// 		$row['ot_empPosition'],
		// 		$row['otdept_name'],
		// 		$row['ot_timeName'],
		// 		$row['ot_date_create'],
		// 		$row['ot_date_request'],
		// 		$row['ot_status'],
		// 		$row['ot_userApprove'],
		// 		$row['ot_user_date_approve'],
		// 		$row['ot_hrnotice_name'],
		// 		$row['ot_hrnotice_datetime'],
		// 	);
		// 	$output = array(
		// 		"data" => $data
		// 	);
		// }

		// echo json_encode($output);


	}





	public function getdatareport_bydept()
	{
		$filterstatus = '';
		$filtertime = '';
		$dept = '';
		$filterstatus = $this->input->post('filterstatus');
		$filtertime = $this->input->post('filtertime');
		$dept = $this->input->post('dept');

		$data['rs'] = getDataReport_bydept($dept, $filterstatus, $filtertime);
		$this->load->view('result_report', $data);
	}

	public function reportByDept()
	{
		$deptcode = '';
		$filterstatus = '';
		$filtertime = '';
		if ($this->input->post('dept')) {
			$deptcode = $this->input->post('dept');
			$filterstatus = $this->input->post('filterstatus');
			$filtertime = $this->input->post('filtertime');
			$data['rs'] = getDataReport_byDept($deptcode, $filterstatus, $filtertime);
			$this->load->view('result_report', $data);
		}
	}

	public function reportByDate()
	{
		$datestart = '';
		$dateend = '';
		$filterstatus = '';
		$filtertime = '';

		if ($this->input->post('datestart')) {
			$datestart = $this->input->post('datestart');
			$dateend = $this->input->post('dateend');
			$filterstatus = $this->input->post('filterstatus');
			$filtertime = $this->input->post('filtertime');
			$data['rs'] = getDataReport_byDate($datestart, $dateend, $filterstatus, $filtertime);
			$this->load->view('result_report', $data);
		}
	}

	public function reportByDate_focusDept()
	{
		$dept = '';
		$datestart = '';
		$dateend = '';
		$filterstatus = '';
		$filtertime = '';

		if ($this->input->post('datestart')) {
			$dept = $this->input->post('dept');
			$datestart = $this->input->post('datestart');
			$dateend = $this->input->post('dateend');
			$filterstatus = $this->input->post('filterstatus');
			$filtertime = $this->input->post('filtertime');

			$data['rs'] = getDataReport_byDate_focusDept($dept, $datestart, $dateend, $filterstatus, $filtertime);
			$this->load->view('result_report', $data);
		}
	}
	// REPORT ZONE #################################
	################################################
	################################################
	// REPORT ZONE #################################
	################################################
	################################################
	// REPORT ZONE #################################
	################################################
	################################################






	public function testcode()
	{
		$date = '14-02-2020';

		echo date("Y-m-d" , strtotime($date));
	}







	public function getreportJson($dept)
	{
		$data = array();

		$query = $this->db->query("SELECT
    ot_id,
    ot_code,
    ot_empFname,
    ot_empLname,
    ot_empCode,
    ot_empDeptCode,
    ot_empPosition,
    ot_timeName,
    ot_date_create,
    ot_date_request,
    ot_userApprove,
    ot_status,
    ot_userApprove,
    ot_user_date_approve,
    ot_hrnotice_name,
    ot_hrnotice_datetime,
    otonline_deptcat.otdept_name
    FROM otonline_main
    INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
	WHERE ot_empDeptCode = '$dept'
    ORDER BY ot_id DESC LIMIT 200
	");

		foreach ($query->result_array() as $row) {
			$data[] = array(
				$row['ot_code'],
				$row['ot_empFname'],
				$row['ot_empCode'],
				$row['ot_empPosition'],
				$row['otdept_name'],
				$row['ot_timeName'],
				$row['ot_date_create'],
				$row['ot_date_request'],
				$row['ot_status'],
				$row['ot_userApprove'],
				$row['ot_user_date_approve'],
				$row['ot_hrnotice_name'],
				$row['ot_hrnotice_datetime'],
			);
			$output = array(
				"data" => $data
			);
		}

		echo json_encode($output);
	}









	public function getreportJsonFilter()
	{

		$dept = '';
		$report_filter_status = '';
		$report_filter_timename= '';

		$dept = $this->input->post('dept');
		$report_filter_status = $this->input->post('report_filter_status');
		$report_filter_timename = $this->input->post('report_filter_timename');


		$data = array();

		$query = $this->db->query("SELECT
    ot_id,
    ot_code,
    ot_empFname,
    ot_empLname,
    ot_empCode,
    ot_empDeptCode,
    ot_empPosition,
    ot_timeName,
    ot_date_create,
    ot_date_request,
    ot_userApprove,
    ot_status,
    ot_userApprove,
    ot_user_date_approve,
    ot_hrnotice_name,
    ot_hrnotice_datetime,
    otonline_deptcat.otdept_name
    FROM otonline_main
    INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
	WHERE ot_empDeptCode = '$dept' and ot_status like '$report_filter_status%' and ot_timeName like '%$report_filter_timename'
    ORDER BY ot_id DESC
	");

		foreach ($query->result_array() as $row) {
			$data[] = array(
				$row['ot_code'],
				$row['ot_empFname'],
				$row['ot_empCode'],
				$row['ot_empPosition'],
				$row['otdept_name'],
				$row['ot_timeName'],
				$row['ot_date_create'],
				$row['ot_date_request'],
				$row['ot_status'],
				$row['ot_userApprove'],
				$row['ot_user_date_approve'],
				$row['ot_hrnotice_name'],
				$row['ot_hrnotice_datetime'],
			);
			$output = array(
				"data" => $data
			);
		}

		echo json_encode($output);
	}







	// public function getreportJsonFilterHR()
	// {

	// 	$report_filter_status = '';
	// 	$report_filter_timename= '';

	// 	$report_filter_status = $this->input->post('report_filter_status');
	// 	$report_filter_timename = $this->input->post('report_filter_timename');


	// 	$data = array();

	// 	$query = $this->db->query("SELECT
    // ot_id,
    // ot_code,
    // ot_empFname,
    // ot_empLname,
    // ot_empCode,
    // ot_empDeptCode,
    // ot_empPosition,
    // ot_timeName,
    // ot_date_create,
    // ot_date_request,
    // ot_userApprove,
    // ot_status,
    // ot_userApprove,
    // ot_user_date_approve,
    // ot_hrnotice_name,
    // ot_hrnotice_datetime,
    // otonline_deptcat.otdept_name
    // FROM otonline_main
    // INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
	// WHERE ot_status like '$report_filter_status%' and ot_timeName like '%$report_filter_timename'
    // ORDER BY ot_id DESC
	// ");

	// 	foreach ($query->result_array() as $row) {
	// 		$data[] = array(
	// 			$row['ot_code'],
	// 			$row['ot_empFname'],
	// 			$row['ot_empCode'],
	// 			$row['ot_empPosition'],
	// 			$row['otdept_name'],
	// 			$row['ot_timeName'],
	// 			$row['ot_date_create'],
	// 			$row['ot_date_request'],
	// 			$row['ot_status'],
	// 			$row['ot_userApprove'],
	// 			$row['ot_user_date_approve'],
	// 			$row['ot_hrnotice_name'],
	// 			$row['ot_hrnotice_datetime'],
	// 		);
	// 		$output = array(
	// 			"data" => $data
	// 		);
	// 	}

	// 	echo json_encode($output);
	// }



// CHART ZONE ###############################################
############################################################
public function loadchart()
{
	$this->load->view('chart/chart_ot_total');
}

public function loadchart_by_month($monthname)
{
	$data['rs'] = chartByMonth($monthname);
	getContentData('chart/chart_ot_by_month',$data);
}

public function loadChartPercent(){
	getContent('chart/chart_pie_percent');
}

public function loadChartYearPercent()
{
	getContent('chart/chart_pie_year_percent');
}

// CHART ZONE ###############################################
############################################################



public function activeot()
{
	$ot_empCode = '';
	$ot_empCode = $this->input->post('ot_empCode');
	activeOT($ot_empCode);

}

public function loadactiveot()
{

	$deptcode = '';
	$deptcode = $this->input->post('deptcode');

	$data['rs'] = loadactiveot($deptcode);
	$this->load->view('result_requestot' , $data);
}

public function saveot2newMorning()
{
	call_login();
	$this->addot_model->saveot2NewMorning();
}

public function saveot2newEvening()
{
	call_login();
	$this->addot_model->saveot2newEvening();
}

public function openotgroupMorning()
{
	getHead();
	getContent('create_otsmorning_new');
	getFooter();
}

public function openotgroupEvening()
{
	getHead();
	getContent('create_otsevening_new');
	getFooter();
}


public function removeEmpData($ot_empCode)
{
	activeOT($ot_empCode);
	header("refresh:0; url=".base_url('main/openotgroupMorning'));
}

























}
// End of Controller
