<?php 
include("../setting/checksession.php");

include("../setting/conn.php");

 extract($_POST);
 $insCourse = $conn->query("INSERT INTO tbl_issue_request(rate_point)
	VALUES('$rate_point') ");

    $lastid = $conn->lastInsertId();
    
	if ($insCourse) {

       
	$insert2 = $conn->query("INSERT INTO tbl_issue_histoty (ir_id,ir_state,ih_detail ) VALUES('$lastid','3','$issue_detail') ");
	
	
		$res = array("res" => "success" );
	}
	else
	{
		$res = array("res" => "failed" );
	}
 



 echo json_encode($res);
 ?>