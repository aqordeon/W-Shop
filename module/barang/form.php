<?php
    $barang_id = isset($_GET['barang_id']) ? $_GET['barang_id'] : false;

    $nama_barang = "";
    $kategori_id = "";
    $spesifikasi = "";
    $gambar = "";
    $stok = "";
    $harga = "";
    $status = "";
    $button = "Add";

    if($barang_id){
        $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id='$barang_id'");
        $row = mysqli_fetch_assoc($query);

        $nama_barang = $row['nama_barang'];
        $kategori_id = $row['kategori_id'];
        $spesifikasi = $row['spesifikasi'];
        $gambar = $row['gambar'];
        $stok = $row['stok'];
        $harga = $row['harga'];
        $status = $row['status'];
        $button = "Update";

        $gambar = "<img src='".BASE_URL."images/barang/$gambar' style='width: 200px; vertical-align: middle' />"; 
    }
?>

<script src="<?php echo BASE_URL . 'js/ckeditor/ckeditor.js'; ?>"></script>

<form action="<?php echo BASE_URL . 'module/barang/action.php?barang_id=' . $barang_id;?>" method="POST" enctype="multipart/form-data">
    <div class="element-form">
        <label>Kategori</label>
        <span>
            <select name="kategori_id" id="">
            <?php
                $query = mysqli_query($koneksi, "SELECT kategori_id,kategori FROM kategori WHERE status='on' ORDER BY kategori ASC");
                while($row = mysqli_fetch_assoc($query)){
                    if($kategori_id == $row['kategori_id']){
                        echo "<option value='$row[kategori_id]' selected>$row[kategori]</option>";
                    }else{
                        echo "<option value='$row[kategori_id]'>$row[kategori]</option>";
                    }
                }
            ?>
            <!-- <select name="kategori_id" id="">
                <option value="A">Ayam</option>
                <option value="S" selected>Sapi</option>
                <option value="K">Kambing</option>
            </select> -->
            </select>
        </span>
    </div>


    <div class="element-form">
        <label>Nama Barang</label>
        <span><input type="text" name="nama_barang" value="<?php echo $nama_barang; ?>"></span>
    </div>

    <div class="" style="margin-bottom: 10px;">
        <label style="font-weight: bold;">Spesifikasi</label>
        <span><textarea name="spesifikasi" id="editor" cols="30" rows="10"><?php echo $spesifikasi; ?></textarea></span>
    </div>

    <div class="element-form">
        <label>Harga</label>
        <span><input type="text" name="harga" value="<?php echo $harga; ?>"></span>
    </div>

    <div class="element-form">
        <label>Stok</label>
        <span><input type="text" name="stok" value="<?php echo $stok; ?>"></span>
    </div>

    <div class="element-form">
        <label>Gambar Produk</label>
        <span>
            <input type="file" name="file" /> <?php echo $gambar; ?>
        </span>
    </div>

    <div class="element-form">
        <label>Status</label>
        <span>
            <input type="radio" name="status" value="on" <?php if($status=="on"){ echo "checked";} ?> /> On
            <input type="radio" name="status" value="off" <?php if($status=="off"){ echo "checked";} ?>/> Off
        </span>
    </div>

    <div class="element-form">
        <span><input type="submit" name="button" value="<?php echo $button; ?>"></span>
    </div>
</form>

<script>
    // CKEDITOR.replace("editor");
    var roxyFileman = 'js/ckeditor/fileman/index.html'; 
    $(function(){
    CKEDITOR.replace( 'editor',{filebrowserBrowseUrl:roxyFileman,
                                    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                    removeDialogTabs: 'link:upload;image:upload'}); 
    });
</script>