<?php
include("../setting/checksession.php");
include("../setting/conn.php");


$header_name = "ເພີ່ມລູກຄ້າ";
$header_click = "1";

?>



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
<script>
	$(function() {



		$('#pv_id').change(function() {
			var pv_id = $('#pv_id').val();
			$.post('../function/dynamic_dropdown/get_district_name.php', {
					pv_id: pv_id
				},
				function(output) {
					$('#dis_id').html(output).show();
				});
		});
 

	});
</script>


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




							<div class="">
								<div class=" ">
									<div class="email-body-head mb-5 ">
										<h4 class="text-dark">ເພິ່ມລູກຄ້າ</h4>



									</div>
									<form method="post" id="addcutomerFrm">

										   
										<div class="row">
											<div class="form-group  col-lg-12">
												<label class="text-dark font-weight-medium">ປະເພດບັນຫາ</label>
												<div class="form-group">
													<select class=" form-control font" name="pv_id" id="pv_id">
														<option value=""> ເລືອກປະເພດບັນຫາ </option>
														<?php
														$stmt = $conn->prepare(" SELECT isc_id ,isc_name FROM tbl_issue_category order by isc_name");
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
												<label class="text-dark font-weight-medium">ປະເພດລະບົບ</label>
												<div class="form-group">

													<select class="form-control  font" name="dis_id" id="dis_id">
														<option value=""> ເລືອກເມືອງ </option>
													</select>
												</div>
											</div>
 
 
										</div>


 

									</form>


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

	  

</body>

</html>