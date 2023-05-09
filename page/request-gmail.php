<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຂໍນຳໃຊ້ອີເມວ";
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
                                        <h4 class="text-dark">ຂໍນຳໃຊ້ອີເມວ</h4>



                                    </div>
                                    <form method="post" id="addgmail">


                                       

                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ຄຳຂໍນຳໃໍຊ້ອີເມວ</button>
                                        </div>

                                    </form>
                                    <div class="content">
                    <!-- For Components documentaion -->


                    <div class="card card-default">

                        <div class="card-body">

                            <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ເລກທີ</th>
                                        <th>ອີເມວ</th> 
                                        <th>ລະຫັດ</th> 
                                        <th>ວັນທີຂໍນຳໃຊ້</th> 
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $stmt4 = $conn->prepare("select re_id,user_email,pass_email,date_request
                                    from tbl_request_email  
                                    order by re_id desc ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                            $re_id = $row4['re_id'];
                                            $user_email = $row4['user_email']; 
                                            $pass_email = $row4['pass_email']; 
                                            $date_request = $row4['date_request']; 

                                    ?>



                                            <tr>
                                                <td><?php echo "$re_id"; ?></td>
                                                <td><?php echo "$user_email"; ?></td> 
                                                <td><?php echo "$pass_email"; ?></td> 
                                                <td><?php echo "$date_request"; ?></td> 
                                                <td>
                                                  
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
         $(document).on("submit", "#addgmail", function() {
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
							location.reload();
						}, 1000);
				}
			}, 'json')
			return false;
		});
    </script>



    <!--  -->


</body>

</html>