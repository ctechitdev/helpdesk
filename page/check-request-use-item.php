<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຟອມຄຳຂໍນຳໃຊ້ອຸປະກອນ";
$header_click = "2";
$rui_id = $_GET['rui_id'];


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
                        <div class="  no-gutters justify-content-center">



                            <div class="    ">
                                <div class="  p-4 p-xl-5">
                                    <div class="email-body-head mb-6 ">
                                        <h4 class="text-dark">ລາຍການຂໍນຳໃຊ້ອຸປະກອນ</h4>
                                    </div>

                                    <?php
                                    $detail = $conn->query(" 
                                    
                                    select full_name,dp_name ,rui_bill_number
                                    from tbl_request_use_item a 
                                    left join tbl_user b on a.request_by = b.usid
                                    left join tbl_depart c on b.depart_id = c.dp_id
                                    where rui_id = '$rui_id'
                                    ")->fetch(PDO::FETCH_ASSOC);
                                    ?>



                                    <div class="row text-center">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <H4>
                                                    <label for="firstName">ເລກທີ່ຂໍ: </label> <label for="firstName"><?php echo $detail['rui_bill_number']; ?></label>
                                                </H4>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <H4>
                                                    <label for="firstName">ຜູ້ແຈ້ງບັນຫາ: </label> <label for="firstName"><?php echo $detail['full_name']; ?></label>
                                                </H4>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <H4>
                                                    <label for="firstName">ພະແນກ</label> <label for="firstName"><?php echo $detail['dp_name']; ?></label>
                                                </H4>
                                            </div>
                                        </div>

                                    </div>


                                    <form method="post" id="edititem">



                                        <div class="card p-4">

                                            <div class="row">
                                                <div id="add-brand-messages">
                                                </div>
                                                <div class="card-body">
                                                    <div class="input-states">
                                                        <?php

                                                        $stmt3 = $conn->prepare(" SELECT * FROM tbl_request_use_item_detail a
                                                                left join tbl_item_data d on a.item_id = d.item_id where rui_id = '$rui_id'  ");
                                                        $stmt3->execute();
                                                        if ($stmt3->rowCount() > 0) {
                                                            while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                                                                $item_id_edit = $row3['item_id'];

                                                        ?>


                                                                <div class="form-group ">
                                                                    <div class="row">
                                                                        <div class="form-group  col-lg-8">
                                                                            <label class="text-dark font-weight-medium">ຊື່ອຸປະກອນ: <?php echo $row3['item_name']; ?></label>
                                                                        </div>

                                                                        <div class="form-group  col-lg-2">
                                                                            <label class="text-dark font-weight-medium">ຈຳນວນ: <?php echo $row3['item_value']; ?></label>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                        <?php
                                                            }
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>



                            </form>


                        </div>


                    </div>
                </div>
            </div>




            <div class="content-wrapper">
                <div class="content">
                    <!-- For Components documentaion -->


                    <div class="card card-default">

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
                                    $stmt4 = $conn->prepare(" SELECT a.rui_id,rs_name,dp_name,user_name,reqeust_date FROM tbl_request_use_item a 
                           left join tbl_request_status b on a.rs_id = b.rs_id 
                           left join tbl_depart c on a.depart_id = c.dp_id 
                           left join tbl_user d on a.request_by = d.usid 
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
    </div>




    <?php include("../setting/calljs.php"); ?>

    <script>
        // add item Data 
        $(document).on("submit", "#edititem", function() {
            $.post("../query/update-request-use-item.php", $(this).serialize(), function(data) {
                if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
                        'success'
                    )
                    setTimeout(
                        function() {
                            window.location.href = 'form-request-item-use.php';
                        }, 1000);
                }
            }, 'json')
            return false;
        });


        // Delete item
        $(document).on("click", "#deleteitem", function(e) {
            e.preventDefault();
            var rui_id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "../query/delete-request-use-item.php",
                dataType: "json",
                data: {
                    rui_id: rui_id
                },
                cache: false,
                success: function(data) {
                    if (data.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ລຶບຂໍ້ມູນສຳເລັດ',
                            'success'
                        )
                        setTimeout(
                            function() {
                                window.location.href = 'form-request-item-use.php';
                            }, 1000);

                    } else if (data.res == "used") {
                        Swal.fire(
                            'ນຳໃຊ້ແລ້ວ',
                            'ບໍ່ສາມາດລຶບໄດ້ເນື່ອງຈາກນຳໃຊ້ໄປແລ້ວ',
                            'error'
                        )
                    }

                },
                error: function(xhr, ErrorStatus, error) {
                    console.log(status.error);
                }

            });
            return false;
        });
    </script>

    <!--  -->


</body>

</html>