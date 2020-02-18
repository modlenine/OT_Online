<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OT Online Program | รายการ การขอทำโอที</title>


    <style>
        .buttonEdit {
            border-radius: 30px;
            /* box-shadow: 5px 5px 5px #888888; */
        }
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

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <a href="#" class="btn btn-info p-3 mb-2 btn-block buttonEdit" data-toggle="modal" data-target="#create_ot">
                    <span>
                        <i class="la la-cart-plus"></i>
                        <span style="font-size:1rem">
                            ขอทำโอที ( แบบเดี่ยว )&nbsp;&nbsp;<i class="fas fa-angle-double-right"></i>
                        </span>
                    </span>
                </a>
            </div>

            <div class="col-md-4">
                <!-- <a href="javascript:popup('<?= base_url('main/createots') ?>','',1000,800)" class="btn btn-info p-3 mb-2 btn-block"> -->
                <a href="#" data-toggle="modal" data-target="#choose_timename" class="btn btn-warning p-3 mb-2 btn-block buttonEdit">
                    <span>
                        <i class="la la-cart-plus"></i>
                        <span style="font-size:1rem">
                            ขอทำโอที ( แบบกลุ่ม )&nbsp;&nbsp;<i class="fas fa-angle-double-right"></i>
                        </span>
                    </span>
                </a>
            </div>
            <div class="col-md-2"></div>
        </div>






        <?php
        if (getUser()->DeptCode != 1005) {
            $disable = ' style="display:none" ';
        } else {
            $disable = '';
        }


        ?>


        <hr>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="">Filter by สถานะ</label><br>
                <input type="radio" name="filter_status" id="filter_status" value=""> ทั้งหมด
                <input type="radio" name="filter_status" id="filter_status" value="อนุมัติ"> อนุมัติ
                <input type="radio" name="filter_status" id="filter_status" value="รออนุมัติ"> รออนุมัติ
                <input type="radio" name="filter_status" id="filter_status" value="ไม่อนุมัติ"> ไม่อนุมัติ
                <input type="radio" name="filter_status" id="filter_status" value="ยกเลิก"> ยกเลิก
            </div>
            <div class="col-md-4">
                <label for="">Filter by กะงาน</label><br>
                <input type="radio" name="filter_timename" id="filter_timename" value=""> ทั้งหมด
                <input type="radio" name="filter_timename" id="filter_timename" value="กะเช้า"> กะเช้า
                <input type="radio" name="filter_timename" id="filter_timename" value="กะเย็น"> กะเย็น
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                <label>ค้นหาข้อมูล</label>
                <select name="filterData" id="filterData" class="form-control">
                    <option>กรุณาเลือกช่องทางการค้นหา</option>
                    <option value="searchByDate">ค้นจากวันที่ขอทำโอที</option>
                    <option value="searchByDept" <?= $disable ?>>ค้นหาจากแผนก</option>
                    <option value="searchByName">ค้นหาจากชื่อ</option>
                    <option value="searchByEmpCode">ค้นหาจากรหัสพนักงาน</option>
                    <!-- <option value="searchByStatus">ค้นหาจากสถานะ</option> -->
                </select>
            </div>


            <!-- Section For Search -->
            <div class="col-md-3 form-group datesearch" style="display:none">
                <label>Date Start</label>
                <input type="date" name="dateStart" id="dateStart" class="form-control">
            </div>
            <div class="col-md-3 form-group datesearch" style="display:none">
                <label>Date End</label>
                <input type="date" name="dateEnd" id="dateEnd" class="form-control">
            </div>
            <div class="form-group datesearch" style="display:none">
                <button type="button" name="btn_search" id="btn_search" class="mt-4 btn btn-success">ค้นหา</button>
            </div>



            <!-- Section for search by dept -->
            <div class="col-md-3 form-group deptsearch" style="display:none">
                <label>ค้นหาจากแผนก</label>
                <select name="bydept" id="bydept" class="form-control">
                    <option value="">กรุณาเลือกแผนก</option>
                    <?php
                    foreach (getDeptCat()->result_array() as $rsDept) {
                        echo "<option value='" . $rsDept['otdept_code'] . "'>" . $rsDept['otdept_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>


            <div class="col-md-3 form-group namesearch" style="display:none">
                <label>ค้นหาจากชื่อพนักงาน</label>
                <input type="text" name="byname" id="byname" class="form-control">
            </div>
            <div class="col-md-3 form-group namesearch" style="display:none">
                <button type="button" name="btn_empName_search" id="btn_empName_search" class="mt-4 btn btn-success">ค้นหา</button>
            </div>



            <div class="col-md-3 form-group codesearch" style="display:none">
                <label>ค้นหาจากรหัสพนักงาน</label>
                <input type="text" name="bycode" id="bycode" class="form-control">
            </div>
            <div class="col-md-3 form-group codesearch" style="display:none">
                <button type="button" name="btn_empcode_search" id="btn_empcode_search" class="mt-4 btn btn-success">ค้นหา</button>
            </div>



            <div class="col-md-3 form-group statussearch" style="display:none">
                <label>ค้นหาจากสถานะ</label>
                <select name="bystatus" id="bystatus" class="form-control">
                    <option>เลือกสถานะ</option>
                    <option value="อนุมัติ">อนุมัติ</option>
                    <option value="ไม่อนุมัติ">ไม่อนุมัติ</option>
                    <option value="ยกเลิก">ยกเลิก</option>
                </select>
            </div>
        </div>
        <div id="alertEffect"></div>
        <div id="alertFlash"><?=
            $this->session->flashdata('msg');
        ?></div>
        
        <hr>

        <!-- <div id="result_otlist"></div>
                    <hr> -->
        <div id="result_otlist_group"></div>












    </div>
</body>

</html>