<?php


include("../setting/conn.php");

extract($_POST);



$insCourse = $conn->query(" 

delete from tbl_issue_request where ir_id = '$ir_id'
 
    ");
if ($insCourse) {

    $delete2 =  $conn->query("  delete from tbl_issue_history where ih_id = '$ih_id' ");
    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}




echo json_encode($res);
?>