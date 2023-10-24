<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ອັຟເດດບັນຫາ";
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

<script>
    $(document).on("click", "#editrequest", function(e) {
        e.preventDefault();
        var issueid = $(this).data("issueid");

        $.post('../function/modal/get_update_issue_detail.php', {
                issue_id: issueid
            },
            function(output) {
                $('.show_data_edit').html(output).show();
            });
    });
</script>


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


                            <div class="col-xxl-12">
                                <div class="email-right-column  email-body p-4 p-xl-5">
                                    <div class="email-body-head mb-5 ">
                                        <h4 class="text-dark">ບັນຫາ</h4>



                                    </div>
                                    <form method="post" id="addhistoty3">


                                        <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ລຳດັບ</th>
                                                    <th>ປະເພດລະບົບ</th>
                                                    <th>ປະເພດບັນຫາ</th>
                                                    <th>ຊື່ຜູ້ແຈ້ງ</th>
                                                    <th>ພະແນກ</th>
                                                    <th>ລາຍລະອຽດ</th>
                                                    <th>ວັນທີ</th>
                                                    <th>ສະຖານະບັນຫາ</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                <?php
                                                $stmt4 = $conn->prepare(" select ir_id,isc_name,ist_name,ir_detail,request_date,full_name,dp_name,is_name,ir_state
                                                from tbl_issue_request a
                                                left join tbl_issue_category b on a.issue_category_id = b.isc_id
                                                left join tbl_issue_type c on a.ist_id = c.ist_id 
                                                left join tbl_user d on a.reqeust_by = d.usid 
                                                left join tbl_depart e on d.depart_id = e.dp_id
                                                left join tbl_issue_status f on a.ir_state = f.is_id 
                                                where assign_by = '$id_users'  
                                                order by ir_id desc ");
                                                $stmt4->execute();
                                                if ($stmt4->rowCount() > 0) {
                                                    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {



                                                        $ir_state = $row4['ir_state'];

                                                        $ir_id = $row4['ir_id'];
                                                        $isc_name = $row4['isc_name'];
                                                        $ist_name = $row4['ist_name'];
                                                        $is_name = $row4['is_name'];

                                                        $dp_name = $row4['dp_name'];
                                                        $request = $row4['full_name'];
                                                        $ir_detail = $row4['ir_detail'];
                                                        $request_date = $row4['request_date'];

                                                        if ($ir_state == 1) {
                                                            $show_color = "blue";
                                                        } elseif ($ir_state == 2) {
                                                            $show_color = "green";
                                                        } else {
                                                            $show_color = "red";
                                                        }

                                                ?>



                                                        <tr>
                                                            <td><?php echo "$ir_id"; ?></td>
                                                            <td><?php echo "$isc_name"; ?></td>
                                                            <td><?php echo "$ist_name"; ?></td>
                                                            <td><?php echo "$request"; ?></td>
                                                            <td><?php echo "$dp_name"; ?></td>
                                                            <td><?php echo mb_strimwidth("$ir_detail", 0, 15, "..."); ?></td>
                                                            <td><?php echo "$request_date"; ?></td>
                                                            <td style='color:<?php echo "$show_color"; ?>;'><?php echo "$is_name"; ?></td>




                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                                        <a href="javascript:0" class="dropdown-item" id="editrequest" data-issueid='<?php echo "$ir_id"; ?>' data-toggle="modal" data-target="#modal-issue">ສະແດງລາຍລະອຽດ</a>
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
                                    </form>


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
                        </div>
                    </div>
                    <?php include "footer.php"; ?>
                </div>
            </div>
            <?php include("../setting/calljs.php"); ?>
            <script>
                // update issue
                $(document).on("submit", "#update-issue", function() {
                    $.post("../query/update-issue-manage.php", $(this).serialize(), function(data) {

                        if (data.res == "exist") {
                            Swal.fire(
                                'ຂໍ້ມູນບໍ່ຄົບຖວນ',
                                'ໃສ່ຂໍ້ມູນໃຫ້ຄົບ',
                                'error'
                            )
                        } else if (data.res == "success") {
                            Swal.fire(
                                'ສຳເລັດ',
                                'ດຳເນີນການສຳເລັດ',
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



                $(document).on("click", "#delete", function(e) {
                    e.preventDefault();
                    var id = $(this).data("id");
                    $.ajax({
                        type: "post",
                        url: "../query/update-Closingcancel.php",
                        dataType: "json",
                        data: {
                            ir_id: id
                        },
                        cache: false,
                        success: function(data) {
                            if (data.res == "success") {
                                Swal.fire(
                                    'ສຳເລັດ',
                                    'ຍົກເລີກສຳເລັດ',
                                    'success'
                                )
                                setTimeout(
                                    function() {
                                        location.reload();
                                    }, 1000);

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