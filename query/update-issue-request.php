<?php
include("../setting/checksession.php");

include("../setting/conn.php");
extract($_POST);



$update_data = $conn->query(" update tbl_issue_request set 
issue_category_id = '$isc_id' , ist_id ='$ist_id' , ir_detail = '$ir_detail'
where  ir_id = '$issue_id'
");
if ($update_data) { 
	$res = array("res" => "success");
} else {
	$res = array("res" => "failed");
}


echo json_encode($res);
