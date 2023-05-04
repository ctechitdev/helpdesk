
<?php
include('../../setting/conn.php');

$pv_id = $_POST['pv_id'];

echo "<option value='0'> ເລືອກເມືອງ </option>";


$stmt = $conn->prepare(" SELECT ist_id,ist_name FROM tbl_issue_type where isc_id = '$pv_id' order by ist_name  ");
$stmt->execute();
if ($stmt->rowCount() > 0) {
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$ist_id = $row['ist_id'];
		$ist_name = $row['ist_name'];
		echo "<option value='$ist_id'>$ist_name</option>";
	}
}


?> 

