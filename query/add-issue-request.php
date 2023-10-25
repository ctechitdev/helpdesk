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

        $insert_history = $conn->query("INSERT INTO tbl_issue_history(ir_id,ir_state,ih_detail,update_by,update_date)
         VALUES('$lastid','1','$ir_detail','$id_users',now()) ");

        if ($insert_history) {
            $update_state = $conn->query(" update tbl_user set active_status = '2' where usid = '$staff_user'  ");



            if ($update_state) {

                $row4 = $conn->query("
                SELECT ir_id,isc_name,ist_name,ir_detail,user_name,dp_name,request_date 
                FROM tbl_issue_request a 
                left join tbl_issue_type b on a.ist_id = b.ist_id 
                left join tbl_issue_category c on b.isc_id = c.isc_id
                left join tbl_user d on a.reqeust_by = d.usid 
                left join tbl_depart e on d.depart_id = e.dp_id 
                where ir_id = '$lastid' 
                ")->fetch(PDO::FETCH_ASSOC);

                $ir_id = $row4['ir_id'];
                $isc_name = $row4['isc_name'];
                $ist_name = $row4['ist_name'];
                $user_name = $row4['user_name'];
                $dp_name = $row4['dp_name'];
                $ir_detail = $row4['ir_detail'];
                $request_date = $row4['request_date'];

                $data_message = "ເລກທີບັນຫາ: $ir_id ຜູ້ຂໍ: $user_name ພະແນກ: $dp_name ປະເພດບັນຫາ: $isc_name ປະເພດລະບົບ: $user_name" ;



                $url = 'https://notify-api.line.me/api/notify';
                $token      = "5ckKBtA2JoIlj7A2OyF6jXWgLSDJISQHdBry58WVPbI";
                $headers    = [
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: Bearer ' . $token
                ];
                $fields     = "message= $data_message ";

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                curl_close($ch);


                $res = array("res" => "success");
            }
        }
    } else {
        $res = array("res" => "failed");
    }
}



echo json_encode($res);
