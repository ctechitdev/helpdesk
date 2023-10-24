<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);
$selCourse = $conn->query("SELECT * FROM tbl_request_email WHERE user_email='$user_email' ");

if ($selCourse->rowCount() > 0) {
	$res = array("res" => "exist", "full_name" => $id_users);
} else {



	$insCourse = $conn->query("update tbl_request_email set
	user_email = '$user_email' , pass_email = '$pass_email'  , update_by = '$id_users'  , date_update = now()  , state = '$issue_status_id' 
	where user_id = '$id_user_email' ");

	if ($insCourse) {
		$res = array("res" => "success", "full_name" => $id_users);
	} else {
		$res = array("res" => "failed", "full_name" => $id_users);
	}
}







echo json_encode($res);
