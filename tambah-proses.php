<?php
if (isset($_POST['tambah'])) {
    include('koneksi.php'); // Ensure this file contains your database connection setup

    // Prevent SQL Injection by escaping special characters
    $_1 = mysqli_real_escape_string($koneksi, $_POST['_a']);

    try {
        // Check if the connection is still alive; if not, reconnect
        if (!mysqli_ping($koneksi)) {
            mysqli_close($koneksi);
            include('koneksi.php'); // Reconnect by including the connection file again
        }

        // Prepare and execute the query
        $query = "INSERT INTO a VALUES(0, '$_1')";
        $input = mysqli_query($koneksi, $query);

        // Check if the query was successful
        if ($input) {
            echo 'Data berhasil ditambahkan!';
            echo '<a href="tambah.php">Kembali</a>';
        } else {
            throw new Exception(mysqli_error($koneksi)); // Throw an exception with the error message
        }
    } catch (Exception $e) {
        // Handle the exception gracefully
        echo 'Gagal menambahkan data! Error: ' . $e->getMessage();
        echo '<a href="tambah.php">Kembali</a>';
    }
} else {
    echo '<script>window.history.back()</script>';
}
?>
