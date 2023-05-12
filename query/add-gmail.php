<?php 
include("../setting/checksession.php");

include("../setting/conn.php");

 extract($_POST);
 $selCourse = $conn->query("SELECT * FROM tbl_user WHERE full_name='$full_name' ");

 if($selCourse->rowCount() > 0)
 {
	$res = array("res" => "exist", "full_name" => $full_name);
 }
 else
 {

 
    
	$insCourse = $conn->query("INSERT INTO tbl_request_email(user_id,date_request)
	VALUES('$id_users',now())");
	
if($insCourse)
	{
		$res = array("res" => "success", "full_name" => $full_name);
	}
	else
	{
		$res = array("res" => "failed", "full_name" => $full_name);
	}


 }


 




 echo json_encode($res);
 ?>