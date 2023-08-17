<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ລາຍການຂໍອຸປະກອນ";
$header_click = "2";

?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php

    include("../setting/callcss.php");

    ?>


</head>
<script src="../plugins/nprogress/nprogress.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>


<body class="navbar-fixed sidebar-fixed" id="body">




    <div class="wrapper">

        <?php include "menu.php"; ?>

        <div class="page-wrapper">

            <?php
            include "header.php";
            ?>
            <div class="content-wrapper">
                <div class="content">
                    <div class="email-wrapper rounded border bg-white">
                        <div class="row no-gutters justify-content-center">
                            <div class="content-wrapper">
                                <div class="content">
                                    <!-- For Components documentaion -->
                                    <div class="card-body">

                                        <table id="productsTable2" class="table table-hover table-product" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ເລກລຳດັບ</th>
                                                    <th>ສະຖານະຄຳຂໍ</th>
                                                    <th>ພະແນກ</th>
                                                    <th>ໄອດີຜູ້ຂໍ</th>

                                                    <th>ວັນທີ່</th>

                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                <?php
                                                $stmt4 = $conn->prepare(" SELECT a.rui_id,rs_name,dp_name,user_name,reqeust_date 
                            FROM tbl_request_use_item a 
                            left join tbl_request_status b on a.rs_id = b.rs_id 
                            left join tbl_depart c on a.depart_id = c.dp_id 
                            left join tbl_user d on a.request_by = d.usid 
                            where  request_by = '$id_users'
                             order by rui_id desc;

                            
                             ");
                                                $stmt4->execute();
                                                if ($stmt4->rowCount() > 0) {
                                                    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                                ?>

                                                        <tr>
                                                            <td><?php echo $row4['rui_id']; ?></td>
                                                            <td><?php echo $row4['rs_name']; ?></td>
                                                            <td><?php echo $row4['dp_name']; ?></td>
                                                            <td><?php echo $row4['user_name']; ?></td>

                                                            <td><?php echo $row4['reqeust_date']; ?></td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                                        <a class="dropdown-item" href="check-request-use-item.php?rui_id=<?php echo  $row4['rui_id']; ?>">ກວດສອບ</a>
                                                                        <a class="dropdown-item" href="edit-request-use-item.php?rui_id=<?php echo  $row4['rui_id']; ?>">ແກ້ໄຂ</a>
                                                                        <a class="dropdown-item" type="button" id="deleteitem" data-id='<?php echo $row4['rui_id']; ?>' class="btn btn-danger btn-sm">ລຶບ</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>


                                                <?php
                                                    }
                                                }
                                                ?>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php include "footer.php"; ?>
                    </div>
                </div>
                <?php include("../setting/calljs.php"); ?>




            </div>
        </div>
    </div>

    </div>




    <!--  -->


</body>

</html>