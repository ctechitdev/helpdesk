
 <?php 
include("../setting/checksession.php");

include("../setting/conn.php");
 extract($_POST);

 

$update_data = $conn->query(" update tbl_issue_request set ir_state ='3',rate_point='$rate_point'   WHERE ir_id='$ir_id'  ");
if($update_data)
{
    $insert = $conn->query(" INSERT INTO tbl_issue_history  (ir_id,ir_state,ih_detail,update_by,update_date) 
	VALUES ('$ir_id','3','$ih_detail','$id_users',CURDATE())  "); 

	$res = array("res" => "success");
}
else
{
	$res = array("res" => "failed");
}


	echo json_encode($res);
 ?>
