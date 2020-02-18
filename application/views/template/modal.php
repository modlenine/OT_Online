<!--begin::Modal-->
<div class="modal fade" id="create_ot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<?php
	$deptcode = getUser()->DeptCode;
	$ecode = getUser()->ecode;

	$getInformation = getEmployeeByEcode($ecode);
	$countEcode = $getInformation->num_rows();
	$getInformations = $getInformation->row();
	if ($countEcode == 0) {
		echo "<script>";
		echo "alert('คุณไม่มีข้อมูลอยู่ในระบบกรุณาติดต่อเจ้าหน้าที่')";
		echo "</script>";
		$datafname = '';
		$datalname = '';
		$dataemcode = '';
		$datapositionname = '';
	} else {
		$datafname = $getInformations->fnamet;
		$datalname = $getInformations->lnamet;
		$dataemcode = $getInformations->emcode;
		$datapositionname = $getInformations->positionname;
	}
	?>
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
					ฟอร์มขอทำโอที
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						&times;
					</span>
				</button>
			</div>
			<div class="modal-body">

				<form method="post" id="single_ot">
					<!-- For user request -->
					<div class="row form-group foruser">
						<div class="col-md-12">
							<label>วันที่ขอทำโอที</label>
							<input required class="form-control datepicker_emp" name="ot_date_requestS" id="ot_date_requestS" type="date">
							<input hidden type="text" name="ot_date_request" id="ot_date_request">
						</div>
					</div>


					<div class="row form-group foruser">
						<div class="col-md-6">
							<label>ชื่อผู้ขอ</label>
							<input readonly type="text" name="ot_empFname" id="ot_empFname" class="form-control" value="<?= $datafname ?>">
						</div>
						<div class="col-md-6">
							<label>นามสกุล</label>
							<input readonly type="text" name="ot_empLname" id="ot_empLname" class="form-control" value="<?= $datalname ?>">
						</div>
					</div>

					<div class="row form-group foruser">
						<div class="col-md-6">
							<label>รหัสพนักงาน</label>
							<input readonly type="text" name="ot_empCode" id="ot_empCode" class="form-control" maxlength="5" value="<?= $dataemcode ?>">
						</div>
						<div class="col-md-6">
							<label>ฝ่าย</label>
							<select readonly name="ot_empDeptCode" id="ot_empDeptCode" class="form-control">
								<?php

								$query = $this->db->query("SELECT * FROM otonline_deptcat WHERE otdept_code = '$deptcode' ORDER BY otdept_name ASC");
								foreach ($query->result_array() as $gdp) {
									echo "<option value='" . $gdp['otdept_code'] . "'>" . $gdp['otdept_name'] . "</option>";
								}
								?>
							</select>
						</div>
					</div>

					<div class="row form-group foruser">
						<div class="col-md-6">
							<label>ตำแหน่งงาน</label>
							<input readonly type="text" name="ot_empPosition" id="ot_empPosition" class="form-control" value="<?= $datapositionname ?>">
						</div>
						<div class="col-md-6">
							<label>กะงาน</label>
							<select name="ot_timeName" id="ot_timeName" class="form-control">
								<option value="">กรุณาเลือกกะการทำงาน</option>
								<option value="กะเช้า">กะเช้า</option>
								<option value="กะเย็น">กะเย็น</option>
							</select>
						</div>
					</div>

					<div class="row foruser">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<input type="submit" name="user_insert" id="user_insert" class="btn btn-primary btn-block" value="บันทึกข้อมูล" data-dismiss="modal">
						</div>
						<div class="col-md-3"></div>
					</div>
					<!-- For user request -->
				</form>

			</div>


			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">
					Close
				</button>
			</div>
		</div>
	</div>
</div>
<!--end::Modal -->











<!--begin::Modal-->
<div class="modal fade" id="choose_timename" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
					ฟอร์มขอทำโอที
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						&times;
					</span>
				</button>
			</div>
			<div class="modal-body">

				<div class="row">
					<div class="col-md-6">
						<a href="<?= base_url('main/openotgroupMorning') ?>">
							<button class="btn btn-info p-3 btn-block" style="font-size:1.2rem">กะเช้า</button></a>
					</div>
					<div class="col-md-6">
						<a href="<?= base_url('main/openotgroupEvening') ?>">
							<button class="btn btn-secondary p-3 btn-block" style="font-size:1.2rem">กะเย็น</button></a>
					</div>
				</div>

			</div>


			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">
					Close
				</button>
			</div>
		</div>
	</div>
</div>
<!--end::Modal -->









