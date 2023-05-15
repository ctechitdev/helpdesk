<?php 
include("../setting/checksession.php");

include("../setting/conn.php");
 extract($_POST);


$update_data = $conn->query(" update tbl_issue_request set ir_state ='1',rate_point = NULL WHERE ir_id = '$ir_id'  ");
if($update_data)
{
	$delete = $conn->query(" 

delete from tbl_issue_history where ir_id = '$ir_id'and ir_state = '3'
 
    ");
	$res = array("res" => "success");
}
else
{
	$res = array("res" => "failed");
}


	echo json_encode($res);
 ?>
 