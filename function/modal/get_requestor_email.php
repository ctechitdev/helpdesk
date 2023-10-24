<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$request_email_id = $_POST['request_email_id'];

?>


<script type="text/javascript" src="../js/jquery.min.js"></script>



<form id="email-update">
    <div class="modal-body pt-0">
        <div class="row no-gutters">

            <input type="hidden" name="issue_id" value='<?php echo "$issue_id"; ?>'>

            <?php

            $gmail = $conn->query("select full_name,email_status_name,state as status_id,
            user_email,pass_email,user_id
            from tbl_request_email a
            left join tbl_user b on a.user_id = b.usid
            left join tbl_email_status c on a.state = c.email_status_id
            where re_id = '$request_email_id' ")->fetch(PDO::FETCH_ASSOC);

            
            $status_id = $gmail['status_id'];


            if ($status_id == 1) {
                $show_color = "blue";
            } elseif ($status_id == 2) {
                $show_color = "green";
            } else {
                $show_color = "red";
            }


            ?>

            <div class="col-md-6">
                <div class="profile-content-left px-4">
                    <div class="card text-center px-0 border-0">
                        <div class="card-img mx-auto">
                            <img src="../images/logo-support.png" alt="user image" />
                        </div>

                        <div class="card-body ">
                            <h4 class="mb-2"><?php echo  "ຜູ້ຂໍອີເມວ: " . $gmail['full_name']; ?></h4>
                            <h4 style='color:<?php echo "$show_color"; ?>;'> <?php echo $gmail['email_status_name']; ?></h4>
                        </div>

                        <input type="hidden" class="form-control"  name="id_user_email" value="<?php echo $gmail['user_id']; ?>" required>


                        <div class="card text-center px-0 border-0">


                            <div class="card-body">
                                <button type="submit" class="btn btn-primary mb-2 btn-pill">ຈັດການ</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <div class="contact-info px-4">
                    <h4 class="mb-1">ລາຍລະອຽດອີເມວ</h4>


                    <div class="form-group  col-lg-12">
                        <label class="text-dark font-weight-medium">ອີເມວ</label>
                        <div class="form-group">
                            <input type="email" class="form-control" id="user_email" name="user_email" value="<?php echo $gmail['user_email']; ?>" required>
                        </div>
                    </div>



                    <div class="form-group col-lg-12">
                        <label class="text-dark font-weight-medium"> ລະຫັດຜ່ານ </label>
                        <input type="text" class="form-control" id="pass_email" name="pass_email" value="<?php echo $gmail['pass_email']; ?>" required>
                    </div>

                    <div class="form-group  col-lg-12">
                        <label class="text-dark font-weight-medium">ສະຖານະ</label>
                        <div class="form-group">
                            <select class=" form-control font" name="issue_status_id" id="issue_status_id" required>
                                <option value=""> ເລືອກສະຖານະ </option>
                                <?php
                                $stmt = $conn->prepare(" SELECT * FROM tbl_email_status where email_status_id != '1' ");
                                $stmt->execute();
                                if ($stmt->rowCount() > 0) {
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?> <option value="<?php echo $row['email_status_id']; ?>"> <?php echo $row['email_status_name']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</form>