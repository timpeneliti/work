<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "work";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$page = isset($_POST['page']) ? $_POST['page'] : 1;
$itemsPerPage = isset($_POST['itemsPerPage']) ? $_POST['itemsPerPage'] : 5;
$offset = ($page - 1) * $itemsPerPage;

$searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

$sql = "SELECT * FROM a WHERE a1 LIKE '%$searchTerm%' LIMIT $offset, $itemsPerPage";
$result = $conn->query($sql);

$data = [];
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$totalItemsSql = "SELECT COUNT(*) as count FROM a WHERE a1 LIKE '%$searchTerm%'";
$totalItemsResult = $conn->query($totalItemsSql);
$totalItems = $totalItemsResult->fetch_assoc()['count'];

$response = [
    'items' => $data,
    'totalItems' => $totalItems
];

echo json_encode($response);

$conn->close();
?>
