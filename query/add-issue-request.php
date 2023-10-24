<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);
if (empty($ist_id)) {
    $res = array("res" => "exist",);
} else {


    $insCourse = $conn->query("INSERT INTO tbl_issue_request(issue_category_id,ist_id,ir_state,ir_detail,reqeust_by,request_date,assign_by,assign_date)
	VALUES('$isc_id','$ist_id','1','$ir_detail','$id_users',now(),'$staff_user',now()) ");

    $lastid = $conn->lastInsertId();

    if ($insCourse) {

        $insert_history = $conn->query("INSERT INTO tbl_issue_history(ir_id,ir_state,ih_detail,update_by,update_date) VALUES('$lastid','1','$ir_detail','$id_users',now()) ");

        if ($insert_history) {
            $update_state = $conn->query(" update tbl_staff_ative_status set active_status = '2' where staff_ative_status_id = '$staffid'  ");

            $res = array("res" => "success");
        }
    } else {
        $res = array("res" => "failed");
    }
}



echo json_encode($res);
