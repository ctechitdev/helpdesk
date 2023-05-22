
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
                    <!-- For Components documentaion -->


                    <div class="card card-default">

                        <div class="card-body">
                            
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
                                        <th>ວັນທີແຈ້ງບັນຫາ</th>                                                                          
                                        <th> </th>

                                    </tr>
                                </thead>
                                <tbody>


                                <?php
                                    $stmt4 = $conn->prepare("SELECT ir_id,isc_name,ist_name,is_name,ir_detail,user_name,dp_name,request_date FROM tbl_issue_request a 
                                    left join tbl_issue_type b on a.ist_id = b.ist_id 
                                    left join tbl_issue_category c on b.isc_id = c.isc_id
                                    left join tbl_user d on a.reqeust_by = d.usid 
                                    left join tbl_depart e on d.depart_id = e.dp_id 
                                    left join tbl_issue_status f on a.ir_state = f.is_id 
                                    where assign_by = '$id_users' and ir_state = '2'
                                    order by ir_id desc;
                                     ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                            $ir_id = $row4['ir_id'];
                                            $isc_name = $row4['isc_name'];
                                            $ist_name = $row4['ist_name'];
                                            $is_name = $row4['is_name'];
                                            $user_name = $row4['user_name'];
                                            $dp_name = $row4['dp_name'];
                                            $ir_detail = $row4['ir_detail'];
                                            $request_date = $row4['request_date'];
                                            

                                    ?>



                                            <tr>
                                                <td><?php echo "$ir_id"; ?></td>
                                                <td><?php echo "$isc_name"; ?></td>
                                                <td><?php echo "$ist_name"; ?></td>
                                                <td><?php echo "$is_name"; ?></td>
                                                <td><?php echo "$ir_detail"; ?></td>
                                                <td><?php echo "$user_name"; ?></td>
                                                <td><?php echo "$dp_name"; ?></td>
                                                <td><?php echo "$request_date"; ?></td>
                                                
                                                
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item" href="issue_history.php?ir_id=<?php echo $row4['ir_id']; ?>">ອັຟເດດບັນຫາ</a>
                                                      
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