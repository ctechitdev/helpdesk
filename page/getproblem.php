<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຮັບບັນຫາ";
$header_click = "4";
$ir_id = $_GET['ir_id'];
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
                                        <th>ລຳດັບ</th>

                                        <th>ສະຖານະ</th>
                                        <th>ວັນທີມອບບັນຫາ</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $stmt4 = $conn->prepare(" SELECT ir_id,is_name,request_date from tbl_issue_request a 
                                    left join tbl_issue_status b on a.ir_state = b.is_id
                                  
                                    order by ir_id desc ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                            $ir_id = $row4['ir_id'];
                                            $is_name = $row4['is_name'];
                                            $request_date = $row4['request_date'];
                                    ?>
                                            <tr>
                                                <td><?php echo "$ir_id"; ?></td>
                                                <td><?php echo "$is_name"; ?></td>
                                                <td><?php echo "$request_date"; ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="problem-detail.php?ir_id=<?php echo $row4['ir_id']; ?>">ລາຍລະອຽດ</a>
                                                            <a class="dropdown-item" type="button" id="updatecancel" data-id='<?php echo $row4['ir_id']; ?>' class="btn btn-danger btn-sm" >ຍົກເລີກ</a>
                                                            

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
        $(document).on("click", "#updatecancel", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "../query/update-cancel.php",
                dataType: "json",
                data: {
                    id: id
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