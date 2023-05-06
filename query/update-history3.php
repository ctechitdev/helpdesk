<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);



$delExam = $conn->query(" update tbl_roles set 
ir_id='$ir_id',ir_state='$ir_state',ih_detail='$issue_detail',rate_point='$rate_point' WHERE ih_id='$ih_id'  ");
if ($delExam) {
    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}




echo json_encode($res);
?>