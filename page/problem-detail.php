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
                            <div class="col-xxl-12">
                                <div class="email-right-column  email-body p-4 p-xl-5">
                                    <div class="email-body-head mb-5 ">
                                        <?php
                                        $detail = $conn->query("SELECT * FROM tbl_issue_request where ir_id = '$ir_id' ")->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                    </div>
                                    <form method="post" id="update">

                                        <input type="hidden" class="form-control" id="ir_id" name="ir_id" value="<?php echo $detail['ir_id']; ?>" required>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input type="button" class="form-control" id="ir_deteail" name="ir_deteail" value="<?php echo $detail['ir_detail']; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ຮັບບັນຫາ</button>
                                        </div>
                                    </form>
                                    <form action="getproblem.php" method="post">

                                        <div class="row">

                                        </div>
                                        <div class="d-flex justify-content-end ">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ຫນ້າຫລັກ</button>
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
        // edit
        $(document).on("submit", "#update", function() {
            $.post("../query/update-problem.php", $(this).serialize(), function(data) {
                if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ຮັບບັນຫາສຳເລັດ',
                        'success'
                    )
                    setTimeout(
                        function() {
                            window.location.href = 'getproblem.php';
                        }, 1000);
                }
            }, 'json')
            return false;
        });
        // delete 
    </script>
    <!--  -->
</body>

</html>