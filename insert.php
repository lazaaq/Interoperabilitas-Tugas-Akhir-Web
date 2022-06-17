<?php
    include 'curl.php';
    // $url = 'http://mykostapp.000webhostapp.com/penghuni.php';
    $url = 'http://192.168.56.69/disa-api/penghuni.php';
    $data = array(
        'nama' => $_POST['name'],
        'asal' => $_POST['city'],
        'kampus' => $_POST['campus'],
        'kamar' => $_POST['room'],
        'no_hp' => $_POST['phone'],
    );
    $response = post_method($url, $data);
    if (!$response) {
        echo '<alert>Gagal menambahkan data</alert>';
    } else {
        echo '<alert>Berhasil menambahkan data</alert>';
    }
    
    header("Location:http://localhost/disa/index.php");
   
?>