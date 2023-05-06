
<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ອັຟເດດບັນຫາ";
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
                                        <h4 class="text-dark">ແກ້ໄຂອັຟເດດບັນຫາ</h4>
                                        <?php
                                        $history_rows = $conn->query("SELECT * FROM tbl_issue_history where ih_id = '$ih_id' ") ->fetch(PDO::FETCH_ASSOC); 
                                        
                                        ?>



                                    </div>
                                    <form method="post" id="edithistoty">
                                    <input type="hidden" class="form-control" id="ir_id" name="ir_id" value="<?php echo $histoty_rows['ir_id']; ?>" required>


                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row">
                                            
                                                    <div class="form-group  col-lg-12">
												<label class="text-dark font-weight-medium">ລະດັບສິດ</label>
												<div class="form-group">

													<select class=" form-control font" name="ir_state" id="ir_state">
														<option value=""> ເລືອກລະດັບ </option>
														<?php
														$stmt5 = $conn->prepare(" SELECT * FROM tbl_issue_status ");
														$stmt5->execute();
														if ($stmt5->rowCount() > 0) {
															while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
														?>
																<option value="<?php echo $row5['is_id']; ?>  <?php if ($histoty_rows['is_id'] == $row5['is_id']) {
                                                            echo "selected";
                                                        } ?>"> <?php echo $row5['is_name']; ?></option>
														<?php
															}
														}
														?>
													</select>
												</div>
											</div>

                                        

                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="firstName"> ລາຍລະອຽດບັນຫາ </label>
                                                    <input type="text" class="form-control" id="ih_detail" name="ih_detail" value="<?php echo $history_rows['ih_detail']; ?>" required>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ແກ້ໄຂອັຟເດດບັນຫາ</button>
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

                            <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ເລກທີ</th>
                                        <th>ສະຖານະຂອງບັນຫາ </th>
                                        <th>ລາຍລະອຽດບັນຫາ</th>
                                        <th>ວັນທີແຈ້ງບັນຫາ</th>

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
        $(document).on("submit", "#edithistoty", function() {
            $.post("../query/edit-issue-history.php", $(this).serialize(), function(data) {
                if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ເພີ່ມຂໍ້ມູນສຳເລັດ',
                        'success'
                    )
                    setTimeout(
                        function() {
                            window.location.href = 'page-issue-history.php';
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
                                window.location.href = 'page-issue-history.php';
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