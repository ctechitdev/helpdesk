<?php 
include("../setting/checksession.php");

include("../setting/conn.php");
 extract($_POST);



$delExam = $conn->query(" update tbl_issue_request set ir_state ='3' WHERE ir_id='$ir_id'  ");

$lastid = $conn->lastInsertId();

if($delExam)
{
    $update2 = $conn->query(" update tbl_issue_history set ir_state ='3' WHERE ih_id='$ih_id'  "); 

	
	$res = array("res" => "success");
}
else
{
	$res = array("res" => "failed");
}


	echo json_encode($res);
 ?>
 
