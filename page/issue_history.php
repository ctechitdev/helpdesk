<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ອັຟເດດບັນຫາ";
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
                                        <h4 class="text-dark">ອັຟເດດບັນຫາ</h4>
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
                                    <form method="post" id="addhistory">
                                        <input type="hidden" class="form-control" id="ir_id" name="ir_id" value='<?php echo "$ir_id"; ?>' required>


                                        <div class="row">
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
                                                <div class="row">

                                                    <div class="form-group  col-lg-12">
                                                        <label class="text-dark font-weight-medium">ສະຖານະຂອງບັນຫາ </label>
                                                        <div class="form-group">

                                                            <select class=" form-control font" name="ir_state" id="ir_state" required>
                                                                <option value=""> ເລືອກສະຖານະຂອງບັນຫາ </option>
                                                                <?php
                                                                $stmt5 = $conn->prepare(" SELECT * FROM tbl_issue_status where is_id  not in ('1','3') ");
                                                                $stmt5->execute();
                                                                if ($stmt5->rowCount() > 0) {
                                                                    while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                                        <option value="<?php echo $row5['is_id']; ?>" <?php if ($row5['is_id'] == 2) {
                                                                                                                            echo "selected";
                                                                                                                        } ?>> <?php echo $row5['is_name']; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>




                                                    </div>



                                                    <div class="form-group col-lg-12">
                                                        <label class="text-dark font-weight-medium"> ລາຍລະອຽດການແກ້ໄຂ </label>
                                                        <textarea id="ih_detail" name="ih_detail" class="form-control" cols="30" rows="3" required></textarea>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ອັຟເດດບັນຫາ</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="content-wrapper">
                <div class="content">
                    <!-- For Components documentaion -->


                    <div class="card card-default">

                        <div class="card-body">
                            <H4>ປະຫວັດການເຄື່ອນໄຫວ </H4>
                            <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ເລກທີ</th>
                                        <th>ປະເພດບັນຫາ</th>
                                        <th>ປະເພດລະບົບ</th>
                                        <th>ສະຖານະຂອງບັນຫາ</th>
                                        <th>ລາຍລະອຽດບັນຫາ</th>
                                        <th>ຜູ້ແຈ້ງບັນຫາ</th>
                                        <th>ພະແນກ</th>
                                        <th>ວັນທີອັບເດດບັນຫາ</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $stmt4 = $conn->prepare("SELECT ih_id,isc_name,ist_name,is_name ,ih_detail,user_name,dp_name,update_date
                                     FROM tbl_issue_history a 
                                    left join tbl_issue_request e on a.ir_id = e.ir_id 
                                    left join tbl_issue_type b on e.ist_id = b.ist_id 
                                    left join tbl_issue_category c on b.isc_id = c.isc_id 
                                    left join tbl_issue_status d on a.ir_state = d.is_id
                                    left join tbl_user f on e.reqeust_by = f.usid 
                                    left join tbl_depart g on f.depart_id = g.dp_id 
                                    where a.ir_id = '$ir_id'
                                    order by ih_id desc
                                   
                                    
                                    ; ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                            $ih_id = $row4['ih_id'];
                                            $isc_name = $row4['isc_name'];
                                            $ist_name = $row4['ist_name'];
                                            $is_name = $row4['is_name'];
                                            $ih_detail = $row4['ih_detail'];
                                            $user_name = $row4['user_name'];
                                            $dp_name = $row4['dp_name'];
                                            $update_date = $row4['update_date'];


                                    ?>



                                            <tr>
                                                <td><?php echo "$ih_id"; ?></td>
                                                <td><?php echo "$isc_name"; ?></td>
                                                <td><?php echo "$ist_name"; ?></td>
                                                <td><?php echo "$is_name"; ?></td>
                                                <td><?php echo "$ih_detail"; ?></td>
                                                <td><?php echo "$user_name"; ?></td>
                                                <td><?php echo "$dp_name"; ?></td>
                                                <td><?php echo "$update_date"; ?></td>


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
        // Add staff user 
        $(document).on("submit", "#addhistory", function() {
            $.post("../query/add-issue-history.php", $(this).serialize(), function(data) {
                if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ເພີ່ມຂໍ້ມູນສຳເລັດ',
                        'success'
                    )
                    setTimeout(
                        function() {
                            window.location.href = 'issue-update-follow.php';
                        }, 1000);
                }
            }, 'json')
            return false;
        });
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