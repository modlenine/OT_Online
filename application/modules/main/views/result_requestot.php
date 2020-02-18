<div class="">
    <table id="listrequestot" class="table table-striped table-bordered dt-responsive" style="width:100%">
        <thead>
            <tr>
                <th>รหัสพนักงาน</th>
                <th>ชื่อผู้ขอ</th>
                <th>นามสกุล</th>
                <th>ฝ่าย</th>
                <th>ตำแหน่ง</th>
                <th>บริษัท</th>
                <th>ลบ</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($rs->result_array() as $getotlist) {

            ?>
                <tr>
                    <td><?=$getotlist['emcode']?><input type="text" name="addot_emcode[]" id="addot_emcode" value="<?=$getotlist['emcode']?>"></td>
                    <td><?=$getotlist['FnameT']?><input type="text" name="addot_FnameT[]" id="addot_FnameT" value="<?=$getotlist['FnameT']?>"></td>
                    <td><?=$getotlist['LnameT']?><input type="text" name="addot_LnameT[]" id="addot_LnameT" value="<?=$getotlist['LnameT']?>"></td>
                    <td><?=$getotlist['DeptNameT']?><input type="text" name="addot_DeptNameT[]" id="addot_DeptNameT" value="<?=$getotlist['DeptNameT']?>"></td>
                    <td><?=$getotlist['PositionName']?><input type="text" name="addot_PositionName[]" id="addot_PositionName" value="<?=$getotlist['PositionName']?>"></td>
                    <td><?=$getotlist['OrgCode']?><input type="text" name="addot_OrgCode[]" id="addot_OrgCode" value="<?=$getotlist['OrgCode']?>"></td>
                    <td><button type="button" class="btn btn-danger">ลบ</button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>