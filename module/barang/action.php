<?php
    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    admin_only("barang", $level);

    $button = isset($_POST['button']) ? $_POST['button'] : $_GET['button'];
    $barang_id = isset($_GET['barang_id']) ? $_GET['barang_id'] : "";

    $nama_barang = isset($_POST['nama_barang']) ? $_POST['nama_barang'] : false;
    $kategori_id = isset($_POST['kategori_id']) ? $_POST['kategori_id'] : false;
    $spesifikasi = isset($_POST['spesifikasi']) ? $_POST['spesifikasi'] : false;
    $harga = isset($_POST['harga']) ? $_POST['harga'] : false;
    $stok = isset($_POST['stok']) ? $_POST['stok'] : false;
    $status = isset($_POST['status']) ? $_POST['status'] : false;

    $update_gambar = "";
    
    
    if(!empty($_FILES["file"]["name"])){
        $nama_file = $_FILES["file"]["name"];
        move_uploaded_file($_FILES["file"]["tmp_name"], "../../images/barang/".$nama_file);

        $update_gambar = ", gambar='$nama_file'";
    }

    if($button=="Add"){
        $insert = mysqli_query($koneksi, "INSERT INTO barang (nama_barang, kategori_id, spesifikasi, gambar, stok, harga, status)
                                                 VALUE ('$nama_barang', '$kategori_id', '$spesifikasi', '$nama_file', '$stok', '$harga', '$status')");
        if($insert){
            header("location:".BASE_URL."index.php?page=my_profile&module=barang&action=list");
        }else{
            header("location:".BASE_URL."GAGALADD.php");
        }
    }else if($button=="Update"){
        $update = mysqli_query($koneksi, "UPDATE barang SET kategori_id='$kategori_id',
                                                            nama_barang='$nama_barang',
                                                            spesifikasi='$spesifikasi',
                                                            harga='$harga',
                                                            stok='$stok',
                                                            status='$status'
                                                            $update_gambar WHERE barang_id='$barang_id'");
        
        if($update){
            header("location:".BASE_URL."index.php?page=my_profile&module=barang&action=list");
        }else{
            header("location:".BASE_URL."index.php?page=my_profile||$kategori_id||$nama_barang||$spesifikasi||$harga||$status||$update_gambar||$stok");
        }
    }else if($button=="Delete"){
        mysqli_query($koneksi, "DELETE FROM barang WHERE barang_id='$barang_id'");
        header("location:".BASE_URL."index.php?page=my_profile&module=barang&action=list");

    }

?>