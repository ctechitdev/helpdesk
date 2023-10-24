<?php


include("../setting/conn.php");

extract($_POST);


$staff_row = $conn->query("SELECT  *
FROM tbl_issue_request  
where ir_id = '$ir_id' ")->fetch(PDO::FETCH_ASSOC);



$staff_user = $staff_row['assign_by'];

$check_state = $conn->query("SELECT  count(ir_id) as check_staff
FROM tbl_issue_request  
where ir_id > '$ir_id' and  assign_by = '$staff_user' ")->fetch(PDO::FETCH_ASSOC);

if ($check_state['check_staff'] > 0) {
    $res = array("res" => "noallow");
} else {

    $delete1 = $conn->query(" delete from tbl_issue_request where ir_id = '$ir_id' ");

    if ($delete1) {

        $delete2 =  $conn->query(" delete from tbl_issue_history where ir_id = '$ir_id' ");

        if ($delete2) {
            $update_state =  $conn->query(" update tbl_staff_ative_status set active_status = '1' where user_id = '$staff_user' ");

            if ($update_state) {
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
}






echo json_encode($res);
