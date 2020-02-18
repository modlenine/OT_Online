<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    // $this->db2 = $this->load->database('saleecolour',TRUE);
    date_default_timezone_set("Asia/Bangkok");
  }

  public function escape_string() {
      return mysqli_connect("localhost", "chainarong", "Admin1234", "saleecolour");
  }


  public function check_login(){

    $this->load->library('user_agent');
    // if($this->input->post('questionTest') != 'สิบ'){
    //   echo "<script>";
    //   echo "alert('กรุณาใส่คำตอบที่ถูกต้อง')";
    //   echo "</script>";
    //   header("refresh:0; url=".base_url('login'));
    //   die();
    // }
// เข้ารหัส input
      $user = mysqli_real_escape_string($this->escape_string() , $_POST['username']);
      $pass = mysqli_real_escape_string($this->escape_string() , md5($_POST['password']));
      // If System go on Please add md5 to element name password 'md5'


      $checkuser = $this->db->query(sprintf("SELECT * FROM member WHERE username = '%s' and password = '%s'  ", $user, $pass
      ));

      $checkdata = $checkuser->num_rows();

      if ($checkdata == 0) {
          echo $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert" style="font-size:15px;text-align: center;">ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง</div>');
        redirect('login');
          die();
      } else {
          

          foreach ($checkuser->result_array() as $r) {
              $_SESSION['username'] = $r['username'];
              $_SESSION['password'] = $r['password'];
              $_SESSION['Fname'] = $r['Fname'];
              $_SESSION['Lname'] = $r['Lname'];
              $_SESSION['Dept'] = $r['Dept'];
              $_SESSION['ecode'] = $r['ecode'];
              $_SESSION['DeptCode'] = $r['DeptCode'];
              $_SESSION['memberemail'] = $r['memberemail'];



              // insert login log
        loginlog($r['username']);




              session_write_close();
          }
          header("refresh:0; url=".base_url());

      }
  }



  public function call_login() {//*****Check Session******//
      if (isset($_SESSION['username']) == "") {

          $_SESSION['RedirectKe'] = $_SERVER['REQUEST_URI'];

          echo "<h1 style='text-align:center;margin-top:50px;'>กรุณา Login เข้าสู่ระบบ</h1>";
          header("refresh:1; url=".base_url('login'));
          die();
      }
  }

  // public function check_permis()
  // {
  //   $ses_username = $_SESSION['username'];
  //   $result = get_group($ses_username);
  //   $get_data = $result->row();
  //   if($get_data->dc_gp_permis_name == "user"){
  //     echo "<script>";
  //     echo "alert('หน้านี้สำหรับ admin เท่านั้น')";
  //     echo "</script>";
  //     header("refresh:1; url=".base_url());
  //     die();
  //   }
  // }




  public function logout(){
      session_destroy();
      $this->session->unset_userdata('referrer_url');
      header("refresh:0; url=".base_url('login'));
  }

  public function getuser(){
    $result = $this->db->query("SELECT * FROM member WHERE username = '".$_SESSION['username']."' ");
    return $result->row();
  }


  







}
