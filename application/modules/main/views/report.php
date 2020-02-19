<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OT Online Program | รายงานสรุป</title>

    <link rel="stylesheet" href="<?=base_url('css/buttons.dataTables.min.css')?>">


    <script src="<?= base_url('js/datatable/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('js/datatable/buttons.flash.min.js') ?>"></script>
    <script src="<?= base_url('js/datatable/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('js/datatable/buttons.print.min.js') ?>"></script>
    <script src="<?= base_url('js/datatable/jszip.min.js') ?>"></script>
    <script src="<?= base_url('js/datatable/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('js/datatable/vfs_fonts.js') ?>"></script>


    <!-- <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script> -->

    <style>
        .webgrid-table-hidden {
            display: none;
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
                <div>REPORT
                    <div class="page-title-subheading">หน้าออกรายงาน
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

        <?php
        if (getUser()->DeptCode != 1005) {
            $disable = ' style="display:none" ';
        } else {
            $disable = '';
        }


        ?>


        <div class="row">
            <div class="col-md-4 form-group">
                <label for="">Filter by สถานะ</label><br>
                <input type="radio" name="report_filter_status" id="report_filter_status" value=""> ทั้งหมด
                <input type="radio" name="report_filter_status" id="report_filter_status" value="อนุมัติ"> อนุมัติ
                <input type="radio" name="report_filter_status" id="report_filter_status" value="รออนุมัติ"> รออนุมัติ
                <input type="radio" name="report_filter_status" id="report_filter_status" value="ไม่อนุมัติ"> ไม่อนุมัติ
                <input type="radio" name="report_filter_status" id="report_filter_status" value="ยกเลิก"> ยกเลิก
            </div>
            <div class="col-md-4">
                <label for="">Filter by กะงาน</label><br>
                <input type="radio" name="report_filter_timename" id="report_filter_timename" value=""> ทั้งหมด
                <input type="radio" name="report_filter_timename" id="report_filter_timename" value="กะเช้า"> กะเช้า
                <input type="radio" name="report_filter_timename" id="report_filter_timename" value="กะเย็น"> กะเย็น
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                <label>ค้นหาข้อมูล</label>
                <select name="filterData" id="filterData" class="form-control">
                    <option>กรุณาเลือกช่องทางการค้นหา</option>
                    <option value="searchByDate">ค้นจากวันที่ขอทำโอที</option>
                    <option value="searchByDept" <?= $disable ?>>ค้นหาจากแผนก</option>

                </select>
            </div>


            <!-- Section For Search -->
            <div class="col-md-3 form-group datesearch" style="display:none">
                <label>Date Start</label>
                <input type="date" name="report_dateStart" id="report_dateStart" class="form-control">
            </div>
            <div class="col-md-3 form-group datesearch" style="display:none">
                <label>Date End</label>
                <input type="date" name="report_dateEnd" id="report_dateEnd" class="form-control">
            </div>
            <div class="form-group datesearch" style="display:none">
                <button type="button" name="report_btn_search" id="report_btn_search" class="mt-4 btn btn-success">ค้นหา</button>
            </div>



            <!-- Section for search by dept -->
            <div class="col-md-3 form-group deptsearch" style="display:none">
                <label>ค้นหาจากแผนก</label>
                <select name="report_bydept" id="report_bydept" class="form-control">
                    <option value="">กรุณาเลือกแผนก</option>
                    <?php
                    foreach (getDeptCat()->result_array() as $rsDept) {
                        echo "<option value='" . $rsDept['otdept_code'] . "'>" . $rsDept['otdept_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>


        </div>
        <input hidden type="datetime" name="datetimenow" id="datetimenow" value="<?= date("d-m-Y H:i:s") ?>">

        <hr>
        <div id="result_report"></div>

        <!-- <table id="example" class="table table-striped table-bordered dt-responsive" style="width:100%">
    <thead>
        <tr>
            <th>เลขที่คำขอ</th>
            <th>ชื่อผู้ขอทำโอที</th>
            <th>รหัส</th>
            <th>ตำแหน่ง</th>
            <th>ฝ่าย</th>
            <th>กะงาน</th>
            <th>วันที่ออกเอกสาร</th>
            <th>วันที่ขอทำโอที</th>
            <th>สถานะ</th>
            <th>ผู้อนุมัติ</th>
            <th>วันที่อนุมัติ</th>
            <th>ลงชื่อฝ่ายบุคคล</th>
            <th>วันที่</th>
        </tr>
    </thead>
</table> -->
    </div>


</body>


</html>