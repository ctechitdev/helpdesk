<?php 
include("../setting/checksession.php");

include("../setting/conn.php");
 extract($_POST);

 

$update_data = $conn->query(" update tbl_issue_request set ist_id ='$ist_id',ir_detail ='$ir_detail'   WHERE ir_id='$ir_id'  ");
if($update_data)
{
    $update2 = $conn->query(" update tbl_issue_history set ih_detail ='$ir_detail'   WHERE ih_id='$ih_id'  "); 

	$res = array("res" => "success");
}
else
{
	$res = array("res" => "failed");
}


	echo json_encode($res);
 ?>