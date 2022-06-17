<?php
    include 'curl.php';
    
    if ( isset($_POST['submit']) ) {
        $id = $_POST['id'];
        // $response = post_method('https://mykostapp.000webhostapp.com/penghuni.php?id_delete=' . $id, $data=null);
        $response = post_method('http://192.168.56.69/disa-api/penghuni.php?id_delete=' . $id, $data=null);

        if ($response) {
            header("Location:http://localhost/disa/index.php");
        } else {
            echo "<script> alert('Penghapusan data gagal !') </script>";
        }
    } else {
        echo "<script> alert(' Belum melakukan penghapusan !') </script>";
    }
?>