<?php
class Addot_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        require("PHPMailer_5.2.0/class.phpmailer.php");
        date_default_timezone_set("Asia/Bangkok");
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






        // Email Zone
        $getDataToEmail = getDataToEmail($ot_code);

        //************************************ZONE***SEND****EMAIL*************************************//

        $subject = "รายการขอทำโอทีใหม่";

        $body = "<h3 style='font-size:26px;'>พบรายการขอทำโอที ใหม่</h3>";
        $body .= "<span style='font-size:14px;'><b>เลขที่คำขอ :</b>&nbsp;" . $getDataToEmail->ot_code . "</span><br><span style='font-size:14px;'><b>วันที่สร้างรายการ : </b>&nbsp;" . conDateTime($getDataToEmail->ot_date_create) . "<br><b>วันที่ขอทำโอที : </b>&nbsp;" . conDate($getDataToEmail->ot_date_request) . "<br><b>กะงานที่ขอทำโอที : </b>&nbsp;" . $getDataToEmail->ot_timeName . "</span><br>";

        $body .= "<span style='font-size:14px;'><strong>ชื่อผู้ขอทำโอที :</strong>&nbsp;" . $getDataToEmail->ot_empFname . "&nbsp;" . $getDataToEmail->ot_empLname . "&nbsp;&nbsp;<b>รหัสพนักงาน : </b>&nbsp;" . $getDataToEmail->ot_empCode . "&nbsp;&nbsp;<b>ตำแหน่ง : </b>&nbsp;" . $getDataToEmail->ot_empPosition . "</span><br>";

        $body .= "<span style='font-size:14px'><b>สถานะคำร้อง : </b>&nbsp;" . $getDataToEmail->ot_status . "</span><br>";

        $body .= "<span style='font-size:14px'><a href='" . base_url('main/listot') . "'>ตรวจสอบรายการคำร้องได้ที่นี่</a></span>";
        $body .= "</html>\n";

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้
        $mail->SMTPDebug = 1;                                      // set mailer to use SMTP
        $mail->Host = "mail.saleecolour.com";  // specify main and backup server
        //        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; // พอร์ท
        //        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = "otonline_system@saleecolour.com";  // SMTP username
        //websystem@saleecolour.com
        //        $mail->Username = "chainarong039@gmail.com";
        $mail->Password = "otonline*1234"; // SMTP password
        //Ae8686#
        //        $mail->Password = "ShctBkk1";

        $mail->From = "otonline_system@saleecolour.com";
        $mail->FromName = "OT Online System";

        foreach (getEmailSupUp($getDataToEmail->ot_empDeptCode)->result_array() as $gue) {
            $mail->AddAddress($gue['memberemail']);
        }
        // $mail->AddAddress("chainarong_k@saleecolour.com");
        $mail->AddCC("chainarong_k@saleecolour.com");

        // $get_usercc_email = get_email_user("dc_user_data_user='$calldata_emails->dc_data_user' ");
        // $gue_cc = $get_usercc_email->row();
        // $mail->AddCC($gue_cc->dc_user_memberemail);

        // $mail->AddAddress("chainarong039@gmail.com");                  // name is optional
        $mail->WordWrap = 50;                                 // set word wrap to 50 characters
        // $mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
        // $mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
        $mail->IsHTML(true);                                  // set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = "<span style='font-family:Tahoma , sans-serif;line-height:25px;'>" . $body . "</span>";;
        $mail->send();
        //************************************ZONE***SEND****EMAIL*************************************//


    } //End of save ot





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
                $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert" style="font-size:15px;text-align: center;">บันทึกข้อมูลสำเร็จ</div>');
                header("refresh:0; url=" . base_url('main/listot'));
            }
        }


        // Email Zone
        $getDataToEmail = getDataToEmail($ot_code);

        //************************************ZONE***SEND****EMAIL*************************************//

        $subject = "รายการขอทำโอทีใหม่";

        $body = "<h3 style='font-size:26px;'>พบรายการขอทำโอที ใหม่</h3>";
        $body .= "<span style='font-size:14px;'><b>เลขที่คำขอ :</b>&nbsp;" . $getDataToEmail->ot_code . "</span><br><span style='font-size:14px;'><b>วันที่สร้างรายการ : </b>&nbsp;" . conDateTime($getDataToEmail->ot_date_create) . "<br><b>วันที่ขอทำโอที : </b>&nbsp;" . conDate($getDataToEmail->ot_date_request) . "<br><b>กะงานที่ขอทำโอที : </b>&nbsp;" . $getDataToEmail->ot_timeName . "</span><br>";


        foreach (getDataToEmailGroup($ot_code)->result() as $rss) {
            $body .= "<span style='font-size:14px;'><strong>ชื่อผู้ขอทำโอที :</strong>&nbsp;" . $rss->ot_empFname . "&nbsp;" . $rss->ot_empLname . "&nbsp;&nbsp;<b>รหัสพนักงาน : </b>&nbsp;" . $rss->ot_empCode . "&nbsp;&nbsp;<b>ตำแหน่ง : </b>&nbsp;" . $rss->ot_empPosition . "</span><br>";
        }
        // $body .= "<span style='font-size:14px;'><strong>ชื่อผู้ขอทำโอที :</strong>&nbsp;" . $getDataToEmail->ot_empFname."&nbsp;". $getDataToEmail->ot_empLname. "&nbsp;&nbsp;<b>รหัสพนักงาน : </b>&nbsp;".$getDataToEmail->ot_empCode."&nbsp;&nbsp;<b>ตำแหน่ง : </b>&nbsp;".$getDataToEmail->ot_empPosition."</span><br>";

        $body .= "<span style='font-size:14px'><b>สถานะคำร้อง : </b>&nbsp;" . $getDataToEmail->ot_status . "</span><br>";

        $body .= "<span style='font-size:14px'><a href='" . base_url('main/listot') . "'>ตรวจสอบรายการคำร้องได้ที่นี่</a></span>";
        $body .= "</html>\n";

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้
        $mail->SMTPDebug = 1;                                      // set mailer to use SMTP
        $mail->Host = "mail.saleecolour.com";  // specify main and backup server
        //        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; // พอร์ท
        //        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = "otonline_system@saleecolour.com";  // SMTP username
        //websystem@saleecolour.com
        //        $mail->Username = "chainarong039@gmail.com";
        $mail->Password = "otonline*1234"; // SMTP password
        //Ae8686#
        //        $mail->Password = "ShctBkk1";

        $mail->From = "otonline_system@saleecolour.com";
        $mail->FromName = "OT Online System";

        foreach (getEmailSupUp($getDataToEmail->ot_empDeptCode)->result_array() as $gue) {
            $mail->AddAddress($gue['memberemail']);
        }
        // $mail->AddAddress("chainarong_k@saleecolour.com");
        $mail->AddCC("chainarong_k@saleecolour.com");

        // $get_usercc_email = get_email_user("dc_user_data_user='$calldata_emails->dc_data_user' ");
        // $gue_cc = $get_usercc_email->row();
        // $mail->AddCC($gue_cc->dc_user_memberemail);

        // $mail->AddAddress("chainarong039@gmail.com");                  // name is optional
        $mail->WordWrap = 50;                                 // set word wrap to 50 characters
        // $mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
        // $mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
        $mail->IsHTML(true);                                  // set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = "<span style='font-family:Tahoma , sans-serif;line-height:25px;'>" . $body . "</span>";;
        $mail->send();
        //************************************ZONE***SEND****EMAIL*************************************//


    } //End saveot2NewMorning





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



        // Email Zone
        $getDataToEmail = getDataToEmail($ot_code);

        //************************************ZONE***SEND****EMAIL*************************************//

        $subject = "รายการขอทำโอทีใหม่";

        $body = "<h3 style='font-size:26px;'>พบรายการขอทำโอที ใหม่</h3>";
        $body .= "<span style='font-size:14px;'><b>เลขที่คำขอ :</b>&nbsp;" . $getDataToEmail->ot_code . "</span><br><span style='font-size:14px;'><b>วันที่สร้างรายการ : </b>&nbsp;" . conDateTime($getDataToEmail->ot_date_create) . "<br><b>วันที่ขอทำโอที : </b>&nbsp;" . conDate($getDataToEmail->ot_date_request) . "<br><b>กะงานที่ขอทำโอที : </b>&nbsp;" . $getDataToEmail->ot_timeName . "</span><br>";


        foreach (getDataToEmailGroup($ot_code)->result() as $rss) {
            $body .= "<span style='font-size:14px;'><strong>ชื่อผู้ขอทำโอที :</strong>&nbsp;" . $rss->ot_empFname . "&nbsp;" . $rss->ot_empLname . "&nbsp;&nbsp;<b>รหัสพนักงาน : </b>&nbsp;" . $rss->ot_empCode . "&nbsp;&nbsp;<b>ตำแหน่ง : </b>&nbsp;" . $rss->ot_empPosition . "</span><br>";
        }
        // $body .= "<span style='font-size:14px;'><strong>ชื่อผู้ขอทำโอที :</strong>&nbsp;" . $getDataToEmail->ot_empFname."&nbsp;". $getDataToEmail->ot_empLname. "&nbsp;&nbsp;<b>รหัสพนักงาน : </b>&nbsp;".$getDataToEmail->ot_empCode."&nbsp;&nbsp;<b>ตำแหน่ง : </b>&nbsp;".$getDataToEmail->ot_empPosition."</span><br>";

        $body .= "<span style='font-size:14px'><b>สถานะคำร้อง : </b>&nbsp;" . $getDataToEmail->ot_status . "</span><br>";

        $body .= "<span style='font-size:14px'><a href='" . base_url('main/listot') . "'>ตรวจสอบรายการคำร้องได้ที่นี่</a></span>";
        $body .= "</html>\n";

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้
        $mail->SMTPDebug = 1;                                      // set mailer to use SMTP
        $mail->Host = "mail.saleecolour.com";  // specify main and backup server
        //        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; // พอร์ท
        //        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = "otonline_system@saleecolour.com";  // SMTP username
        //websystem@saleecolour.com
        //        $mail->Username = "chainarong039@gmail.com";
        $mail->Password = "otonline*1234"; // SMTP password
        //Ae8686#
        //        $mail->Password = "ShctBkk1";

        $mail->From = "otonline_system@saleecolour.com";
        $mail->FromName = "OT Online System";

        foreach (getEmailSupUp($getDataToEmail->ot_empDeptCode)->result_array() as $gue) {
            $mail->AddAddress($gue['memberemail']);
        }
        // $mail->AddAddress("chainarong_k@saleecolour.com");
        $mail->AddCC("chainarong_k@saleecolour.com");

        // $get_usercc_email = get_email_user("dc_user_data_user='$calldata_emails->dc_data_user' ");
        // $gue_cc = $get_usercc_email->row();
        // $mail->AddCC($gue_cc->dc_user_memberemail);

        // $mail->AddAddress("chainarong039@gmail.com");                  // name is optional
        $mail->WordWrap = 50;                                 // set word wrap to 50 characters
        // $mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
        // $mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
        $mail->IsHTML(true);                                  // set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = "<span style='font-family:Tahoma , sans-serif;line-height:25px;'>" . $body . "</span>";;
        $mail->send();
        //************************************ZONE***SEND****EMAIL*************************************//




    }//End of save ot evening
















}
