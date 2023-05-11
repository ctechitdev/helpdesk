<?php


include("../setting/conn.php");

extract($_POST);


$insCourse = $conn->query(" 
delete from tbl_request_use_item where rui_id = '$rui_id'
 ");

if ($insCourse) {

    $delete2 =  $conn->query (" 
    delete from tbl_request_use_item_detail where rui_id = '$rui_id' 
    ");
    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}




echo json_encode($res);
