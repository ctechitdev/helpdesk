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
            $edit_row = $conn->query("
            select ir_id,isc_name,ist_name,ir_detail,request_date,full_name,dp_name,is_name
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

                        <div class="card-body">
                            <h4><?php echo $edit_row['is_name']; ?></h4>
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
                        <label class="text-dark font-weight-medium">ລາຍລະອຽດບັນຫາ</label>
                        <h6 class="mb-1"><?php echo "$ir_detail"; ?></h6>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>