<?php
    $pesanan_id = $_GET["pesanan_id"];

    $query = mysqli_query($koneksi, "SELECT status FROM pesanan WHERE pesanan_id='$pesanan_id'");
    $row = mysqli_fetch_assoc($query);
    $status = $row['status'];
?>

<form action="<?php echo BASE_URL . 'module/pesanan/action.php?pesanan_id=' . $pesanan_id; ?>" method="POST">
    <div class="element-form">
        <label for="">Pesanan Id (Faktur Id)</label>
        <span><input type="text" value="<?php echo $pesanan_id; ?>" name="pesanan_id" readonly></span>
    </div>

    <div class="element-form">
        <label for="">Status</label>
        <span>
            <select name="status" id="">
                <?php
                    foreach($arrayStatusPesanan AS $key => $value){
                        if($status  == $key){
                            echo "<option value='$key' selected>$value</option>";
                        }else{
                            echo "<option value='$key'>$value</option>";
                        }
                    }
                ?>
            </select>
        </span>
    </div>

    <div class="element-form">
        <span><input type="submit" class="tombol-action" value="Edit Status" name="button" /></span>
    </div>

</form>