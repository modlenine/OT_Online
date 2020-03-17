<!--
//index.php
!-->

<html>

<head>
  <title>หน้าขอทำ โอที สำหรับหัวหน้างาน</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!-- Data table -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script src="<?= base_url("js/jquery.dataTables.min.js") ?>"></script>
  <script src="<?= base_url("js/dataTables.responsive.min.js") ?>"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css" />
  <script src="<?= base_url("js/dataTables2.responsive.min.js") ?>"></script>
  <!-- Data table -->


  <!-- Date pickadate Style -->
  <link rel="stylesheet" href="https://common.olemiss.edu/_js/pickadate.js-3.5.3/lib/themes/classic.css" id="theme_base">
  <link rel="stylesheet" href="https://common.olemiss.edu/_js/pickadate.js-3.5.3/lib/themes/classic.date.css" id="theme_date">
  <!-- Date pickadate Style -->
  <style>
    * {
      font-family: 'Sarabun', sans-serif;
    }

    body {
      font-size: .85rem !important;
    }


    /*.status_color {
        color: green;
    }

    #overlay {   
    position: absolute;  
    top: 0px;   
    left: 0px;  
    background: #333333;   
    width: 100%;   
    height: 100%;   
    opacity: .95;   
    filter: alpha(opacity=95);   
    -moz-opacity: .95;  
    z-index: 999;  
    background: #fff url(http://i.imgur.com/KUJoe.gif) 50% 50% no-repeat;
}*/
  </style>

</head>

<body>
   <!-- Head Template for use all page ###############
##################################################
################################################## -->
<div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>LIST OT
                    <div class="page-title-subheading">หน้าแสดงรายละเอียดการขอโอที
                    </div>
                </div>
            </div>
            <div class="page-title-actions">


            </div>
        </div>
    </div>
    <!-- Head Template for use all page ###############
