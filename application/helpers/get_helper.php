<?php
class getfn
{
    public $ci;
    function __construct()
    {
        $this->ci = &get_instance();
        date_default_timezone_set("Asia/Bangkok");
    }

    public function getci()
    {
        return $this->ci;
    }
}




// Get standard
function getHead()
{
    $obj = new getfn();
    $obj->getci()->load->view('template/head');
}
function getFooter()
{
    $obj = new getfn();
    $obj->getci()->load->view('template/footer');
}
function getContent($content)
{
    $obj = new getfn();
    $obj->getci()->load->view($content);
}
function getContentData($content , $data)
{
    $obj = new getfn();
    $obj->getci()->load->view($content,$data);
}
function getModal()
{
    $obj = new getfn();
    $obj->getci()->load->view('template/modal');
}
function conDate($dateori)
{
    $dateuse = date_create($dateori);
    $dateCon = date_format($dateuse, "d-m-Y");
    return $dateCon;
}
function conDateTime($datetime)
{
    $dateuse = date_create($datetime);
    $dateCon = date_format($dateuse, "d-m-Y H:i:s");
    return $dateCon;
}


// Generate auto number
function getotnumber()
{
    $obj = new getfn();

    $otlabel = 'OT';
    $year = substr(date("Y"), 2, 2);
    $number = '00001';

    $getOtNumber = $obj->getci()->db->query("SELECT ot_code FROM otonline_main WHERE ot_code !='' ORDER BY ot_code DESC LIMIT 1 ");
    if ($getOtNumber->num_rows() == 0) {
        $otNumber = $otlabel . $year . $number;
        return $otNumber;
    } else {
        $checkRealYear = $getOtNumber->row()->ot_code;
        $cutCheckRealYear = substr($checkRealYear, 2, 2);
        $nowyear = substr(date("Y"), 2, 2);

        if ($cutCheckRealYear != $nowyear) {
            $otNumber = $otlabel . $year . $number;
            return $otNumber;
        } else {
            $otNumber = $checkRealYear;
            $otNumber++;
            return $otNumber;
        }
    }
}





// Get Department into form
function getDeptCat()
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT * FROM otonline_deptcat  ORDER BY otdept_name ASC");
}


// Get ot list
function getOtList($queryByDept, $filterstatus, $filtertimename)
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT
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
    otonline_deptcat.otdept_name
    FROM otonline_main
    INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
    WHERE ot_empDeptCode = '$queryByDept' and ot_status like '$filterstatus%' and ot_timeName like '%$filtertimename'
    ORDER BY ot_id DESC LIMIT 500
    ");
}



function getOtList_group($queryByDept, $filterstatus, $filtertimename)
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT
    ot_id,
    ot_code,
    ot_empDeptCode,
    ot_timeName,
    ot_date_create,
    ot_date_request,
    ot_userApprove,
    ot_status,
    ot_user_date_approve,
    ot_hrnotice_name,
    ot_hrnotice_datetime,
    ot_hrnotice_memo,
    otonline_deptcat.otdept_name
    FROM otonline_main
    INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
    WHERE ot_empDeptCode in ($queryByDept) and ot_status like '$filterstatus%' and ot_timeName like '%$filtertimename'
    GROUP BY ot_code
    ORDER BY ot_id DESC LIMIT 500
    ");
}


function getOtList_groupHR($filterstatus, $filtertimename)
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT
    ot_id,
    ot_code,
    ot_empDeptCode,
    ot_timeName,
    ot_date_create,
    ot_date_request,
    ot_userApprove,
    ot_status,
    ot_user_date_approve,
    ot_hrnotice_name,
    ot_hrnotice_datetime,
    ot_hrnotice_memo,
    otonline_deptcat.otdept_name
    FROM otonline_main
    INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
    WHERE ot_status like '$filterstatus%' and ot_timeName like '%$filtertimename'
    GROUP BY ot_code
    ORDER BY ot_id DESC LIMIT 500
    ");
}



function getOtList_group_detail($otcoderequest)
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT
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
    ot_hrnotice_memo,
    otonline_deptcat.otdept_name
    FROM otonline_main
    INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
    WHERE ot_code = '$otcoderequest'
    ORDER BY ot_id DESC LIMIT 500
    ");
}




function getOtListHR($filterstatus, $filtertimename)
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT
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
    ot_hrnotice_memo,
    otonline_deptcat.otdept_name
    FROM otonline_main
    INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
    WHERE ot_status like '$filterstatus%' and ot_timeName like '%$filtertimename'
    ORDER BY ot_id DESC LIMIT 500
    ");
}




