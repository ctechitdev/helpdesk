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
    

$delExam = $conn->query(" update tbl_depart set user_email ='$user_email',pass_email='$pass_email'   WHERE dp_id='$dp_id'  ");
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