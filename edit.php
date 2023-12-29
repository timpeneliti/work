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

    <!-- JavaScript for Character Limitation and Autosave -->
    <script>
    $(document).ready(function() {
        function autoSave() {
            console.log("Auto-save triggered");
            
            const formData = {
                'id': $("input[name='id']").val(),
                '_a': CKEDITOR.instances.editor.getData(),
            };

            console.log("Form Data:", formData);
            
            $.post("edit-proses.php", formData, function(response) {
                console.log("Data saved:", response);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.log("Error:", textStatus, errorThrown);
            });
        }

        setInterval(autoSave, 10000);
        
        // CKEditor initialization with tab indentation functionality
        CKEDITOR.replace('editor', {
            tabSpaces: 4,  // 4 spaces for each tab press
            onKeyDown: function(event) {
                if (event.data.keyCode === CKEDITOR.CTRL + 9) {  // Ctrl + Tab
                    event.cancel();
                    this.insertText(new Array(this.config.tabSpaces + 1).join(' '));
                }
            }
        });
    });
    </script>
</head>
<body>
    <p><a href="index.php">Beranda</a> / <a href="tambah.php">Tambah Data</a></p>
    
    <?php
    include('koneksi.php');
    $id = $_GET['id'];
    $show = mysqli_query($koneksi, "SELECT * FROM a WHERE a0='$id'");
    
    if(mysqli_num_rows($show) == 0) {
        echo '<script>window.history.back()</script>';
    } else {
        $data = mysqli_fetch_array($show);
    }
    ?>
    
    <form action="edit-proses.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <table cellpadding="3" cellspacing="0">
            <tr>
                <td>
                    <textarea name="_a" id="editor"><?php echo htmlspecialchars($data["a1"]); ?></textarea>
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="simpan" value="Simpan"></td>
            </tr>
        </table>
    </form>
</body>
</html>