//Search Query 
function getOtListHR_byDateHR($datestart, $dateend, $filterstatus, $filtertimename)
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT
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
    ot_hrnotice_memo,
    otonline_deptcat.otdept_name
    FROM otonline_main
    INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
    WHERE ot_date_request between '$datestart' and '$dateend' and ot_status like '$filterstatus%' and ot_timeName like '%$filtertimename'
    GROUP BY ot_code
    ORDER BY ot_id DESC LIMIT 500
    ");
}
function getOtListHR_byDate($datestart, $dateend, $deptcode, $filterstatus, $filtertimename)
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT
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
    ot_hrnotice_memo,
    otonline_deptcat.otdept_name
    FROM otonline_main
    INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
    WHERE ot_date_request between '$datestart' and '$dateend' and ot_empDeptCode = '$deptcode' and ot_status like '$filterstatus%' and ot_timeName like '%$filtertimename'
    GROUP BY ot_code
    ORDER BY ot_id DESC LIMIT 500
    ");
}

function getOtListHR_byDept($deptcode, $filterstatus, $filtertimename)
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT
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
    ot_hrnotice_memo,
    otonline_deptcat.otdept_name
    FROM otonline_main
    INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
    WHERE ot_empDeptCode = '$deptcode' and ot_status like '$filterstatus%' and ot_timeName like '%$filtertimename'
    GROUP BY ot_code
    ORDER BY ot_id DESC LIMIT 500
    ");
}


function getOtListHR_byNameHR($name, $filterstatus, $filtertimename)
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT
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
    ot_hrnotice_memo,
    otonline_deptcat.otdept_name
    FROM otonline_main
    INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
    WHERE ot_empFname like '%$name%' and ot_status like '$filterstatus%' and ot_timeName like '%$filtertimename'
    GROUP BY ot_code
    ORDER BY ot_id DESC LIMIT 500
    ");
}


function getOtListHR_byName($name, $deptcode, $filterstatus, $filtertimename)
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT
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
    ot_hrnotice_memo,
    otonline_deptcat.otdept_name
    FROM otonline_main
    INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
    WHERE ot_empFname like '%$name%' and ot_empDeptCode = '$deptcode' and ot_status like '$filterstatus%' and ot_timeName like '%$filtertimename'
    GROUP BY ot_code
    ORDER BY ot_id DESC LIMIT 500
    ");
}


function getOtListHR_byEmpCode($empcode, $deptcode, $filterstatus, $filtertimename)
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT
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
    ot_hrnotice_memo,
    otonline_deptcat.otdept_name
    FROM otonline_main
    INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
    WHERE ot_empCode like '$empcode%' and ot_empDeptCode = '$deptcode' and ot_status like '$filterstatus%' and ot_timeName like '%$filtertimename'
    GROUP BY ot_code
    ORDER BY ot_id DESC LIMIT 500
    ");
}

function getOtListHR_byEmpCodeHR($empcode, $filterstatus, $filtertimename)
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT
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
    ot_hrnotice_memo,
    otonline_deptcat.otdept_name
    FROM otonline_main
    INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
    WHERE ot_empCode like '$empcode%' and ot_status like '$filterstatus%' and ot_timeName like '%$filtertimename'
    GROUP BY ot_code
    ORDER BY ot_id DESC LIMIT 500
    ");
}


//Search Query 








function checkEmpDetail($empCode)
{
    $obj = new getfn();
    $query = $obj->getci()->db->query("SELECT emp_ecode FROM employee_detail WHERE emp_ecode= '$empCode' ");
    if ($query->num_rows() <= 0) {

        $ar_addEmpDetail = array(
            "emp_Fname" => $obj->getci()->input->post("ot_empFname"),
            "emp_Lname" => $obj->getci()->input->post("ot_empLname"),
            "emp_ecode" => $obj->getci()->input->post("ot_empCode"),
            "emp_DeptCode" => $obj->getci()->input->post("ot_empDeptCode")
        );

        $obj->getci()->db->insert("employee_detail", $ar_addEmpDetail);
    }
}




function loginlog($username)
{
    $obj = new getfn();
    // insert login log
    $logindata = array(
        "otlog_loginusername" => $username,
        "otlog_logindatetime" => date("Y-m-d H:i:s"),
        "otlog_loginstatus" => "login",
        "otlog_browser" => $obj->getci()->agent->browser(),
        "otlog_browser_version" => $obj->getci()->agent->version(),
        "otlog_ip" => $obj->getci()->input->ip_address(),
        "otlog_os" => $obj->getci()->agent->platform()
    );
    $obj->getci()->db->insert("otonline_loginlog", $logindata);
}


