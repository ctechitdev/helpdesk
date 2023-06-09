<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ປິດບັນຫາ";
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
                                                    <th>ເລກທີ</th>


                                                    <th>ລາຍລະອຽດບັນຫາ</th>
                                                    <th>ສະຖານະຂອງບັນຫາ</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                <?php
                                                $stmt4 = $conn->prepare("  SELECT ir_id,is_name,ir_detail,is_name 
                                                from tbl_issue_request a 
                                                left join tbl_issue_status b on a.ir_state = b.is_id
                                                where assign_by = '$id_users' and ir_state in ('2','3','4')
                                                order by ir_id desc ");
                                                $stmt4->execute();
                                                if ($stmt4->rowCount() > 0) {
                                                    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                                        $ir_id = $row4['ir_id'];

                                                        $is_name = $row4['is_name'];
                                                        $ir_detail = $row4['ir_detail'];

                                                ?>



                                                        <tr>
                                                            <td><?php echo "$ir_id"; ?></td>

                                                            <td><?php echo "$ir_detail"; ?></td>

                                                            <td><?php echo "$is_name"; ?></td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                                        <a class="dropdown-item" href="edit-Closing-rating.php?ir_id=<?php echo $row4['ir_id']; ?>">ລາຍລະອຽດ</a>
                                                                         <a class="dropdown-item" type="button" id="delete" data-id='<?php echo $row4['ir_id']; ?>' class="btn btn-danger btn-sm">ຍົກເລີກ</a>
                                                                     
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include "footer.php"; ?>
                </div>
            </div>
            <?php include("../setting/calljs.php"); ?>
            <script>
                // edit
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