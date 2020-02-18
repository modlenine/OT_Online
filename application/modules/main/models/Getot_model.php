<?php
class Getot_model extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function getlistot()
    {
        getContent('result_listot');
    }



    // public function count_all()
    // {
    //  $query = $this->db->query("SELECT ot_code FROM otonline_main GROUP BY ot_code");
    //  return $query->num_rows();
    // }
   
    // public function fetch_details($limit, $start)
    // {
    //  $output = '';
    //  $this->db->select("*");
    //  $this->db->from("otonline_main");
    //  $this->db->join('otonline_deptcat', 'otonline_deptcat.otdept_code = otonline_main.ot_empDeptCode');
    //  $this->db->group_by("ot_code");
    //  $this->db->order_by("ot_code", "DESC");
    //  $this->db->limit($limit, $start);
    //  $query = $this->db->get();
    //  $output .= '
    //  <table class="table table-striped table-bordered">
    //   <tr>
    //   <th>เลขที่คำขอ</th>
    //   <th>ฝ่าย</th>
    //   <th>กะงาน</th>
    //   <th>วันที่ออกเอกสาร</th>
    //   <th>วันที่ขอทำโอที</th>
    //   <th>สถานะ</th>
    //   </tr>
    //  ';

    //  $i = 1;
    //  foreach($query->result() as $row)
    //  {
    //   $output .= '
    //   <tr>
    //    <td>'.$row->ot_code.'</td>
    //    <td>'.$row->otdept_name.'</td>
    //    <td>'.$row->ot_timeName.'</td>
    //    <td>'.$row->ot_date_create.'</td>
    //    <td>'.$row->ot_date_request.'</td>
    //    <td>'.$row->ot_status.'</td>
    //   </tr>
    //   ';
    //  }
    //  $output .= '</table>';
    //  return $output;
    // }









    
}




?>