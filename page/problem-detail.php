<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຮັບບັນຫາ";
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
                        <div class="  no-gutters justify-content-center">
                            <div class="    ">
                                <div class="  p-4 p-xl-5">
                                    <div class="email-body-head mb-6 ">
                                        <h4 class="text-dark">ລາຍລະອຽດບັັນຫາ</h4>
                                    </div>
                                    <?php
                                    $detail = $conn->query("
                                    SELECT ir_id,ir_detail, full_name,dp_name
                                    FROM tbl_issue_request a
                                    left join tbl_user b on a.reqeust_by = b.usid
                                    left join tbl_depart c on b.depart_id = c.dp_id
                                    where ir_id = '$ir_id' ")->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <form method="post" id="update">
                                        <input type="hidden" class="form-control" id="ir_id" name="ir_id" value="<?php echo $detail['ir_id']; ?>" required>
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


                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <h3> <label for="firstName">ລາຍລະອຽດບັນຫາ</label>
                                                        <div><label for="firstName"><?php echo $detail['ir_detail']; ?></label></div>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ຮັບບັນຫາ</button>
                                        </div>

                                        <table id="productsTable" class="table table-hover table-product" style="width:100%">

                                            <thead>
                                                <tr>
                                                    <th>ລຳດັບ</th>
                                                    <th>ປະເພດລະບົບ</th>
                                                    <th>ປະເພດບັນຫາ</th>
                                                    <th>ຊື່ຜູ້ແຈ້ງ</th>
                                                    <th>ພະແນກ</th>
                                                    <th>ຊື່ຜູ້ຮັບ</th>
                                                    <th>ສະຖານະ</th>
                                                    <th>ລາຍລະອຽດ</th>
                                                    <th>ວັນທີມອບບັນຫາ</th>
                                                    <th></th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $stmt4 = $conn->prepare("SELECT ir_id,is_name,isc_name,ist_name,ir_detail,request_date,dp_name,full_name,assign_by,reqeust_by FROM tbl_issue_request a 
                                             left join tbl_issue_type b on a.ist_id = b.ist_id left join tbl_issue_category c on b.isc_id = c.isc_id 
                                             left join tbl_issue_status d on a.ir_state=d.is_id 
                                             left join tbl_user e on a.reqeust_by = e.usid left JOIN tbl_depart f on e.depart_id = f.dp_id order by ir_id desc;");
                                                $stmt4->execute();
                                                if ($stmt4->rowCount() > 0) {
                                                    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                                        $ir_id = $row4['ir_id'];
                                                        $isc_name = $row4['isc_name'];
                                                        $ist_name = $row4['ist_name'];
                                                        $is_name = $row4['is_name'];
                                                        $dp_name = $row4['dp_name'];
                                                        $request = $row4['full_name'];
                                                        $assy_by = $row4['assign_by'];
                                                        $ir_detail = $row4['ir_detail'];
                                                        $request_date = $row4['request_date'];
                                                ?>
                                                        <tr>
                                                            <td><?php echo "$ir_id"; ?></td>
                                                            <td><?php echo "$isc_name"; ?></td>
                                                            <td><?php echo "$ist_name"; ?></td>
                                                            <td><?php echo "$request"; ?></td>
                                                            <td><?php echo "$dp_name"; ?></td>
                                                            <td><?php if (empty($assy_by)) {
                                                                    echo "ລໍຖ້າຮັບ";
                                                                } else {
                                                                    echo "$full_name";
                                                                }

                                                                ?>


                                                            </td>

                                                            <td><?php echo "$is_name"; ?></td>
                                                            <td><?php echo mb_strimwidth("$ir_detail", 0, 15, "..."); ?></td>
                                                            <td><?php echo "$request_date"; ?></td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                                        <a class="dropdown-item" href="problem-detail.php?ir_id=<?php echo $row4['ir_id']; ?>">ລາຍລະອຽດ</a>
                                                                        <a class="dropdown-item" type="button" id="updatecancel" data-id='<?php echo $row4['ir_id']; ?>' class="btn btn-danger btn-sm">ຍົກເລີກ</a>
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
                </div>
            </div>
            <?php include "footer.php"; ?>
        </div>
    </div>
    <?php include("../setting/calljs.php"); ?>
    <script>
        // Add staff user 
        $(document).on("submit", "#update", function() {
            $.post("../query/update-problem.php", $(this).serialize(), function(data) {
                if (data.res == "exist") {
                    Swal.fire(
                        'ລົງທະບຽນຊ້ຳ',
                        'ຜູ້ໃຊ້ນີ້ຖືກລົງທະບຽນແລ້ວ',
                        'error'
                    )
                } else if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ຮັບບັນຫາສຳເລັດ',
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
        $(document).on("click", "#updatecancel", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "../query/update-cancel.php",
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