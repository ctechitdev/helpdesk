<?php 
include("../setting/checksession.php");

include("../setting/conn.php");
 extract($_POST);


$delExam = $conn->query(" update tbl_request_use_item_detail set item_id ='$item_id',item_value = '$item_value' WHERE riud_id = '$riud_id'  ");
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