##################################################
################################################## -->
  <div class="container-fulid bg-white p-3">
    <br />

    <h3 align="center">หน้าขอทำโอทีสำหรับหัวหน้างาน</a></h3><br />
    <br />
    <br />
    <div class="table-responsive">
      <table class="table table-striped table-bordered" id="empdetail">
        <thead>
          <tr>
            <th>No.</th>
            <th>รหัสพนักงาน</th>
            <th>ชื่อผู้ขอ</th>
            <th>นามสกุล</th>
            <th>ฝ่าย</th>
            <th>ตำแหน่งงาน</th>
            <th>บริษัท</th>
            <th>เพิ่ม</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $deptcode = getUser()->DeptCode;
          if($deptcode == 1014 || $deptcode == 1015){
            $deptcode = '1014,1015';
            $getEmpBydept = getEmployeeList($deptcode);
          }else{
            $getEmpBydept = getEmployeeList($deptcode);
          }
          foreach ($getEmpBydept->result_array() as $rs) {
            if($rs['ot_active'] == 1){
              $checked = 'checked';
            }else{
              $checked = '';
            }
          ?>
            <tr>
              <td></td>
              <td class="ot_empCode"><?= $rs['emcode'] ?><input hidden type="text" name="ot_empCode" id="ot_empCode" value="<?= $rs['emcode'] ?>"></td>
              <td class="ot_empFname"><?= $rs['fnamet'] ?><input hidden type="text" name="ot_empFname" id="ot_empFname" value="<?= $rs['fnamet'] ?>"></td>
              <td class="ot_empLname"><?= $rs['lnamet'] ?><input hidden type="text" name="ot_empLname" id="ot_empLname" value="<?= $rs['lnamet'] ?>"></td>
              <td class="dept"><?= $rs['deptnamet'] ?></td>
              <td class="positionname"><?= $rs['positionname'] ?></td>
              <td class="compid"><?= $rs['orgcode'] ?></td>
              <td>
                <input type="checkbox" name="select_data[]" id="select_data" <?=$checked?> >
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>




    <div class="form-group" align="center">
      <input type="hidden" name="row_id" id="hidden_row_id" />
      <!-- <button type="button" name="save" id="save" class="btn btn-info">เพิ่มข้อมูล</button> -->
    </div>


    <br />
    <hr>
    <form method="post" id="user_form" action="<?=base_url('main/saveot2newMorning')?>">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>วันที่ขอทำโอที</label>
            <input type="date" name="ot_date_request" id="ot_date_request" class="form-control datepicker" required />
            <span id="error_ot_date_request" class="text-danger"></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>กะงาน</label>
            <select name="ot_emptimename" id="ot_emptimename" class="form-control" required>
              <option value="">กรุณาเลือกกะการทำงาน</option>
            <option value="กะเย็น(หลังเลิกงาน)">กะเย็น (หลังเลิกงาน 04.15 - 07.30น.)</option>
            </select>
            <span id="error_ot_emptimename" class="text-danger"></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>ฝ่าย</label>
            <select name="ot_empDeptCode" id="ot_empDeptCode" class="form-control">
              <?php
              $query = $this->db->query("SELECT * FROM otonline_deptcat WHERE otdept_code in ($deptcode) ORDER BY otdept_name ASC");
              foreach ($query->result_array() as $gdp) {
                echo "<option value='" . $gdp['otdept_code'] . "'>" . $gdp['otdept_name'] . "</option>";
              }
              ?>
            </select>
            <span id="error_ot_empDeptCode" class="text-danger"></span>
          </div>
        </div>
      </div>



      <table id="listrequestot" class="table table-striped table-bordered dt-responsive" style="width:100%">
        <thead>
            <tr>
                <th>รหัสพนักงาน</th>
                <th>ชื่อผู้ขอ</th>
                <th>นามสกุล</th>
                <th>ฝ่าย</th>
                <th>ตำแหน่ง</th>
                <th>บริษัท</th>
                <th>#</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $rs = loadactiveot($deptcode);
            foreach ($rs->result_array() as $getotlist) {

            ?>
                <tr>
                    <td class="removeEmpRow"><?=$getotlist['emcode']?><input hidden type="text" name="addot_emcode[]" id="addot_emcode" value="<?=$getotlist['emcode']?>"></td>
                    <td><?=$getotlist['FnameT']?><input hidden type="text" name="addot_FnameT[]" id="addot_FnameT" value="<?=$getotlist['FnameT']?>"></td>
                    <td><?=$getotlist['LnameT']?><input hidden type="text" name="addot_LnameT[]" id="addot_LnameT" value="<?=$getotlist['LnameT']?>"></td>
                    <td><?=$getotlist['DeptNameT']?><input hidden type="text" name="addot_DeptNameT[]" id="addot_DeptNameT" value="<?=$getotlist['DeptNameT']?>"></td>
                    <td><?=$getotlist['PositionName']?><input hidden type="text" name="addot_PositionName[]" id="addot_PositionName" value="<?=$getotlist['PositionName']?>"></td>
                    <td><?=$getotlist['OrgCode']?><input hidden type="text" name="addot_OrgCode[]" id="addot_OrgCode" value="<?=$getotlist['OrgCode']?>"></td>
                    <td>
                      <a href="<?=base_url('main/removeEmpData/').$getotlist['emcode']?>">
                        <button class="btn btn-danger btn-sm" type="button" name="removeEmp[]" id="removeEmp">ลบ</button>
                      </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

      <div align="center">
        <input type="submit" name="insert" id="insert" class="btn btn-primary" value="บันทึกข้อมูล" />
      </div>
    </form>

    <br />

  </div>

</body>


</html>

<script>
  $(document).ready(function() {


    $('.datepicker , #insert').prop('disabled', true);
      $('input:checkbox[id="select_data"]').on('click', function() {
        var select_data = $('input:checkbox[id="select_data"]:checked');
        alert(select_data.length);
        if (select_data.length < 1) {
          $('.datepicker').prop('disabled', true);
        } else {
          $('.datepicker').prop('disabled', false);
        }
      });

      $('.datepicker').on('change', function() {
        if ($(this).val() != '') {
          $('#insert').prop('disabled', false);
        } else {
          $('#insert').prop('disabled', true);
        }
      });


      if ($('#checkdatarow').val() != 0) {
        $('.datepicker').prop('disabled', false);
      } else {
        $('.datepicker').prop('disabled', true);
      }



    var deptCode = $('#ot_empDeptCode').val();
    // loadActiveOt(deptCode);


    //check employee code
    $('#ot_empCode').blur(function() {
      var empCode = $(this).val();
      var re = /((^M{1})|(^D{1}))[0-9]{4}/g

      if (re.test(empCode) == false) {

        alert("กรุณาระบุรหัสพนักงานให้ถูกต้อง : M หรือ D ต้องเป็นตัวพิมพ์ใหญ่ แล้วตามด้วยตัวเลข 4 ตัว");
      }
    });


    // Date pickup use
    $('.datepicker').pickadate({
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

    var count = 0;


    $('#empdetail tbody').on('click', '#select_data', function() {

      var currow = $(this).closest('tr');
      var ot_empCode = currow.find('.ot_empCode').text();
      var ot_empFname = currow.find('.ot_empFname').text();
      var ot_empLname = currow.find('.ot_empLname').text();
      var dept = currow.find('.dept').text();
      var positionname = currow.find('.positionname').text();
      var compid = currow.find('.compid').text();

      updateactive(ot_empCode);

    });









    $(document).on('click', '.remove_details', function() {
      var row_id = $(this).attr("id");
      if (confirm("คุณต้องการลบรายชื่อนี้ออกจากรายการใช่หรือไม่ ?")) {
        $('#row_' + row_id + '').remove();
      } else {
        return false;
      }
    });

    $('#action_alert').dialog({
      autoOpen: false
    });




  


    var emp = $('#empdetail').DataTable({
      "columnDefs": [{
        "searching": false,
        "orderable": false,
        "targets": 0
      }],
      "order": [
        [1, 'desc']
      ]
    });

    emp.on('order.dt search.dt', function() {
      emp.column(0, {
        search: 'applied',
        order: 'applied'
      }).nodes().each(function(cell, i) {
        cell.innerHTML = i + 1;
      });
    }).draw();



    $('#listrequestot').DataTable({
      "columnDefs": [{
        "searching": false,
        "orderable": false,
        "targets": 0
      }],
      "order": [
        [1, 'desc']
      ]
    });

  });








  function updateactive(ot_empCode){
    var deptCode = $('#ot_empDeptCode').val();
    $.ajax({
        url: 'main/activeot',
        method:'POST',
        data:{
          ot_empCode: ot_empCode
        },
        success:function(data){
          $('#listrequestot').load(" #listrequestot");
        }
      });
  }



</script>