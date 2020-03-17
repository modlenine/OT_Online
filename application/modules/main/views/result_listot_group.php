<div class="">
<table id="listot_group" class="table table-striped table-bordered dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th width="10%">เลขที่คำขอ</th>
                            <th width="10%">ฝ่าย</th>
							<th>กะงาน</th>
							<th>วันที่ออกเอกสาร</th>
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
			}else if($getotlist['ot_status'] == 'ฝ่ายบุคคลรับทราบ'){
				$colorFont = ' style="color:#008B00;" ';
			}

			if($getotlist['ot_timeName'] == "กะเช้า"){
				$ot_timename = "กะเช้า (16.15 - 19.30น.)";
			}else if($getotlist['ot_timeName'] == "แ"){
				$ot_timename = "กะเย็น (04.15 - 07.30น.)";
			}else{
				$ot_timename = "";
			}
			
			?>
			<tr>
                <td></td>
				<td>
					<a class="select_otdata_group" href="#" data-toggle="modal" data-target="#select_ot_group"
					data_ot_code_group = "<?=$getotlist['ot_code']?>"
					data_otdept_name_group = "<?=$getotlist['otdept_name']?>"
					data_ot_timeName_group = "<?=$getotlist['ot_timeName']?>"
					data_ot_date_create_group = "<?=conDateTime($getotlist['ot_date_create'])?>"
					data_ot_date_request_group = "<?=conDate($getotlist['ot_date_request'])?>"
					data_ot_status_group = "<?=$getotlist['ot_status']?>"
					data_ot_userApprove_group = "<?=$getotlist['ot_userApprove']?>"
					data_ot_user_date_approve_group = "<?=conDateTime($getotlist['ot_user_date_approve'])?>"
					data_ot_hrname = "<?=$getotlist['ot_hrnotice_name']?>"
					data_ot_hrdate = "<?=conDateTime($getotlist['ot_hrnotice_datetime'])?>"
					data_ot_hrmemo = "<?=$getotlist['ot_hrnotice_memo']?>"
					><b><?= $getotlist['ot_code'] ?></b></a>
				</td>
				<td>
					<?= $getotlist['otdept_name'] ?>
				</td>
				<td>
					<?= $ot_timename ?>
				</td>
				<td>
					<?= conDate($getotlist['ot_date_create']) ?>
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
					<tfoot>
						<tr>
						<th>No.</th>
                            <th>เลขที่คำขอ</th>
                            <th>ฝ่าย</th>
							<th>กะงาน</th>
							<th>วันที่ออกเอกสาร</th>
                            <th>วันที่ขอทำโอที</th>
                            <th>สถานะ</th>
						</tr>
					</tfoot>
				</table>
				</div>