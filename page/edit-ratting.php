<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ປິດບັນຫາ";
$header_click = "1";
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


                            <div class="col-xxl-12">
                                <div class="email-right-column  email-body p-4 p-xl-5">
                                    <div class="email-body-head mb-5 ">
                                        <h4 class="text-dark">ປິດບັນຫາ</h4>
                                        <?php
                                        $request_rows = $conn->query("
                                        SELECT ih_id,a.ir_id,a.rate_point,a.ir_detail,ih_detail
                                        FROM tbl_issue_request a
                                        
                                        left join tbl_issue_history b on a.ir_id = b.ir_id
                                        where a.ir_id = '$ir_id'  ")->fetch(PDO::FETCH_ASSOC);



                                        ?>

                                    </div>
                                    <form method="post" id="update">
                                        <input type="hidden" class="form-control" id="ih_id" name="ih_id" value="<?php echo $request_rows['ih_id']; ?>" required>
                                        <input type="hidden" class="form-control" id="ir_id" name="ir_id" value="<?php echo $request_rows['ir_id']; ?>" required>
                                        <div class="row">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName">ລາຍລະອຽດບັນຫາ</label>
                                                    <input type="button" class="form-control" id="ir_detail" name="ir_detail" value="<?php echo $request_rows['ir_detail']; ?>" required>
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label class="text-dark font-weight-medium">ຄະແນນ</label>
                                                <div class="form-group">

                                                    <select class=" form-control font" id="rate_point" name="rate_point" value="<?php echo $request_rows['rate_point']; ?>" required>

                                                        <option value=""> </option>
                                                        <option value="1" <?php if ($request_rows['rate_point'] == 1) {
                                                                                echo "selected";
                                                                            } ?>>1</option>
                                                        <option value="2"  <?php if ($request_rows['rate_point'] == 2) {
                                                                                echo "selected";
                                                                            } ?>>2</option>
                                                        <option value="3" <?php if ($request_rows['rate_point'] ==3) {
                                                                                echo "selected";
                                                                            } ?>>3</option>
                                                        <option value="4" <?php if ($request_rows['rate_point'] ==4) {
                                                                                echo "selected";
                                                                            } ?>>4</option>
                                                        <option value="5" <?php if ($request_rows['rate_point'] ==5) {
                                                                                echo "selected";
                                                                            } ?>>5</option>

                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName">ຂໍ້ຄວາມເນືັ້ອຫາໃນການປິດບັນຫາ</label>
                                                    <textarea class="form-control"rows="4" id="ih_detail" name="ih_detail" ><?php echo $request_rows['ih_detail']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ອັຟເດດ</button>
                                        </div>

                                    </form>
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
        // update 

        $(document).on("submit", "#update", function() {
            $.post("../query/update-rate.php", $(this).serialize(), function(data) {
                if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
                        'success'
                    )
                    setTimeout(
                        function() {
                            window.location.href = 'Closing-rating.php';
                        }, 1000);
                }
            }, 'json')
            return false;
        });
    </script>


    <!--  -->


</body>

</html>