
<?php
include('../../setting/conn.php');

$isc_id = $_POST['isc_id'];

echo "<option value='0'> ເລືອກປະເພດ </option>";


<<<<<<< HEAD
$stmt = $conn->prepare(" SELECT ist_id,ist_name FROM tbl_issue_type where isc_id = '$isc_id' order by ist_name  ");
=======
$stmt = $conn->prepare(" SELECT ist_id,ist_name FROM tbl_issue_type where isc_id = '$pv_id' order by ist_name  ");
>>>>>>> 1c2919929b75a8d88242433fb1daa4e4017afb42
$stmt->execute();
if ($stmt->rowCount() > 0) {
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$ist_id = $row['ist_id'];
		$ist_name = $row['ist_name'];
		echo "<option value='$ist_id'>$ist_name</option>";
	}
}


?> 

