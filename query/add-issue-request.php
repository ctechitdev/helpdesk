<?php 
include("../setting/checksession.php");

include("../setting/conn.php");

 extract($_POST);
 if(empty($ist_id) )
 {
	$res = array("res" => "exist",);
 }
 else
 {

    
	$insCourse = $conn->query("INSERT INTO tbl_issue_request(ist_id,ir_state,ir_detail,reqeust_by,request_date)
	VALUES('$ist_id','1','$ir_detail','$id_users',now()) ");

    $lastid = $conn->lastInsertId();
    
	if ($insCourse) {

        $insert2 = $conn->query("INSERT INTO tbl_issue_history(ir_id,ir_state,ih_detail)
        VALUES('$lastid','1','$ir_detail') ");

        $res = array("res" => "success");
    } else {
        $res = array("res" => "failed");
    }


 
 }



 echo json_encode($res);
 ?>
 