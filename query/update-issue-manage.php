<?php
include("../setting/checksession.php");

include("../setting/conn.php");
extract($_POST);


$update_issue = $conn->query(" update tbl_issue_request set ir_state ='$issue_status_id'   WHERE ir_id = '$issue_id'  ");

if ($update_issue) {
    $insert_history = $conn->query(" insert into tbl_issue_history (ir_id,ir_state,ih_detail,update_by,update_date) values 
    ( '$issue_id', '$issue_status_id' ,'$update_detail_area' ,'$id_users ',now() ); ");

    if ($insert_history) {
        $update_staff_status = $conn->query(" update tbl_staff_ative_status set active_status ='1'   WHERE user_id = '$id_users'  ");

        if ($update_staff_status) {
            $res = array("res" => "success");
        } else {
            $res = array("res" => "failed");
        }
    } else {
        $res = array("res" => "failed");
    }
} else {
    $res = array("res" => "failed");
}


echo json_encode($res);
