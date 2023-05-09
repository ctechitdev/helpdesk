<?php 
include("../setting/checksession.php");

include("../setting/conn.php");

 extract($_POST);
 

 
    
	$insCourse = $conn->query("INSERT INTO tbl_request_use_item(rs_id,depart_id,request_by,request_date)
	VALUES('1','$depart_id','$id_users',now()) ");

    $lastid = $conn->lastInsertId();
    
	if ($insCourse) {

        $insert2 = $conn->query("INSERT INTO tbl_request_use_item_detail(rui_id,item_id,item_value)
        VALUES('$lastid','$item_id[]','$item_value[]') ");

        $res = array("res" => "success");
    } else {
        $res = array("res" => "failed");
    }


 




 echo json_encode($res);
 ?>
 