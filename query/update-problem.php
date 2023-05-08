<?php 
include("../setting/checksession.php");

include("../setting/conn.php");
 extract($_POST);


$delExam = $conn->query(" update tbl_issue_request set ir_state ='2',assign_by = '$id_users',assign_date=now()WHERE ir_id = '$ir_id'  ");
if($delExam)
{
	$res = array("res" => "success");
}
else
{
	$res = array("res" => "failed");
}


	echo json_encode($res);
 ?>