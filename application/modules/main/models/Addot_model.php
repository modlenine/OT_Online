<?php
class Addot_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function save_ot()
    {
        checkEmpDetail($this->input->post("ot_empCode"));

        $reportDate = date_create($this->input->post("ot_date_request"));
        $reportConDate = date_format($reportDate, "d");

        $reportMonth = date_create($this->input->post("ot_date_request"));
        $reportConMonth = date_format($reportMonth, "m");

        $reportYear = date_create($this->input->post("ot_date_request"));
        $reportConYear = date_format($reportYear, "Y");

        $conOtDate = $this->input->post("ot_date_request");
        $resultCondate = date('Y-m-d', strtotime($conOtDate));

        $ot_code = getotnumber();

        $ar_saveot = array(
            "ot_empFname" => $this->input->post("ot_empFname"),
            "ot_empLname" => $this->input->post("ot_empLname"),
            "ot_empCode" => $this->input->post("ot_empCode"),
            "ot_empDeptCode" => $this->input->post("ot_empDeptCode"),
            "ot_empPosition" => $this->input->post("ot_empPosition"),
            "ot_timeName" => $this->input->post("ot_timeName"),
            "ot_date_request" => $resultCondate,
            "ot_date_create" => date("Y/m/d H:i:s"),
            "ot_report_date" => $reportConDate,
            "ot_report_month" => $reportConMonth,
            "ot_report_year" => $reportConYear,
            "ot_status" => "รออนุมัติ",
            "ot_code" =>  $ot_code
        );

        $this->db->insert("otonline_main", $ar_saveot);
    }


    public function saveot2NewMorning()
    {
        $ot_code = getotnumber();
        $ot_date_request = $_POST['ot_date_request'];
        $ot_empDeptCode = $_POST['ot_empDeptCode'];
        $ot_emptimename = $_POST['ot_emptimename'];

        $addFname = $this->input->post('addot_FnameT');
        $addLname = $this->input->post('addot_LnameT');

        $otempcode = $_POST['addot_emcode'];


        $addPositionname = $this->input->post('addot_PositionName');

        $reportDate = date_create($_POST['ot_date_request']);
        $reportConDate = date_format($reportDate, "d");

        $reportMonth = date_create($_POST['ot_date_request']);
        $reportConMonth = date_format($reportMonth, "m");

        $reportYear = date_create($_POST['ot_date_request']);
        $reportConYear = date_format($reportYear, "Y");

        $count = 0;
        foreach ($otempcode as $key => $otempcodes) {

            $checkdata = checkDuplicate($otempcodes, $ot_emptimename, $ot_date_request);

            if ($checkdata != 0) {
                echo "<script>";
                echo "alert('ข้อมูล ";
                echo $addFname[$key] . " " . $addLname[$key];
                echo " ขอทำโอทีในช่วงเวลาดังกล่าวไปแล้ว');";
                echo "</script>";
                header("refresh:0; url=" . base_url('main/openotgroupMorning'));
                $count++;
            }
        }

        echo $count;
        if ($count == 0) {
            foreach ($otempcode as $key => $otempcodes) {
                $ar_saveot = array(
                    'ot_date_request' => $ot_date_request,
                    'ot_empFname' => $addFname[$key],
                    'ot_empLname' => $addLname[$key],
                    'ot_empCode' => $otempcodes,
                    'ot_empDeptCode' => $ot_empDeptCode,
                    'ot_empPosition' => $addPositionname[$key],
                    'ot_timeName' => $ot_emptimename,
                    "ot_date_create" => date("Y/m/d H:i:s"),
                    "ot_report_date" => $reportConDate,
                    "ot_report_month" => $reportConMonth,
                    "ot_report_year" => $reportConYear,
                    "ot_code" => $ot_code,
                    "ot_status" => "รออนุมัติ"
                );

                $this->db->insert("otonline_main", $ar_saveot);
                activeOT($otempcodes);
                $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert" style="font-size:15px;text-align: center;">บันทึกข้อมูลสำเร็จ</div>');
                header("refresh:0; url=" . base_url('main/listot'));
            }
        }



    }





    public function saveot2NewEvening()
    {
        $ot_code = getotnumber();
        $ot_date_request = $_POST['ot_date_request'];
        $ot_empDeptCode = $_POST['ot_empDeptCode'];
        $ot_emptimename = $_POST['ot_emptimename'];

        $addFname = $this->input->post('addot_FnameT');
        $addLname = $this->input->post('addot_LnameT');

        $otempcode = $_POST['addot_emcode'];


        $addPositionname = $this->input->post('addot_PositionName');

        $reportDate = date_create($_POST['ot_date_request']);
        $reportConDate = date_format($reportDate, "d");

        $reportMonth = date_create($_POST['ot_date_request']);
        $reportConMonth = date_format($reportMonth, "m");

        $reportYear = date_create($_POST['ot_date_request']);
        $reportConYear = date_format($reportYear, "Y");

        foreach ($otempcode as $key => $otempcodes) {

            $checkdata = checkDuplicate($otempcodes, $ot_emptimename, $ot_date_request);

            //    echo $checkdata."<br>";


            if ($checkdata != 0) {
                echo "<script>";
                echo "alert('ข้อมูล ";
                echo $addFname[$key] . " " . $addLname[$key];
                echo " ขอทำโอทีในช่วงเวลาดังกล่าวไปแล้ว');";
                echo "</script>";
                header("refresh:0; url=" . base_url('main/openotgroupEvening'));
                break;
            }

            $ar_saveot = array(
                'ot_date_request' => $ot_date_request,
                'ot_empFname' => $addFname[$key],
                'ot_empLname' => $addLname[$key],
                'ot_empCode' => $otempcodes,
                'ot_empDeptCode' => $ot_empDeptCode,
                'ot_empPosition' => $addPositionname[$key],
                'ot_timeName' => $ot_emptimename,
                "ot_date_create" => date("Y/m/d H:i:s"),
                "ot_report_date" => $reportConDate,
                "ot_report_month" => $reportConMonth,
                "ot_report_year" => $reportConYear,
                "ot_code" => $ot_code,
                "ot_status" => "รออนุมัติ"
            );
            $this->db->insert("otonline_main", $ar_saveot);
            activeOT($otempcodes);
            header("refresh:0; url=" . base_url('main/listot'));
        }
    }
}
