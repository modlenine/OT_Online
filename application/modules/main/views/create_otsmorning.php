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
  <div class="container">
    <br />

    <h3 align="center">หน้าขอทำโอทีสำหรับหัวหน้างาน</a></h3><br />
    <br />
    <br />
    <!-- <div align="right" style="margin-bottom:5px;">
      <button type="button" name="add" id="add" class="btn btn-success btn-xs">เพิ่มพนักงาน</button>
      <button href="#" type="button" name="add2" id="add2" class="btn btn-success btn-xs" data-toggle="modal" data-target="#create_ots">เพิ่มพนักงาน2</button>
    </div> -->




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
          $getEmpBydept = getEmployeeList($deptcode);
          foreach ($getEmpBydept->result_array() as $rs) {
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
                <input type="checkbox" name="select_data[]" id="select_data">
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
    <form method="post" id="user_form">
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
            <select readonly name="ot_emptimename" id="ot_emptimename" class="form-control">
              <option value="กะเช้า">กะเช้า</option>
            </select>
            <span id="error_ot_emptimename" class="text-danger"></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>ฝ่าย</label>
            <select name="ot_empDeptCode" id="ot_empDeptCode" class="form-control">
              <?php
              $query = $this->db->query("SELECT * FROM otonline_deptcat WHERE otdept_code = '$deptcode' ORDER BY otdept_name ASC");
              foreach ($query->result_array() as $gdp) {
                echo "<option value='" . $gdp['otdept_code'] . "'>" . $gdp['otdept_name'] . "</option>";
              }
              ?>
            </select>
            <span id="error_ot_empDeptCode" class="text-danger"></span>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-bordered" id="user_data">
          <tr>
            <th>รหัสพนักงาน</th>
            <th>ชื่อผู้ขอ</th>
            <th>นามสกุล</th>
            <th>ฝ่าย</th>
            <th>ตำแหน่ง</th>
            <th>บริษัท</th>
            <th>ลบ</th>
          </tr>
        </table>
      </div>
      <div align="center">
        <input type="submit" name="insert" id="insert" class="btn btn-primary" value="บันทึกข้อมูล" />
      </div>
    </form>

    <br />

  </div>




  </div>
</body>

<!-- Date time pickup -->
<script src="<?= base_url("js/picker.js") ?>"></script>
<script src="<?= base_url("js/picker.date.js") ?>"></script>
<script src="<?= base_url("js/picker.time.js") ?>"></script>
<script src="<?= base_url("js/legacy.js") ?>"></script>
<script src="<?= base_url("js/main.js") ?>"></script>
<script src="<?= base_url("js/rainbow.js") ?>"></script>


</html>

<script>
  $(document).ready(function() {



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
      format: 'yyyy-mm-dd',
      formatSubmit: 'yyyy/mm/dd',
      hiddenName: true,
      editable: true,
      min: true,
      max: 8,
      disable: [
        1
      ]
    });

    var count = 0;


    $('#empdetail tbody').on('click', '#select_data:checked', function() {


      var currow = $(this).closest('tr');
      var ot_empCode = currow.find('.ot_empCode').text();
      var ot_empFname = currow.find('.ot_empFname').text();
      var ot_empLname = currow.find('.ot_empLname').text();
      var dept = currow.find('.dept').text();
      var positionname = currow.find('.positionname').text();
      var compid = currow.find('.compid').text();

      // if ($('#save').text() == 'เพิ่มข้อมูล') {

        count = count + 1;
        output = '<tr id="row_' + count + '">';

        output += '<td>' + ot_empCode + ' <input type="hidden" name="ot_empCode[]" id="ot_empCode' + count + '" class="first_name" value="' + ot_empCode + '" /></td>';
        output += '<td>' + ot_empFname + ' <input type="hidden" name="ot_empFname[]" id="ot_empFname' + count + '" value="' + ot_empFname + '" /></td>';
        output += '<td>' + ot_empLname + ' <input type="hidden" name="ot_empLname[]" id="ot_empLname' + count + '" value="' + ot_empLname + '" /></td>';

        output += '<td>' + dept + ' <input type="hidden" name="dept[]" id="dept' + count + '" value="' + dept + '" /></td>';
        output += '<td>' + positionname + ' <input type="hidden" name="ot_empPosition[]" id="ot_empPosition' + count + '" value="' + positionname + '" /></td>';
        output += '<td>' + compid + ' <input type="hidden" name="compid[]" id="compid' + count + '" value="' + compid + '" /></td>';

        output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="' + count + '">Remove</button></td>';
        output += '</tr>';
        $('#user_data').append(output);
      // }

    });


    
    // $('#empdetail tbody').on('click', '#select_data', function() {
    //   if ($(this).hasClass('checked')) {
    //     $(this).removeClass('checked');
    //   } else {
    //     $('#select_data.checked').removeClass('checked');
    //     $(this).addClass('checked');
    //   }
    // });







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




    $('#user_form').on('submit', function(event) {

      // var error_ot_date_request = '';

      // if ($('#ot_date_request').val() == '') {
      //   error_ot_date_request = 'กรุณาระบุวันที่ขอทำโอที';
      //   $('#error_ot_date_request').text(error_ot_date_request);
      //   $('#ot_date_request').css('border-color', '#cc0000');
      //   alert(error_ot_date_request);
      // } else {
      //   error_ot_date_request = '';
      //   $('#error_ot_date_request').text(error_ot_date_request);
      //   $('#ot_date_request').css('border-color', '');

      //   event.preventDefault();
      // var count_data = 0;
      // $('.first_name').each(function() {
      //   count_data = count_data + 1;
      // });
      // if (count_data > 0) {
      //   var form_data = $(this).serialize();
      //   $.ajax({
      //     url: "main/saveot2",
      //     method: "POST",
      //     data: form_data,
      //     success: function(data) {
      //       console.log(data);
      //       // $('#user_data').find("tr:gt(0)").remove();
      //       $('#action_alert').html('<p>Data Inserted Successfully</p>');
      //       $('#action_alert').dialog('open');
      //       window.close();
      //       window.opener.location.reload();
      //     }
      //   })
      // } else {
      //   alert('failed');
      //   $('#action_alert').html('<p>Please Add atleast one data</p>');
      //   $('#action_alert').dialog('open');
      // }

      // }

      
      
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




  });
</script>