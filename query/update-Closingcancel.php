<?php 
include("../setting/checksession.php");

include("../setting/conn.php");
 extract($_POST);

 

$delExam = $conn->query(" update tbl_issue_history set ir_state ='2'WHERE ir_id = '$ir_id'  ");
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
 