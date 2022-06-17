<?php
    include 'curl.php';

    if ( isset($_POST['submit']) ) {
        if ( !isset($_POST['name']) ) {
            echo "<script> alert('Silahkan masukkan nama dengan benar !') </script>";
        } else if ( !isset($_POST['city']) ){
            echo "<script> alert('Silahkan masukkan kota asal dengan benar !') </script>";
        } else if ( !isset($_POST['campus']) ) {
            echo "<script> alert('Silahkan masukkan nama kampus penghuni dengan benar !') </script>";
        } else if ( !isset($_POST['phone']) ) {
            echo "<script> alert('Silahkan masukkan nomor HP penghuni dengan benar !') </script>";
        } else if ( !isset($_POST['room'])){
            echo "<script> alert('Silahkan pilih kamar dengan benar !') </script>";
        }

        // $checkData = get_method('https://mykostapp.000webhostapp.com/penghuni.php');
        $checkData = get_method('http://192.168.56.69/disa-api/penghuni.php');

        if ( count($checkData['data']) > 0 ) {

            $id = $_POST['id'];
            $nama = $_POST['name'];
            $asal = $_POST['city'];
            $kampus = $_POST['campus'];
            $no = $_POST['phone'];
            $kamar = $_POST['room'];
            $data = array(
                'nama' => $nama,
                'asal' => $asal,
                'kampus' => $kampus,
                'no_hp' => $no,
                'kamar' => $kamar
            );

            // $result = post_method('https://mykostapp.000webhostapp.com/penghuni.php?id_update=' . $id, $data);
            $result = post_method('http://192.168.56.69/disa-api/penghuni.php?id_update=' . $id, $data);

            if ( $result ) {
                echo "<script> alert('Berhasil mengubah data penghuni kos !') </script>";
                header("Location:http://localhost/disa/index.php");
            } else {
                echo "<script> alert('Pengubahan data gagal !') </script>";
            }
            
        } else {
            echo "<script> alert('Tidak ada data dalam database !') </script>";
        }

    } else {
        echo "<script> Anda belum memasukkan data ! </script> ";
    }
?>