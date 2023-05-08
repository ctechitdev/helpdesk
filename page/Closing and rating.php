<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ປິດບັນຫາແລະໃຫ້ຄະແນນ";
$header_click = "4";
$ih_id = $_GET['ih_id'];
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
                                        <h4 class="text-dark">ບັນຫາທີ່ກຳລັງແກ້ໄຂ</h4>



                                    </div>
                                    <form method="post" id="addhistoty3">


                                        <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ເລກທີ</th>

                                                    <th>ສະຖານະຂອງບັນຫາ</th>
                                                    <th>ລາຍລະອຽດບັນຫາ</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                <?php
                                                $stmt4 = $conn->prepare("SELECT  *
									FROM tbl_issue_history 
									 ");
                                                $stmt4->execute();
                                                if ($stmt4->rowCount() > 0) {
                                                    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                                        $ih_id = $row4['ih_id'];

                                                        $ir_state = $row4['ir_state'];
                                                        $issue_detail = $row4['ih_detail'];

                                                ?>



                                                        <tr>
                                                            <td><?php echo "$ih_id"; ?></td>

                                                            <td><?php echo "$ir_state"; ?></td>
                                                            <td><?php echo "$issue_detail"; ?></td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                                        <a class="dropdown-item" href="edit-Closing and rating.php?ih_id=<?php echo $row4['ih_id']; ?>">ລາຍລະອຽດ</a>
                                                                        <a class="dropdown-item" type="button" id="update" data-id='<?php echo $row4['ih_id']; ?>' class="btn btn-danger btn-sm">ຍົກເລີກ</a>


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
                // edit
                $(document).on("click", "#update", function(e) {
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
                                    'cancel',
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