<!--begin::Modal-->
<div class="modal fade" id="select_ot_group" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
					ฟอร์มรายละเอียดการขอทำ โอที
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						&times;
					</span>
				</button>
			</div>
			<div class="modal-body">


				<!-- For user request -->
				<div class="row form-group">
					<div class="col-md-6">
						<label>วันที่สร้างรายการ</label>
						<input readonly class="form-control readonly" name="dtot_date_create_group" placeholder="วว/ดด/ปปปป" id="dtot_date_create_group" type="datetime">
					</div>
					<div class="col-md-6">
						<label>วันที่ขอทำโอที</label>
						<input readonly class="form-control readonly" name="dtot_date_request_group" placeholder="วว/ดด/ปปปป" id="dtot_date_request_group" type="datetime">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-6">
						<label>เลขที่คำร้อง</label>
						<input readonly type="text" name="dtot_code_group" id="dtot_code_group" class="form-control readonly">
					</div>
					<div class="col-md-6">
						<label>สถานะ</label>
						<input readonly type="text" name="dtot_status_group" id="dtot_status_group" class="form-control readonly">
					</div>
				</div>


				<div class="row form-group">
					<div class="col-md-6">
						<label>ฝ่าย</label>
						<input readonly type="text" name="dtotdept_name_group" id="dtotdept_name_group" class="form-control readonly">
					</div>
					<div class="col-md-6">
						<label>กะงาน</label>
						<input readonly type="text" name="dtot_timeName_group" id="dtot_timeName_group" class="form-control readonly">
					</div>
				</div>


				<div id="result_otlist_group_detail"></div>


				<hr>

				<div class="row form-group hidesection_group">
					<div class="col-md-6">
						<label>ชื่อผู้อนุมัติ</label>
						<input readonly type="text" name="dtot_userApprove_group" id="dtot_userApprove_group" class="form-control" value="<?= getUser()->Fname . "&nbsp;" . getUser()->Lname ?>">
						<input type="text" name="dtot_userApprove_show_group" id="dtot_userApprove_show_group" class="form-control readonly" style="display:none">
					</div>
					<div class="col-md-6">
						<label>วันที่อนุมัติ</label>
						<input readonly type="datetime" name="dtot_user_date_approveshow_group" id="dtot_user_date_approveshow_group" class="form-control" value="<?= date("d-m-Y H:i:s") ?>">

						<input type="datetime" name="dtot_user_date_approveshow2_group" id="dtot_user_date_approveshow2_group" class="form-control readonly" style="display:none">

						<input hidden type="datetime" name="dtot_user_date_approve_group" id="dtot_user_date_approve_group" class="form-control" value="<?= date("Y-m-d H:i:s") ?>">

					</div>
				</div>

				<div class="row form-group hidesection_group">
					<div class="col-md-12">
						<label>ผลการอนุมัติ</label>
						<select name="dtot_result_approve_group" id="dtot_result_approve_group" class="form-control">
							<option value="">กรุณาเลือกผลการอนุมัติ</option>
							<option value="อนุมัติ">อนุมัติ</option>
							<option value="ไม่อนุมัติ">ไม่อนุมัติ</option>
							<option value="ยกเลิก">ยกเลิก</option>
						</select>
					</div>
				</div>


				<div class="row hidesection_group">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<input type="submit" name="user_approve_group" id="user_approve_group" class="btn btn-primary btn-block" value="บันทึกข้อมูล" data-dismiss="modal">
					</div>
					<div class="col-md-3"></div>
				</div>
				<!-- For user request -->


				<!-- Zone Show Data When Approve -->
				<div class="row mt-3 resultApprove">
					<div class="col-md-12">
						<label for=""><u>สำหรับหัวหน้างาน</u></label>
					</div>
				</div>
				<div class="row mt-1 resultApprove">
					<div class="col-md-4">
						<label for="">ผู้อนุมัติ</label>
						<input readonly type="text" name="show_userappr" id="show_userappr" class="form-control">
					</div>
					<div class="col-md-4">
						<label for="">วันที่อนุมัติ</label>
						<input readonly type="text" name="show_dateappr" id="show_dateappr" class="form-control">
					</div>
					<div class="col-md-4">
						<label for="">ผลการอนุมัติ</label>
						<input readonly type="text" name="show_statusappr" id="show_statusappr" class="form-control">
					</div>
				</div>
				<hr class="resultApprove">


				<!-- HR ZONE -->
				<div class="row mt-3 hr_hidesection">

					<div class="col-md-6">
						<label for="">ลงชื่อฝ่ายบุคคล</label>
						<input readonly type="text" name="othrname" id="othrname" class="form-control" value="<?= getUser()->Fname . "&nbsp;" . getUser()->Lname ?>">
					</div>

					<div class="col-md-6">
						<label for="">ลงวันที่</label>
						<input readonly type="datetime" name="hrnotice_date_show" id="hrnotice_date_show" class="form-control" value="<?= date("d-m-Y H:i:s") ?>">
						<input hidden type="datetime" name="hrnotice_date" id="hrnotice_date" class="form-control" value="<?= date("Y-m-d H:i:s") ?>">
					</div>

				</div>

				<div class="row mt-3 hr_hidesection">

					<div class="col-md-12">
						<label for="">หมายเหตุ</label>
						<textarea name="hrnotice_memo" id="hrnotice_memo" cols="30" rows="3" class="form-control"></textarea>
					</div>

				</div>

				<div class="row mt-3 hr_hidesection">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<input type="submit" name="hrnotice_submit" id="hrnotice_submit" class="btn btn-primary btn-block" value="บันทึกข้อมูล" data-dismiss="modal">
					</div>
					<div class="col-md-3"></div>
				</div>



				<!-- HR After Approve Zone -->
				<div class="row show_hrzone">
					<div class="col-md-12">
						<label for=""><u>สำหรับฝ่ายบุคคล</u></label>
					</div>
				</div>
				<div class="row mt-1 show_hrzone">
					<div class="col-md-6">
						<label for="">ลงชื่อฝ่ายบุคคล</label>
						<input readonly type="text" name="show_hrname" id="show_hrname" class="form-control">
					</div>
					<div class="col-md-6">
						<label for="">ลงวันที่</label>
						<input readonly type="text" name="show_hrdate" id="show_hrdate" class="form-control">
					</div>
				</div>
				<div class="row mt-3 show_hrzone">
					<div class="col-md-12">
						<label for="">หมายเหตุ</label>
						<textarea readonly name="show_hrmemo" id="show_hrmemo" cols="30" rows="3" class="form-control"></textarea>
					</div>
				</div>








			</div>
			<!-- Body modal -->


			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">
					Close
				</button>
			</div>
		</div>
	</div>
</div>
<!--end::Modal -->






