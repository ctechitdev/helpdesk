<?php 
include("../setting/checksession.php");

include("../setting/conn.php");
 extract($_POST);

 

$update_data = $conn->query(" update tbl_issue_request set ir_state ='3',ir_detail ='$ir_detail',rate_point='$rate_point'   WHERE ir_id='$ir_id'  ");
if($update_data)
{
    

	$res = array("res" => "success");
}
else
{
	$res = array("res" => "failed");
}


	echo json_encode($res);
 ?>