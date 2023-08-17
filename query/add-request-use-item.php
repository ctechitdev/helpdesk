<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);


$countrow = $conn->query(" SELECT count(rui_id)+1 as last_number 
FROM tbl_request_use_item
where reqeust_date =  CURRENT_DATE ")->fetch(PDO::FETCH_ASSOC);

if (empty($countrow['last_number'])) {
    $last_num = 1; 
} 
else {
    $last_num  = $countrow['last_number']; 
}

$right_code = str_pad($last_num, 4, '0', STR_PAD_LEFT);

$gendate_number = date("Ymd");

$ref_bill = "KP$gendate_number$right_code";



$insCourse = $conn->query("INSERT INTO tbl_request_use_item(rs_id,rui_bill_number,depart_id,request_by,reqeust_date)
 VALUES('1','$','$depart_id','$id_users',now()) ");

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
