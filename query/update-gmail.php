<?php 
include("../setting/checksession.php");

include("../setting/conn.php");
 extract($_POST);

 $selCourse = $conn->query("SELECT * FROM tbl_request_email WHERE user_email='$user_email' ");

 if($selCourse->rowCount() > 0)
 {
	$res = array("res" => "exist", "user_email" => $user_email);
 }
 else
 {

$insCourse = $conn->query(" update tbl_request_email set state= '1' ,user_email ='$user_email',pass_email='$pass_email',update_by='$id_users',date_update=now()   WHERE re_id='$re_id'  ");
if($insCourse)
	{
        $res = array("res" => "success", "user_email" => $user_email);
	}
	else
	{
		$res = array("res" => "failed", "user_email" => $user_email);
	}


 }


	echo json_encode($res);
 ?>