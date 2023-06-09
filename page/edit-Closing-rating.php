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
                                        <h4 class="text-dark">ລາຍລະອຽດ</h4>
                                        <?php
                                        $detail = $conn->query(" 
                                        
                                        SELECT ir_id,ir_detail, full_name,dp_name,ist_name,isc_name
                                        FROM tbl_issue_request a
                                        left join tbl_user b on a.reqeust_by = b.usid
                                        left join tbl_depart c on b.depart_id = c.dp_id
                                        left join tbl_issue_type d on a.ist_id = d.ist_id
                                        left join tbl_issue_category e on d.isc_id = e.isc_id
                                        where ir_id = '$ir_id' 
                                        
                                        ")->fetch(PDO::FETCH_ASSOC);



                                        ?>

                                    </div>
                                    <form method="post" id="update">
                            
                                        <input type="hidden" class="form-control" id="ir_id" name="ir_id" value="<?php echo  "$ir_id"; ?>" required>
                                        <div class="row  ">

                                           

                                            <div class="row text-center">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <H4>
                                                            <label for="firstName">ເລກທີ່ບັນຫາ: </label> <label for="firstName"><?php echo $detail['ir_id']; ?></label>
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

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <h3> <label for="firstName"></label>
                                                            <div><label for="firstName">ໝວດໝູ່: <?php echo $detail['isc_name']; ?></label></div>
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <h3> <label for="firstName"></label>
                                                            <div><label for="firstName">ປະເພດບັນຫາ: <?php echo $detail['ist_name']; ?></label></div>
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <h3> <label for="firstName"></label>
                                                            <div><label for="firstName">ລາຍລະອຽດບັນຫາ: <?php echo $detail['ir_detail']; ?></label></div>
                                                        </h3>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="firstName">ຂໍ້ຄວາມເນືັ້ອຫາໃນການປິດບັນຫາ</label>
                                                    <textarea class="form-control" rows="4" id="ih_detail" name="ih_detail"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ປິດບ້ນຫາ</button>
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
            $.post("../query/update-Closing-rating.php", $(this).serialize(), function(data) {
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