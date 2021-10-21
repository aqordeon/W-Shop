<?php
    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");

    admin_only("kategori", $level);
    
    $button = isset($_POST['button']) ? $_POST['button'] : $_GET['button'];
    $kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : "";

    $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : "";
    $status = isset($_POST['status']) ? $_POST['status'] : "";
    

    if($button=="Add"){
        $insert = mysqli_query($koneksi, "INSERT INTO kategori (kategori, status) VALUE ('$kategori','$status')");
        if($insert){
            header("location:".BASE_URL."index.php?page=my_profile&module=kategori&action=list");
        }else{
            header("location:".BASE_URL."index.php");
        }
    }else if($button=="Update"){
        $update = mysqli_query($koneksi, "UPDATE kategori SET   kategori='$kategori',
                                                                status='$status' WHERE kategori_id='$kategori_id'");
        if($update){
            header("location:".BASE_URL."index.php?page=my_profile&module=kategori&action=list");
        }else{
            header("location:".BASE_URL."index.php");
        }
    }else if($button=="Delete"){
        mysqli_query($koneksi, "DELETE FROM kategori WHERE kategori_id='$kategori_id'");
        header("location:".BASE_URL."index.php?page=my_profile&module=kategori&action=list");

    }


?>