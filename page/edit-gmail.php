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
                                        $gmail = $conn->query("SELECT * FROM tbl_request_email where re_id = '$re_id' ")->fetch(PDO::FETCH_ASSOC);


                                        ?>



                                    </div>
                                    <form method="post" id="updategmail">

                                        <input type="hidden" class="form-control" id="re_id" name="re_id" value="<?php echo $gmail['re_id']; ?>" required>


                                        <div class="row">
                                            <div class="col-lg-6    ">
                                                <div class="form-group">
                                                    <label for="email">ອີເມວ</label>
                                                    <input type="email" class="form-control" id="user_email" name="user_email" value="<?php echo $gmail['user_email']; ?>" required>
                                                </div>

                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="password">ລະຫັດ</label>
                                                    <input type="password" class="form-control" id="pass_email" name="pass_email" value="<?php echo $gmail['pass_email']; ?>" required>
                                                </div>

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
                                        <th>ລຳດັບ</th>
                                        <th>ຊື່ຜູ້ຂໍ</th>
                                        <th>ພະແນກ</th>
                                        <th>ອີເມວ</th>
                                        <th>ລະຫັດ</th>
                                        <th>ສະຖານະ</th>
                                        <th>ວັນທີຂໍນຳໃຊ້</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt4 = $conn->prepare("select state,user_id,re_id,user_email,pass_email,date_request,full_name,dp_name from tbl_request_email a 
                                                    left join tbl_user b on a.user_id = b.usid
                                                    left join tbl_depart c on b.depart_id = c.dp_id order by re_id desc; ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                            $re_id = $row4['re_id'];
                                            $user_email = $row4['user_email'];
                                            $user_id = $row4['user_id'];
                                            $pass_email = $row4['pass_email'];
                                            $state = $row4['state'];
                                            $date_request = $row4['date_request'];
                                            $full_name = $row4['full_name'];
                                            $dp_name = $row4['dp_name'];
                                    ?>
                                            <tr>
                                                                <td><?php echo "$re_id"; ?></td>
                                                                <td><?php if (empty($user_id)){
                                                                    echo"ປິດນຳໃຊ້";
                                                                }else {echo "$full_name";}
                                                                ?></td> 
                                                                 <td><?php if (empty($dp_name)){echo "ປິດນຳໃຊ້";
                                                                }else{echo"$dp_name";}
                                                                 ?></td>
                                                                <td><?php
                                                                    if (empty($user_email)) {
                                                                        echo "ກຳລັງດຳເນີນການ";
                                                                    } else {
                                                                        echo "$user_email";
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><?php if (empty($pass_email)){
                                                                    echo "ກຳລັງດຳເນີນການ";
                                                                }else {
                                                                    echo "$pass_email";
                                                                }
                                                                
                                                                ; ?></td>
                                                                 <td><?php if ($state >=2){
                                                                    echo "ປິດນຳໃຊ້";
                                                                }else {
                                                                    echo "ດຳເນີນການ";
                                                                }
                                                                
                                                                ; ?></td>

                                                                <td><?php if (empty($date_request)){
                                                                    echo "ກຳລັງດຳເນີນການ";
                                                                }else {
                                                                    echo "$date_request";
                                                                }
                                                                
                                                                ; ?></td>
                                                <td>
                                                <td>


                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="edit-gmail.php?re_id=<?php echo $row4['re_id']; ?>">ແກ້ໄຂ</a>
                                                            <a class="dropdown-item" type="button" id="cancelgmail" data-id='<?php echo $row4['re_id']; ?>' class="btn btn-danger btn-sm">ຍົກເລີກນຳໃຊ້</a>

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
            $.post("../query/update-gmail.php", $(this).serialize(), function(data) {
                if (data.res == "exist") {
                    Swal.fire(
                        'ລົງທະບຽນຊ້ຳ',
                        'ອີເມວນຳໃຊ້ແລ້ວ',
                        'error'
                    )
                } else if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ເພີ່ມຂໍ້ມູນສຳເລັດ',
                        'success'
                    )
                    setTimeout(
                        function() {
                            window.location.href = "form-email-update.php"
                        }, 1000);
                }
            }, 'json')
            return false;
        });
        // delete 
        $(document).on("click", "#cancelgmail", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "../query/cancel-gmail.php",
                dataType: "json",
                data: {
                    re_id: id
                },
                cache: false,
                success: function(data) {
                    if (data.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ຍົກເລີກ',
                            'success'
                        )
                        setTimeout(
                            function() {
                                window.location.href = 'form-email-update.php';
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