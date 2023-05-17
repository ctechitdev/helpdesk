<?php 
include("../setting/checksession.php");

include("../setting/conn.php");
 extract($_POST);





	$clear_pre_item = $conn->query(" delete from tbl_request_use_item_detail where rui_id = '$rui_id' ");

    $countbox = count($_POST['item_id']);

    for ($i = 0; $i < ($countbox); $i++) {
 

        $update = $conn->query(" insert into tbl_request_use_item_detail  (rui_id,item_id,item_value) values ('$rui_id','$item_id[$i]','$item_value[$i]') ");
    }


    if ($clear_pre_item) {
        $res = array("res" => "success");
    }

else
{
	$res = array("res" => "failed");
}
 

	echo json_encode($res);
 ?> 