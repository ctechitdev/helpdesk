<?php 
include("../setting/checksession.php");

include("../setting/conn.php");
 extract($_POST);

 

$update_data = $conn->query(" update tbl_issue_request set ir_state ='3',rate_point='$rate_point'   WHERE ir_id='$ir_id'  ");
if($update_data)
{
    $update2 = $conn->query(" update tbl_issue_history set ir_state ='3',ih_detail ='$ih_detail'   WHERE ih_id='$ih_id' ");

	$res = array("res" => "success");
}
else
{
	$res = array("res" => "failed");
}


	echo json_encode($res);
 ?>