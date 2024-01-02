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

$searchTerm = isset($_POST['searchTerm']) ? strtolower($_POST['searchTerm']) : '';

$sql = "SELECT * FROM a";
$result = $conn->query($sql);

$data = [];
$found = false;

while($row = $result->fetch_assoc()) {
    $content = strtolower($row['a1']); // Convert content to lowercase

    if (strpos($content, $searchTerm) !== false) { // Check for substring match
        $found = true;
        $data[] = $row;
    }
}

if (!$found) {
    echo json_encode(['items' => [], 'totalItems' => 0]);
    exit();
}

// Slice the data based on pagination
$data = array_slice($data, $offset, $itemsPerPage);

$totalItems = count($data);

$response = [
    'items' => $data,
    'totalItems' => $totalItems
];

echo json_encode($response);

$conn->close();
?>
