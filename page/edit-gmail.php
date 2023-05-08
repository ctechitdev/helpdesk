<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຂໍ້ມູນອີເມວ";
$header_click = "4";
$re_id = $_GET['re_id'];

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
                                        <h4 class="text-dark">ແກ້ໄຂຂໍ້ມູນອີເມວ</h4>
                                        <?php
                                        $gmail = $conn->query("SELECT * FROM tbl_request_email where re_id = '$re_id' ") ->fetch(PDO::FETCH_ASSOC); 
                                        
                                        
                                        ?>



                                    </div>
                                    <form method="post" id="updategmail">

                                    <input type="hidden" class="form-control" id="re_id" name="re_id" value="<?php echo $gmail['re_id']; ?>" required>


                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="email">ອີເມວ</label>
                                                    <input type="email" class="form-control" id="user_email" name="user_email"value="<?php echo $gmail['user_email']; ?>" required>
                                                </div>
                                                
                                            </div>

                                        </div>
                                        <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="password">ລະຫັດ</label>
                                                    <input type="password" class="form-control" id="pass_email" name="pass_email"value="<?php echo $gmail['pass_email']; ?>" required>
                                                </div>
                                                
                                            </div>
                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ເພີ່ມຂໍ້ມູນ</button>
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
                                        <th>ອີເມວ</th>
                                        <th>ວັນທີ</th>
                                    </tr>
                                </thead>
                                <tbody>


                                <?php
                                    $stmt4 = $conn->prepare("select re_id,user_email,date_update
                                    from tbl_request_email  
                                    order by re_id desc ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                            $re_id = $row4['re_id'];
                                            $user_email = $row4['user_email']; 
                                            $date_update = $row4['date_update']; 

                                    ?>



                                            <tr>
                                                <td><?php echo "$re_id"; ?></td>
                                                <td><?php echo "$user_email"; ?></td> 
                                                <td><?php echo "$date_update"; ?></td> 
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="edit-gmail.php?re_id=<?php echo $row4['re_id']; ?>">ແກ້ໄຂ</a>
                                                            <a class="dropdown-item" type="button" id="deletegmail" data-id='<?php echo $row4['re_id']; ?>' class="btn btn-danger btn-sm" >ລືບ</a>

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
        $(document).on("submit", "#updategmail", function() {
			$.post("../query/add-gmail.php", $(this).serialize(), function(data) {
				if (data.res == "exist") {
					Swal.fire(
						'ລົງທະບຽນຊ້ຳ',
						'ຜູ້ໃຊ້ນີ້ຖືກລົງທະບຽນແລ້ວ',
						'error'
					)
				} else if (data.res == "success") {
					Swal.fire(
						'ສຳເລັດ',
						'ເພິ່ມຜູ້ໃຊ້ສຳເລັດ',
						'success'
					)
					setTimeout(
						function() {
						window.location.href= "form-gmail.php"
						}, 1000);
				}
			}, 'json')
			return false;
		});
         // delete 
         $(document).on("click", "#deletegmail", function(e) {
                    e.preventDefault();
                    var id = $(this).data("id");
                    $.ajax({
                        type: "post",
                        url: "../query/delete-gmail.php",
                        dataType: "json",
                        data: {
                            re_id: id
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
                                        window.location.href = 'form-gmail.php';
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