function getUser()
{
    $obj = new getfn();
    $obj->getci()->load->model('login/login_model');
    return $obj->getci()->login_model->getuser();
}


function call_login()
{
    $obj = new getfn();
    $obj->getci()->load->model('login/login_model');
    return $obj->getci()->login_model->call_login();
}







// REPORT ZONE
function getDataReport($filterstatus, $filtertime)
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT
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
    ot_hrnotice_name,
    ot_hrnotice_datetime,
    ot_hrnotice_memo,
    otonline_deptcat.otdept_name
    FROM otonline_main
    INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
    WHERE ot_status like '$filterstatus%' and ot_timeName like '%$filtertime'
    ORDER BY ot_id DESC LIMIT 1000
    ");
}

// function getDataReportDept($dept,$filterstatus,$filtertime)
// {
//     $obj = new getfn();
//     return $obj->getci()->db->query("SELECT
//     ot_id,
//     ot_code,
//     ot_empFname,
//     ot_empLname,
//     ot_empCode,
//     ot_empDeptCode,
//     ot_empPosition,
//     ot_timeName,
//     ot_date_create,
//     ot_date_request,
//     ot_userApprove,
//     ot_status,
//     ot_userApprove,
//     ot_user_date_approve,
//     otonline_deptcat.otdept_name
//     FROM otonline_main
//     INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
//     WHERE ot_empDeptCode = '$dept' ot_status like '$filterstatus%' and ot_timeName like '%$filtertime'
//     ORDER BY ot_id DESC
//     ");
// }



function getDataReport_byDept($deptcode, $filterstatus, $filtertime)
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT
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
    ot_hrnotice_name,
    ot_hrnotice_datetime,
    ot_hrnotice_memo,
    otonline_deptcat.otdept_name
    FROM otonline_main
    INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
    WHERE ot_empDeptCode = '$deptcode' and ot_status like '$filterstatus%' and ot_timeName like '%$filtertime'
    ORDER BY ot_id DESC LIMIT 1000
    ");
}


function getDataReport_byDate($datestart, $dateend, $filterstatus, $filtertime)
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT
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
    ot_hrnotice_name,
    ot_hrnotice_datetime,
    ot_hrnotice_memo,
    otonline_deptcat.otdept_name
    FROM otonline_main
    INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
    WHERE ot_date_request between '$datestart' and '$dateend' and ot_status like '$filterstatus%' and ot_timeName like '%$filtertime'
    ORDER BY ot_id DESC LIMIT 1000
    ");
}


function getDataReport_byDate_focusDept($dept, $datestart, $dateend, $filterstatus, $filtertime)
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT
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
    ot_hrnotice_name,
    ot_hrnotice_datetime,
    ot_hrnotice_memo,
    otonline_deptcat.otdept_name
    FROM otonline_main
    INNER JOIN otonline_deptcat on otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode
    WHERE ot_empDeptCode = '$dept' and ot_date_request between '$datestart' and '$dateend' and ot_status like '$filterstatus%' and ot_timeName like '%$filtertime'
    ORDER BY ot_id DESC LIMIT 1000
    ");
}



//get data form employee table for add ot group
function getEmployeeList($deptcode)
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT
    orgcode,
    emcode,
    titlee,
    fnamee,
    lnamee,
    titlet,
    fnamet,
    lnamet,
    positionname,
    ot_active,
    employee.DeptCode,
    deptlist.deptnamet,
    deptlist.deptname
    from employee
    inner join deptlist on employee.DeptCode = deptlist.DeptCode
    WHERE employee.DeptCode in ($deptcode) ");
}


