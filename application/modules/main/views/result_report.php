<div class="">
    <table id="list_report" class="table table-striped table-bordered dt-responsive" style="width:100%">
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

        <tbody>
            <?php
            foreach ($rs->result_array() as $getotlist) {

                if ($getotlist['ot_status'] == 'รออนุมัติ') {
                    $colorFont = ' style="color:#B5B5B5" ';
                } else if ($getotlist['ot_status'] == 'อนุมัติ') {
                    $colorFont = ' style="color:#008B00;" ';
                } else if ($getotlist['ot_status'] == 'ไม่อนุมัติ') {
                    $colorFont = ' style="color:#EE7600;" ';
                } else if ($getotlist['ot_status'] == 'ยกเลิก') {
                    $colorFont = ' style="color:#CD0000;" ';
                } else if ($getotlist['ot_status'] == 'ฝ่ายบุคคลรับทราบ') {
                    $colorFont = ' style="color:#008B00;" ';
                }
            ?>
                <tr>
                    <td>
                        <?= $getotlist['ot_code'] ?>
                    </td>
                    <td>
                        <?= $getotlist['ot_empFname'] . "&nbsp;" . $getotlist['ot_empLname'] ?>
                    </td>
                    <td>
                        <?= $getotlist['ot_empCode'] ?>
                    </td>
                    <td>
                        <?= $getotlist['ot_empPosition'] ?>
                    </td>
                    <td>
                        <?= $getotlist['otdept_name'] ?>
                    </td>
                    <td>
                        <?= $getotlist['ot_timeName'] ?>
                    </td>
                    <td>
                        <?= conDateTime($getotlist['ot_date_create']) ?>
                    </td>
                    <td>
                        <?= conDate($getotlist['ot_date_request']) ?>
                    </td>
                    <td>
                        <span <?= $colorFont ?>>
                            <?= $getotlist['ot_status'] ?>
                        </span>

                    </td>
                    <td>
                        <?= $getotlist['ot_userApprove'] ?>
                    </td>
                    <td>
                        <?= conDateTime($getotlist['ot_user_date_approve']) ?>
                    </td>
                    <td>
                    <?= $getotlist['ot_hrnotice_name'] ?>
                    </td>
                    <td>
                    <?= $getotlist['ot_hrnotice_datetime'] ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>



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
