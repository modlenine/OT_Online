<?php
	class addfn{
		public $ci;
		function __construct(){
			$this->ci=&get_instance();
		}
		public function getci()
		{
			return $this->ci;
		}
	}







	//approve_status
	function updateStatus($dtot_code_group , $dtot_userApprove_group , $dtot_user_date_approveshow_group , $dtot_result_approve_group)
	{
		$obj = new addfn();
		
		$arupdate = array(
			"ot_userApprove" => $dtot_userApprove_group,
			"ot_user_date_approve" => $dtot_user_date_approveshow_group,
			"ot_status" => $dtot_result_approve_group
		);

		$obj->getci()->db->where("ot_code" , $dtot_code_group);
		$obj->getci()->db->update("otonline_main" , $arupdate);

	}



	function hrnoticeStatus($dtotcode , $othrname , $hrnoticedatetime , $hrnotice_memo)
	{

		$obj = new addfn();

		$arhrnotice = array(
			"ot_hrnotice_name" => $othrname,
			"ot_hrnotice_datetime" => $hrnoticedatetime,
			"ot_status" => "ฝ่ายบุคคลรับทราบ",
			"ot_hrnotice_memo" => $hrnotice_memo
		);

		$obj->getci()->db->where("ot_code" , $dtotcode);
		$obj->getci()->db->update("otonline_main" , $arhrnotice);

	}



	function activeOT($ot_empCode)
	{
		$obj = new addfn();

		$checkActiveFirst = $obj->getci()->db->query("SELECT * from employee where emcode = '$ot_empCode' ");
		foreach($checkActiveFirst->result_array() as $rscheck){
			if($rscheck['ot_active'] == 1){
				$arrayInactive = array(
					"ot_active" => 0
				);
				$obj->getci()->db->where('emcode' , $ot_empCode);
				$obj->getci()->db->update('employee' , $arrayInactive);

			}else{
				$arActiveOt = array(
					"ot_active" => 1
				);
				$obj->getci()->db->where('emcode' , $ot_empCode);
				$obj->getci()->db->update('employee' , $arActiveOt);

			}
		}

	}
















?>