function getEmployeeByEcode($ecode)
{
    $obj = new getfn();
    return $obj->getci()->db->query("SELECT
    orgcode,
    emcode,
    titlee,
    fnamee,
    lnamee,
    titlet,
    fnamet,
    lnamet,
    positionname,
    employee.DeptCode,
    deptlist.deptnamet,
    deptlist.deptname
    from employee
    inner join deptlist on employee.DeptCode = deptlist.DeptCode
    WHERE emcode = '$ecode' ");
}





// CHART ZONE ######################################
####################################################
####################################################

function chartCountPerMonth()
{
    $obj = new getfn();
    $query = $obj->getci()->db->query("SELECT
    otchart_month_num,
    otchart_month_name,
	otchart_month_nameTH,
    otchart_month_name_short,
    ot_code,
    count(ot_code)as count_per_month,
    count(ot_code) * 2 as total_time
    from otonline_chart a
    left join (select * from otonline_main where ot_status in ('อนุมัติ' , 'ฝ่ายบุคคลรับทราบ'))b
    on a.otchart_month_num = b.ot_report_month
    group by otchart_month_num
    order by otchart_month_num asc");
    return $query;
}


function chartByMonth($monthname)
{
    $obj = new getfn();
    $query = $obj->getci()->db->query("SELECT
    otchart_month_num,
    otchart_month_name,
    otchart_month_nameTH,
    otchart_month_name_short,
    ot_code,
	ot_empDeptCode,
	otdept_name,
	count(ot_empDeptCode)as count_by_dept
    from otonline_chart a
    left join (select * from otonline_main where ot_status in ('อนุมัติ' , 'ฝ่ายบุคคลรับทราบ'))b
    on a.otchart_month_num = b.ot_report_month
		left join otonline_deptcat c on c.otdept_code = b.ot_empDeptCode
		where otchart_month_name_short = '$monthname'
		group by ot_empDeptCode asc
    order by otchart_month_num asc");
    return $query;
}


function chartPercent()
{
    $obj = new getfn();
    $query = $obj->getci()->db->query("SELECT
    otchart_month_num,
    otchart_month_name,
    otchart_month_nameTH,
    otchart_month_name_short,
    ot_code,
		ot_empDeptCode,
		otdept_name,
		count(ot_empDeptCode)as count_by_dept
    from otonline_chart a
    left join (select * from otonline_main where ot_status in ('อนุมัติ' , 'ฝ่ายบุคคลรับทราบ'))b
    on a.otchart_month_num = b.ot_report_month
		inner join otonline_deptcat c on c.otdept_code = b.ot_empDeptCode
		group by ot_empDeptCode asc
    order by otchart_month_num asc");
    return $query;
}


// CHART ZONE ######################################
####################################################
####################################################





function loadactiveot($deptcode)
{
    $obj = new getfn();

    $query = $obj->getci()->db->query("SELECT * 
    FROM employee a
    inner join deptlist b on a.DeptCode = b.DeptCode
    where ot_active = 1 and a.DeptCode in ($deptcode) ");
    return $query;
}



// Check Duplicate Data OT
function checkDuplicate($ot_empCode,$ot_timeName,$ot_date_request)
{
    $obj = new getfn();
    $queryForCheck = $obj->getci()->db->query("SELECT
    ot_empCode,
    ot_timeName,
    ot_date_request
    FROM otonline_main
    WHERE ot_empCode = '$ot_empCode' and ot_timeName = '$ot_timeName' and ot_date_request = '$ot_date_request'
    ");
    return $queryForCheck->num_rows();
}



// Get data To Email
function getDataToEmail($otcode)
{
    $obj = new getfn();
    $query = $obj->getci()->db->query("SELECT
    ot_id , ot_code , ot_empFname , ot_empLname , ot_empCode , ot_empDeptCode , ot_empPosition , ot_timeName , 
    ot_date_create , ot_date_request , ot_userApprove , ot_user_date_approve , ot_report_date , ot_report_month ,
    ot_report_year , ot_status , ot_hrnotice_name , ot_hrnotice_datetime , ot_hrnotice_memo , otdept_name
    FROM otonline_main a
    INNER JOIN otonline_deptcat b ON a.ot_empDeptCode = b.otdept_code
    WHERE ot_code = '$otcode'
    ");
    return $query->row();
}
function getDataToEmailGroup($otcode)
{
    $obj = new getfn();
    $query = $obj->getci()->db->query("SELECT
    ot_id , ot_code , ot_empFname , ot_empLname , ot_empCode , ot_empDeptCode , ot_empPosition , ot_timeName , 
    ot_date_create , ot_date_request , ot_userApprove , ot_user_date_approve , ot_report_date , ot_report_month ,
    ot_report_year , ot_status , ot_hrnotice_name , ot_hrnotice_datetime , ot_hrnotice_memo , otdept_name
    FROM otonline_main a
    INNER JOIN otonline_deptcat b ON a.ot_empDeptCode = b.otdept_code
    WHERE ot_code = '$otcode'
    ");
    return $query;
}
function getEmailSupUp($deptCode)
{
    $obj = new getfn();
    $query = $obj->getci()->db->query("SELECT
    memberemail , posi FROM member WHERE DeptCode = '$deptCode' AND posi > 15 AND resigned != 1
    ");
    return $query;
}
function getEmailHR()
{
    $obj = new getfn();
    $query = $obj->getci()->db->query("SELECT
    memberemail , posi FROM member WHERE DeptCode = '1005' AND resigned != 1
    ");
    return $query;
}