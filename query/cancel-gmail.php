<?php 
include("../setting/checksession.php");

include("../setting/conn.php");
 extract($_POST);

 

$delExam = $conn->query(" update tbl_request_email set user_id =NULL,user_email=NULL,pass_email=NULL,date_request=NULL,update_by=NULL,date_update=NULL   WHERE re_id='$re_id'  ");
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