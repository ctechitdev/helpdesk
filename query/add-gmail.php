<?php 
include("../setting/checksession.php");

include("../setting/conn.php");

 extract($_POST);
 

 
    
	$insCourse = $conn->query("INSERT INTO tbl_request_email(user_id,date_request)
	VALUES('$id_users',now())");
	if($insCourse)
	{
		$res = array("res" => "success");
	}
	else
	{
		$res = array("res" => "failed");
	}


 




 echo json_encode($res);
 ?>