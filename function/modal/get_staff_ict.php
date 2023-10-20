<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$staffid = $_POST['staffid'];

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

<div class="modal-body pt-0">
    <div class="row no-gutters">



        <div class="col-md-6">
            <div class="profile-content-left px-4">
                <div class="card text-center px-0 border-0">
                    <div class="card-img mx-auto">
                        <img class="rounded-circle" src="../images/user/u6.jpg" alt="user image" />
                    </div>

                    <div class="card-body">
                        <h4 class="py-2">Albrecht Straub</h4>
                        <p>Albrecht.straub@gmail.com</p>

                    </div>
                </div>

                <div class="card text-center px-0 border-0">


                    <div class="card-body">
                        <a class="btn btn-primary btn-pill btn-lg my-4" href="javascript:void(0)">Follow</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="contact-info px-4">
                <h4 class="mb-1">Contact Details</h4>
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
                            ?> <option value="<?php echo $row['isc_id']; ?>"> <?php echo $row['isc_name']; ?></option>
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
                        </select>
                    </div>
                </div>




                <div class="form-group col-lg-12">
                    <label class="text-dark font-weight-medium"> ລາຍລະອຽດບັນຫາ </label>
                    <textarea id="ir_detail" name="ir_detail" class="form-control" cols="30" rows="3" required></textarea>
                </div>
            </div>
        </div>
    </div>
</div>