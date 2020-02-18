<?php
class Report_model extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }


    public function count_all()
    {
     $query = $this->db->get("employee");
     return $query->num_rows();
    }
   
    public function fetch_details($limit, $start)
    {
     $output = '';
     $this->db->select("*");
     $this->db->from("employee");
     $this->db->join('otonline_deptcat', 'otonline_deptcat.otdept_code = employee.DeptCode');
     $this->db->order_by("emcode", "ASC");
     $this->db->limit($limit, $start);
     $query = $this->db->get();
     $output .= '
     <table class="table table-striped table-bordered">
      <tr>
      <th>No.</th>
      <th>เลขที่คำขอ</th>
      <th>ฝ่าย</th>
      <th>กะงาน</th>
      <th>วันที่ออกเอกสาร</th>
      <th>วันที่ขอทำโอที</th>
      <th>สถานะ</th>
      </tr>
     ';

     $i =  $this->uri->segment(3)+1;
     foreach($query->result() as $row)
     {
      $output .= '
      <tr>
      <td>'.$i.'</td>
       <td>'.$row->emcode.'</td>
       <td>'.$row->TitleT.'</td>
       <td>'.$row->FnameT.'</td>
       <td>'.$row->LnameT.'</td>
       <td>'.$row->otdept_name.'</td>
       <td>'.$row->PositionName.'</td>
      </tr>
      ';
      $i++;
     }
     $output .= '</table>';
     return $output;
    }
















    
}



?>