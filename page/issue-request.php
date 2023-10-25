<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ແຈ້ງບ້ນຫາ";
$header_click = "1";

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


    <script>
        $(document).on("click", "#modalstaff", function(e) {
            e.preventDefault();
            var staffid = $(this).data("staffid");

            $.post('../function/modal/get_staff_ict.php', {
                    staffid: staffid
                },
                function(output) {
                    $('.show_data').html(output).show();
                });
        });

        $(document).on("click", "#editrequest", function(e) {
            e.preventDefault();
            var issueid = $(this).data("issueid");

            $.post('../function/modal/get_edit_issue_detail.php', {
                    issue_id: issueid
                },
                function(output) {
                    $('.show_data_edit').html(output).show();
                });
        });
    </script>


    <div class="wrapper">

        <?php include "menu.php"; ?>

        <div class="page-wrapper">

            <?php
            include "header.php";
            ?>

            <div class="content-wrapper">
                <div class="content">
                    <div class="card card-default">
                        <div class="card-header align-items-center px-3 px-md-5 text-center">
                            <h2>ທີມງານ ICT</h2>
                        </div>

                        <div class="card-body px-3 px-md-5">
                            <div class="row">


                                <?php
                                $stmt = $conn->prepare("
                                SELECT usid,full_name,phone_number,active_status,
                                (case when active_status = 1 then 'ວ່າງ' else 'ບໍ່ວ່າງ' end) as status_name
                                 FROM tbl_user 
                                 where active_status is not null ");
                                $stmt->execute();
                                if ($stmt->rowCount() > 0) {
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                        $staff_user_id = $row['usid'];

                                        $active_status = $row['active_status'];

                                        if ($active_status == 1) {
                                            $show_color = 'green';
                                            $show_icon = 'mdi-desktop-mac';
                                        } else {
                                            $show_color = 'red';
                                            $show_icon = 'mdi-desktop-mac-dashboard';
                                        }
                                ?>

                                        <div class="col-lg-6 col-xl-4">
                                            <div class="card card-default p-4">
                                                <a href="javascript:0" id="modalstaff" data-staffid='<?php echo "$staff_user_id"; ?>' class="media text-secondary" data-toggle="modal" data-target="#modal-contact">
                                                    <img src="../images/logo-support.png" class="mr-3 img-fluid rounded" alt="Avatar Image" />

                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-2 text-dark"><?php echo $row['full_name']; ?></h5>
                                                        <ul class="list-unstyled text-smoke text-smoke">
                                                            <li class="d-flex">
                                                                <i class='mdi <?php echo "$show_icon"; ?> mr-1'></i>
                                                                <span style='color:<?php echo "$show_color"; ?>;'><?php echo $row['status_name']; ?></span>
                                                            </li>

                                                            <li class="d-flex">
                                                                <i class="mdi mdi-phone mr-1"></i>
                                                                <span><?php echo $row['phone_number']; ?></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                <?php
                                    }
                                }
                                ?>

                            </div>
                        </div>



                        <!-- add request modal -->
                        <div class="modal fade" id="modal-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header justify-content-end border-bottom-0">


                                        <button type="button" class="btn-close-icon" data-dismiss="modal" aria-label="Close">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                    </div>

                                    <div class="show_data">



                                    </div>


                                </div>
                            </div>
                        </div>


                        <!-- edit request modal -->
                        <div class="modal fade" id="modal-issue" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header justify-content-end border-bottom-0">


                                        <button type="button" class="btn-close-icon" data-dismiss="modal" aria-label="Close">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                    </div>

                                    <div class="show_data_edit">



                                    </div>


                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="content">
                        <!-- For Components documentaion -->


                        <div class="card card-default">

                            <div class="card-body">

                                <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ເລກທີ</th>
                                            <th>ປະເພດບັນຫາ</th>
                                            <th>ປະເພດລະບົບ</th>
                                            <th>ຜູ້ແຈ້ງບັນຫາ</th>
                                            <th>ພະແນກ</th>
                                            <th>ລາຍລະອຽດບັນຫາ</th>
                                            <th>ວັນທີແຈ້ງບັນຫາ</th>
                                            <th> </th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php
                                        $stmt4 = $conn->prepare("SELECT ir_id,isc_name,ist_name,ir_detail,user_name,dp_name,request_date 
                                    FROM tbl_issue_request a 
                                    left join tbl_issue_type b on a.ist_id = b.ist_id 
                                    left join tbl_issue_category c on b.isc_id = c.isc_id
                                    left join tbl_user d on a.reqeust_by = d.usid 
                                    left join tbl_depart e on d.depart_id = e.dp_id 
                                    where reqeust_by = '$id_users'
                                    order by ir_id desc;
                                     ");
                                        $stmt4->execute();
                                        if ($stmt4->rowCount() > 0) {
                                            while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                                $ir_id = $row4['ir_id'];
                                                $isc_name = $row4['isc_name'];
                                                $ist_name = $row4['ist_name'];
                                                $user_name = $row4['user_name'];
                                                $dp_name = $row4['dp_name'];
                                                $ir_detail = $row4['ir_detail'];
                                                $request_date = $row4['request_date'];

                                        ?>



                                                <tr>
                                                    <td><?php echo "$ir_id"; ?></td>
                                                    <td><?php echo "$isc_name"; ?></td>
                                                    <td><?php echo "$ist_name"; ?></td>
                                                    <td><?php echo "$user_name"; ?></td>
                                                    <td><?php echo "$dp_name"; ?></td>
                                                    <td><?php echo "$ir_detail"; ?></td>
                                                    <td><?php echo "$request_date"; ?></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                                <a href="javascript:0" class="dropdown-item" id="editrequest" data-issueid='<?php echo "$ir_id"; ?>' data-toggle="modal" data-target="#modal-issue">ແກ້ໄຂ</a>
                                                                <a class="dropdown-item" type="button" id="deleterequest" data-id='<?php echo $row4['ir_id']; ?>' class="btn btn-danger btn-sm">ລືບ</a>

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

        <script>
            // Add reuqest
            $(document).on("submit", "#addrequest", function() {
                $.post("../query/add-issue-request.php", $(this).serialize(), function(data) {

                    if (data.res == "exist") {
                        Swal.fire(
                            'ຂໍ້ມູນບໍ່ຄົບຖວນ',
                            'ໃສ່ຂໍ້ມູນໃຫ້ຄົບ',
                            'error'
                        )
                    } else if (data.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ແຈ້ງບັນຫາສຳເລັດ',
                            'success'
                        )
                        setTimeout(
                            function() {
                                location.reload();
                            }, 1000);
                    }
                }, 'json')
                return false;
            });


            // edit request
            $(document).on("submit", "#update-request", function() {
                $.post("../query/update-issue-request.php", $(this).serialize(), function(data) {

                    if (data.res == "exist") {
                        Swal.fire(
                            'ຂໍ້ມູນບໍ່ຄົບຖວນ',
                            'ໃສ່ຂໍ້ມູນໃຫ້ຄົບ',
                            'error'
                        )
                    } else if (data.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ແກ້ໄຂສຳເລັດ',
                            'success'
                        )
                        setTimeout(
                            function() {
                                location.reload();
                            }, 1000);
                    }
                }, 'json')
                return false;
            });




            // delete 
            $(document).on("click", "#deleterequest", function(e) {
                e.preventDefault();
                var ir_id = $(this).data("id");
                $.ajax({
                    type: "post",
                    url: "../query/delete-issue-request.php",
                    dataType: "json",
                    data: {
                        ir_id: ir_id
                    },
                    cache: false,
                    success: function(data) {
                        if (data.res == "success") {
                            Swal.fire(
                                'ສຳເລັດ',
                                'ລືບສຳເລັດ',
                                'success'
                            )
                            setTimeout(
                                function() {
                                    window.location.href = 'issue-request.php';
                                }, 1000);

                        } else if (data.res == "noallow") {
                            Swal.fire(
                                'ຜິດພາດ',
                                'ບໍ່ສາມາດລືບໄດ້',
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