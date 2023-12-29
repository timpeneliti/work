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

    <!-- JavaScript for Character Limitation -->
    <script>
        // Your JavaScript functions for character limitation
        // ...
    </script>
</head>
<body>

<!-- Input field for searching -->
<input type="text" id="searchInput" placeholder="Search for data...">

<p><a href="tambah.php">Tambah Data</a></p>

<table cellpadding="5" cellspacing="0" border="1">
    <tr bgcolor="#CCCCCC">
        <th>No</th>
        <th>a</th>
        <th>b</th>
        <th>Opsi</th>
    </tr>
    <?php
    include('koneksi.php');
    $query = mysqli_query($koneksi, "SELECT * FROM a LEFT JOIN b ON a.a2 = b.b0 ORDER BY a0 ASC") or die(mysqli_error());
    if(mysqli_num_rows($query) == 0){
        echo '<tr><td colspan="4">Tidak ada data!</td></tr>';
    }
    else{
        $no = 1;
        while($data = mysqli_fetch_assoc($query)){
            echo '<tr>';
            echo '<td>'.$no.'</td>';
            echo '<td>'.$data['a1'].'</td>';
            echo '<td>'.$data['b1'].'</td>';
            echo '<td><a href="edit.php?id='.$data['a0'].'">Edit</a> / <a href="hapus.php?id='.$data['a0'].'" onclick="return confirm(\'Yakin?\')">Hapus</a></td>';
            echo '</tr>';
            $no++;
        }
    }
    ?>
</table>

<!-- Pagination div -->
<div id="pagination"></div>

<script>
$(document).ready(function(){
    // Search functionality
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("table tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Pagination
    var rowsShown = 10;
    var rowsTotal = $('table tbody tr').length;
    var numPages = rowsTotal/rowsShown;
    for(i = 0;i < numPages;i++) {
        var pageNum = i + 1;
        $('#pagination').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
    }
    $('table tbody tr').hide();
    $('table tbody tr').slice(0, rowsShown).show();
    $('#pagination a:first').addClass('active');
    $('#pagination a').bind('click', function(){
        $('#pagination a').removeClass('active');
        $(this).addClass('active');
        var currPage = $(this).attr('rel');
        var startItem = currPage * rowsShown;
        var endItem = startItem + rowsShown;
        $('table tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
        css('display','table-row').animate({opacity:1}, 300);
    });
});
</script>

</body>
</html>
