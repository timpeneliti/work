<!DOCTYPE html>
<html>
<head>
    <title>Work Instruction</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.png">

    <!-- Bootstrap CSS -->
    <link href="assets/bootstrap.min.css" rel="stylesheet">

    <!-- Other CSS styles -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/datepicker.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="assets/js/dataTables/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- CKEditor Script -->
    <script src="assets/js/ckeditor/ckeditor.js"></script>

    <!-- Main JavaScript files -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</head>
<body>

<!-- Input field for searching -->
<input type="text" id="searchInput" placeholder="Search for data...">

<p><a href="tambah.php">Tambah Data</a></p>

<table cellpadding="5" cellspacing="0" border="1" id="dataTable">
    <tr bgcolor="#CCCCCC">
        <th>No</th>
        <th>Data</th>
        <th>Option</th>
    </tr>
</table>

<!-- Pagination div -->
<div id="pagination"></div>

<script>
$(document).ready(function() {
    function fetchData(searchTerm = '') {
        $.ajax({
            url: 'search_data.php',
            type: 'POST',
            data: { searchTerm: searchTerm },
            dataType: 'json',
            success: function(data) {
                let tableContent = '';
                data.forEach((item, index) => {
                    tableContent += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.a1}</td>
                            <td><a href="edit.php?id=${item.a0}">Edit</a> / <a href="hapus.php?id=${item.a0}" onclick="return confirm('Yakin?')">Hapus</a></td>
                        </tr>
                    `;
                });
                $('#dataTable').html(tableContent);
            }
        });
    }

    // Fetch data on page load (without search term)
    fetchData();

    // Handle search input changes
    $('#searchInput').on('input', function() {
        const searchTerm = $(this).val();
        fetchData(searchTerm);
    });
});
</script>

</body>
</html>
