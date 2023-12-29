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
<p><a href="index.php">Beranda</a>
	<form action="tambah-proses.php" method="post">
		<table cellpadding="3" cellspacing="0">
			<tr>
				<td>NIS</td>
				<td>:</td>
				<td><textarea name="_a" id="editor"></textarea></td>
			</tr>
			<tr>
				<td>Kelas</td>
				<td>:</td>
				<td><select name="_b"> 
					<option>Select</option>
					<?php
					include('koneksi.php');
					$q=mysqli_query($koneksi, "SELECT * FROM b");
					while($d=mysqli_fetch_array($q))
					{
						echo "<option value='$d[b0]'> $d[b1] </option>";
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td><input type="submit" name="tambah" value="Tambah"></td>
		</tr>
	</table>
    <script>
        CKEDITOR.replace('editor');
    </script>
</form>
</body>
</html>