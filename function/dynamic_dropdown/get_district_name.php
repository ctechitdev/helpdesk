
<?php
include('../../setting/conn.php');

$isc_id = $_POST['isc_id'];

echo "<option value='0'> ເລືອກປະເພດ </option> " ;



$stmt = $conn->prepare(" SELECT ist_id,ist_name FROM tbl_issue_type where isc_id = '$isc_id' order by ist_name  ");
$stmt->execute();
if ($stmt->rowCount() > 0) {
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$ist_id = $row['ist_id'];
		$ist_name = $row['ist_name'];
		echo "<option value='$ist_id'>$ist_name</option>";
	}
}


?> 

