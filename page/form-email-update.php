<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ລາຍລະອຽດອີເມວ";
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

<script>
    $(document).on("click", "#editrequest", function(e) {
        e.preventDefault();
        var emailid = $(this).data("emailid");

        $.post('../function/modal/get_requestor_email.php', {
                request_email_id: emailid
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
                            <div class="content-wrapper">
                                <div class="content">
                                    <!-- For Components documentaion -->
                                    <div class="card-body">

                                        <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ລຳດັບ</th>
                                                    <th>ຊື່ຜູ້ຂໍ</th>
                                                    <th>ພະແນກ</th>
                                                    <th>ອີເມວ</th>
                                                    <th>ລະຫັດ</th>
                                                    <th>ສະຖານະ</th>
                                                    <th>ວັນທີຂໍນຳໃຊ້</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $stmt4 = $conn->prepare("
                                                select user_id,state,re_id,
                                                    date_update,full_name,dp_name,email_status_name,full_name,
                                                    user_email,pass_email,date_update 
                                                    from tbl_request_email a 
                                                    left join tbl_user b on a.user_id = b.usid
                                                    left join tbl_depart c on b.depart_id = c.dp_id
                                                    left join tbl_email_status d on a.state = d.email_status_id 
                                                    order by re_id desc; ");
                                                $stmt4->execute();
                                                if ($stmt4->rowCount() > 0) {
                                                    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                                        $re_id = $row4['re_id'];
                                                        $full_name = $row4['full_name'];
                                                        $dp_name = $row4['dp_name'];
                                                        $email_status_name = $row4['email_status_name'];
                                                        $state = $row4['state'];

                                                        if ($state == 1) {
                                                            $user_email = "ດຳເນີນການ";
                                                            $pass_email = "ດຳເນີນການ";
                                                            $date_update = "ດຳເນີນການ";
                                                        } else {
                                                            $user_email = $row4['user_email'];
                                                            $pass_email = $row4['pass_email'];
                                                            $date_update = $row4['date_update'];
                                                        }
                                                ?>
                                                        <tr>
                                                            <td><?php echo "$re_id"; ?></td>
                                                            <td><?php echo "$full_name"; ?></td>
                                                            <td><?php echo "$dp_name"; ?></td>
                                                            <td><?php echo "$user_email"; ?></td>
                                                            <td><?php echo "$pass_email"; ?></td>
                                                            <td><?php echo "$email_status_name"; ?></td>
                                                            <td><?php echo "$date_update"; ?></td>

                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                                        <a href="javascript:0" class="dropdown-item" id="editrequest" data-emailid='<?php echo $row4['re_id'];  ?>' data-toggle="modal" data-target="#modal-email">ຈັດການ</a>

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

                                    <!-- edit request modal -->
                                    <div class="modal fade" id="modal-email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <?php include "footer.php"; ?>
                    </div>
                </div>
                <?php include("../setting/calljs.php"); ?>

                <script>
                    // Add staff user 
                    $(document).on("submit", "#email-update", function() {
                        $.post("../query/update-email-data.php", $(this).serialize(), function(data) {
                            if (data.res == "exist") {
                                Swal.fire(
                                    'ລົງທະບຽນຊ້ຳ',
                                    'ຜູ້ໃຊ້ນີ້ຖືກລົງທະບຽນແລ້ວ',
                                    'error'
                                )
                            } else if (data.res == "success") {
                                Swal.fire(
                                    'ສຳເລັດ',
                                    'ເພິ່ມຜູ້ໃຊ້ສຳເລັດ',
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
                    $(document).on("click", "#cancelgmail", function(e) {
                        e.preventDefault();
                        var id = $(this).data("id");
                        $.ajax({
                            type: "post",
                            url: "../query/cancel-gmail.php",
                            dataType: "json",
                            data: {
                                re_id: id
                            },
                            cache: false,
                            success: function(data) {
                                if (data.res == "success") {
                                    Swal.fire(
                                        'ສຳເລັດ',
                                        'ຍົກເລີກ',
                                        'success'
                                    )
                                    setTimeout(
                                        function() {
                                            window.location.href = 'form-email-update.php';
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



            </div>
        </div>
    </div>

    </div>




    <!--  -->


</body>

</html>