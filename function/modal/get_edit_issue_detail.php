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

<form id="update-request">
    <div class="modal-body pt-0">
        <div class="row no-gutters">

            <input type="hidden" name="issue_id" value='<?php echo "$issue_id"; ?>'>

            <?php
            $edit_row = $conn->query("SELECT full_name,issue_category_id,ist_id,ir_detail
            FROM tbl_issue_request a
            left join tbl_user b on a.assign_by = b.usid 
            where ir_id = '$issue_id' ")->fetch(PDO::FETCH_ASSOC);

            $issue_category_id = $edit_row['issue_category_id'];
            $issue_type_id = $edit_row['ist_id'];
            $ir_detail = $edit_row['ir_detail'];

            ?>

            <div class="col-md-6">
                <div class="profile-content-left px-4">
                    <div class="card text-center px-0 border-0">
                        <div class="card-img mx-auto">
                            <img src="../images/logo-support.png" alt="user image" />
                        </div>

                        <div class="card-body">
                            <h4><?php echo $edit_row['full_name']; ?></h4>
                        </div>
                    </div>

                    <div class="card text-center px-0 border-0">


                        <div class="card-body">
                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ແກ້ໄຂ</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="contact-info px-4">
                    <h4 class="mb-1">ລາຍລະອຽດບັນຫາ</h4>
                    <div class="form-group  col-lg-12">
                        <label class="text-dark font-weight-medium">ປະເພດ</label>
                        <div class="form-group">
                            <select class=" form-control font" name="isc_id" id="isc_id" required>
                                <option value=""> ເລືອກປະເພດ </option>
                                <?php
                                $stmt = $conn->prepare(" SELECT isc_id ,isc_name FROM tbl_issue_category order by isc_id asc");
                                $stmt->execute();
                                if ($stmt->rowCount() > 0) {
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?> <option value="<?php echo $row['isc_id']; ?>" <?php if ($issue_category_id == $row['isc_id']) {
                                                                                        echo "selected";
                                                                                    } ?>> <?php echo $row['isc_name']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="text-dark font-weight-medium">ໝວດໝູ່</label>
                        <div class="form-group">

                            <select class="form-control  font" name="ist_id" id="ist_id" required>
                                <option value=""> ເລືອກໝວດໝູ່ </option>
                                <?php
                                $stmt1 = $conn->prepare(" SELECT * FROM tbl_issue_type where isc_id = '$issue_category_id' order by ist_id asc");
                                $stmt1->execute();
                                if ($stmt1->rowCount() > 0) {
                                    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                ?> <option value="<?php echo $row1['ist_id']; ?>" <?php if ($issue_type_id ==  $row1['ist_id']) {
                                                                                        echo "selected";
                                                                                    } ?>> <?php echo $row1['ist_name']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>




                    <div class="form-group col-lg-12">
                        <label class="text-dark font-weight-medium"> ລາຍລະອຽດບັນຫາ </label>
                        <textarea id="ir_detail" name="ir_detail" class="form-control" cols="30" rows="3" required><?php echo "$ir_detail";?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>