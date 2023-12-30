<?php
include('koneksi.php');

$searchTerm = $_POST['searchTerm'];

$query = "SELECT * FROM a WHERE a1 LIKE '%$searchTerm%' ORDER BY a0 ASC";
$result = mysqli_query($koneksi, $query) or die(mysqli_error());

$data = [];

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

echo json_encode($data);
?>
