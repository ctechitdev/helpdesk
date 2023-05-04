
<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ອັຟເດດບັນຫາ";
$header_click = "4";

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



                                    </div>
                                    <form method="post" id="addrequest">


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
																<option value="<?php echo $row5['is_id']; ?>"> <?php echo $row5['is_name']; ?></option>
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
                                                    <input type="text" class="form-control" id="ir_detail" name="ir_detail" required>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ແຈ້ງບ້ນຫາ</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
      ຍັງບໍ່ໄດ້ເຮັດຢຸດ 17,00 4,5,2023
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
                                    $stmt4 = $conn->prepare("SELECT  ir_id,is_name,ir_detail,request_date
									FROM tbl_issue_histoty a
									left join tbl_issue_status b on a.ist_id = b.ist_id order by ir_id desc ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                            $ir_id = $row4['ir_id'];
                                            $ist_name = $row4['ist_name'];
                                            $ir_detail = $row4['ir_detail'];
                                            $request_date = $row4['request_date'];

                                    ?>



                                            <tr>
                                                <td><?php echo "$ir_id"; ?></td>
                                                <td><?php echo "$ist_name"; ?></td>
                                                <td><?php echo "$ir_detail"; ?></td>
                                                <td><?php echo "$request_date"; ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="edit-issue-request.php?ir_id=<?php echo $row4['ir_id']; ?>">ແກ້ໄຂ</a>
                                                            <a class="dropdown-item" type="button" id="deleterequest" data-id='<?php echo $row4['ir_id']; ?>' class="btn btn-danger btn-sm">ລືບ</a>

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
        $(document).on("submit", "#addrequest", function() {
            $.post("../query/add-issue-request.php", $(this).serialize(), function(data) {
                if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ເພີ່ມຂໍ້ມູນສຳເລັດ',
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
        // delete 
        $(document).on("click", "#deleterequest", function(e) {
            e.preventDefault();
            var ir_id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "../query/delete-issue-request.php",
                dataType: "json",
                data: {
                    ir_id: ir_id
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
                                window.location.href = 'issue-request.php';
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