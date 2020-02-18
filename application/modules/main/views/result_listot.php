<div class="">
<table id="listot" class="table table-striped table-bordered dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th >No.</th>
                            <th >เลขที่คำขอ</th>
                            <th >ชื่อผู้ขอทำโอที</th>
                            <th>รหัส</th>
                            <th>ตำแหน่ง</th>
                            <th>แผนก</th>
                            <th>กะงาน</th>
                            <th>วันที่ขอทำโอที</th>
                            <th>สถานะ</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
		foreach ($rs->result_array() as $getotlist) {

			if ($getotlist['ot_status'] == 'รออนุมัติ') {
				$colorFont = ' style="color:#B5B5B5" ';
			} else if ($getotlist['ot_status'] == 'อนุมัติ') {
				$colorFont = ' style="color:#008B00;" ';
			}else if ($getotlist['ot_status'] == 'ไม่อนุมัติ'){
				$colorFont = ' style="color:#EE7600;" ';
			}else if ($getotlist['ot_status'] == 'ยกเลิก'){
				$colorFont = ' style="color:#CD0000;" ';
			}
			?>
			<tr>
                <td></td>
				<td>
					<a class="select_otdata" href="#" data-toggle="modal" data-target="#select_ot"
					data_ot_code = "<?=$getotlist['ot_code']?>"
					data_ot_empFname = "<?=$getotlist['ot_empFname']?>"
					data_ot_empLname = "<?=$getotlist['ot_empLname']?>"
					data_ot_empCode = "<?=$getotlist['ot_empCode']?>"
					data_otdept_name = "<?=$getotlist['otdept_name']?>"
					data_ot_empPosition = "<?=$getotlist['ot_empPosition']?>"
					data_ot_timeName = "<?=$getotlist['ot_timeName']?>"
					data_ot_date_create = "<?=conDate($getotlist['ot_date_create'])?>"
					data_ot_date_request = "<?=$getotlist['ot_date_request']?>"
					data_ot_status = "<?=$getotlist['ot_status']?>"
					data_ot_userApprove = "<?=$getotlist['ot_userApprove']?>"
					data_ot_user_date_approve = "<?=conDateTime($getotlist['ot_user_date_approve'])?>"
					><b><?= $getotlist['ot_code'] ?></b></a>
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
					<?= conDate($getotlist['ot_date_request']) ?>
				</td>
				<td>
					<span <?= $colorFont ?>>
						<?= $getotlist['ot_status'] ?>
					</span>

				</td>
			</tr>
		<?php } ?>
                    </tbody>
				</table>
				</div>