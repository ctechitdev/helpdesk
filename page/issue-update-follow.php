
<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ອັຟເດດບັນຫາ";
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
                    <!-- For Components documentaion -->


                    <div class="card card-default">

                        <div class="card-body">

                            <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ເລກທີ</th>
                                        <th>ສະຖານະຂອງບັນຫາ </th>
                                        <th>ລາຍລະອຽດບັນຫາ</th>
                                        <th>ວັນທີແຈ້ງບັນຫາ</th>
                                        <th></th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $stmt4 = $conn->prepare("SELECT  ih_id,is_name ,ih_detail,update_date
									FROM tbl_issue_history a
									left join tbl_issue_status b on a.ir_state = b.is_id order by ih_id desc ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                            $ih_id = $row4['ih_id'];
                                            $is_name = $row4['is_name'];
                                            $ih_detail = $row4['ih_detail'];
                                            $update_date = $row4['update_date'];

                                    ?>



                                            <tr>
                                                <td><?php echo "$ih_id"; ?></td>
                                                <td><?php echo "$is_name"; ?></td>
                                                <td><?php echo "$ih_detail"; ?></td>
                                                <td><?php echo "$update_date"; ?></td>
                                                <td><div class="d-flex justify-content-end">
                                            <a button type="submit" class="btn btn-primary mb-2 btn-pill" href="issue_history.php?ih_id=<?php echo $ih_id; ?>">ອັຟເດດບັນຫາ</a>
                                        </div></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="edit-issue-history.php?ih_id=<?php echo $row4['ih_id']; ?>">ແກ້ໄຂ</a>
                                                            <a class="dropdown-item" type="button" id="deletehistory" data-id='<?php echo $row4['ih_id']; ?>' class="btn btn-danger btn-sm">ລືບ</a>

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
       
        // delete 
        $(document).on("click", "#deletehistory", function(e) {
            e.preventDefault();
            var ih_id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "../query/delete-issue-history.php",
                dataType: "json",
                data: {
                    ih_id: ih_id
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
                                window.location.href = 'issue-update-follow.php';
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