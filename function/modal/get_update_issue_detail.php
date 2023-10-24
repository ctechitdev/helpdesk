<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$issue_id = $_POST['issue_id'];

?>

<script src="../plugins/nprogress/nprogress.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>

<script>
    $('#isc_id').change(function() {
        var isc_id = $('#isc_id').val();
        $.post('../function/dynamic_dropdown/get_district_name.php', {
                isc_id: isc_id
            },
            function(output) {
                $('#ist_id').html(output).show();
            });
    });
</script>

<form id="update-issue">
    <div class="modal-body pt-0">
        <div class="row no-gutters">

            <input type="hidden" name="issue_id" value='<?php echo "$issue_id"; ?>'>

            <?php
            $edit_row = $conn->query("
            select ir_id,isc_name,ist_name,ir_detail,request_date,full_name,dp_name,is_name,ir_state
            from tbl_issue_request a
            left join tbl_issue_category b on a.issue_category_id = b.isc_id
            left join tbl_issue_type c on a.ist_id = c.ist_id 
            left join tbl_user d on a.reqeust_by = d.usid 
            left join tbl_depart e on d.depart_id = e.dp_id
            left join tbl_issue_status f on a.ir_state = f.is_id
            where ir_id = '$issue_id' 
            order by ir_id desc  ")->fetch(PDO::FETCH_ASSOC);

            $issue_category = $edit_row['isc_name'];
            $issue_type = $edit_row['ist_name'];
            $ir_detail = $edit_row['ir_detail'];
            $is_name = $edit_row['is_name'];
            $ir_state = $edit_row['ir_state'];


            if ($ir_state == 1) {
                $show_color = "blue";
            } elseif ($ir_state == 2) {
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
                            <h4 class="mb-2"><?php echo  "ຜູ້ແຈ້ງບັນຫາ: ". $edit_row['full_name']; ?></h4>
                            <h4 style='color:<?php echo "$show_color"; ?>;' > <?php echo $edit_row['is_name']; ?></h4>
                        </div>

                        <div class="form-group  col-lg-12">
                            <label class="text-dark font-weight-medium">ສະຖານະ</label>
                            <div class="form-group">
                                <select class=" form-control font" name="issue_status_id" id="issue_status_id" required>
                                    <option value=""> ເລືອກສະຖານະ </option>
                                    <?php
                                    $stmt = $conn->prepare(" SELECT * FROM tbl_issue_status order by is_name asc");
                                    $stmt->execute();
                                    if ($stmt->rowCount() > 0) {
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?> <option value="<?php echo $row['is_id']; ?>"> <?php echo $row['is_name']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>



                        <div class="form-group col-lg-12">
                            <label class="text-dark font-weight-medium"> ເນືັ້ອຫາໃນການປິດບັນຫາ </label>
                            <textarea id="update_detail_area" name="update_detail_area" class="form-control" cols="30" rows="3" required></textarea>
                        </div>


                        <div class="card text-center px-0 border-0">


                            <div class="card-body">
                                <button type="submit" class="btn btn-primary mb-2 btn-pill" <?php if ($ir_state == 2) {
                                                                                                echo "disabled";
                                                                                            } ?>>ອັບເດດ</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <div class="contact-info px-4">
                    <h4 class="mb-1">ລາຍລະອຽດບັນຫາ</h4>
                    <div class="form-group  col-lg-12">
                        <label class="text-dark font-weight-medium">ປະເພດ</label>
                        <h6 class="mb-1"><?php echo "$issue_category"; ?></h6>
                    </div>

                    <div class="form-group  col-lg-12">
                        <label class="text-dark font-weight-medium">ໝວດໝູ່</label>
                        <h6 class="mb-1"><?php echo "$issue_type"; ?></h6>
                    </div>

                    <div class="form-group  col-lg-12">
                        <label class="text-dark font-weight-medium">ການເຄື່ອນໄຫວ</label>
                    </div>

                    <div class="form-group  col-lg-12 mb-1">
                        <?php
                        $stmth = $conn->prepare(" SELECT * FROM tbl_issue_history where ir_id = '$issue_id' order by ih_id asc");
                        $stmth->execute();
                        if ($stmth->rowCount() > 0) {
                            while ($rowh = $stmth->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                                <label class="text-dark font-weight-medium"><?php echo "ວັນທິ: " . $rowh['update_date']; ?></label><br>
                                <label class="text-dark font-weight-medium"><?php echo "ລາຍລະອຽດ: " . $rowh['ih_detail']; ?></label><br>

                        <?php

                            }
                        }


                        ?>

                    </div>





                </div>
            </div>
        </div>
    </div>
</form>