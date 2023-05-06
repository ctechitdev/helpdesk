<?php 
include("../setting/checksession.php");

include("../setting/conn.php");

 extract($_POST);
 

 
    
	$insCourse = $conn->query("INSERT INTO tbl_issue_history(ir_id,ir_state,ih_detail,update_by,update_date)
	VALUES('$ir_id','$ir_state','$ih_detail','$id_users',now()) ");

  
    
	if ($insCourse) {
      
        $res = array("res" => "success");
    } else {
        $res = array("res" => "failed");
    }


 




 echo json_encode($res);
 ?>
 