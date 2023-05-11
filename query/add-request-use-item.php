<?php 
include("../setting/checksession.php");

include("../setting/conn.php");

 extract($_POST);

 
 $insCourse = $conn->query("INSERT INTO tbl_request_use_item(rs_id,depart_id,request_by,reqeust_date)
 VALUES('1','$depart_id','$id_users',now()) ");

 $lastid = $conn->lastInsertId();


 $countbox = count($_POST['item_id']);

 for ($i = 0; $i < ($countbox); $i++) {

 
	
    
	if ($insCourse) {

        $insert2 = $conn->query("INSERT INTO tbl_request_use_item_detail(rui_id,item_id,item_value)
        VALUES('$lastid','$item_id[$i]','$item_value[$i]') ");

        $res = array("res" => "success");
    } else {
        $res = array("res" => "failed");
    }

 }
 

 echo json_encode($res);
 ?>
 