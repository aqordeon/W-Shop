<?php

    if($user_id == false){
        $_SESSION["proses_pesanan"] = true;
        header("location:" . BASE_URL . "login.html");
        exit;
    }

?>

<div id="frame-data-pengiriman">
    <h3 class="label-data-pengiriman">Alamat pengiriman</h3>
    <div id="frame-form-pengiriman">
        <form action="<?php echo BASE_URL . "proses_pemesanan.php"; ?>" method="POST">
            <div class="element-form">
                <label>Nama Penerima</label>
                <span><input type="text" name="nama_penerima" placeholder="Nama penerima" /></span>
            </div>

            <div class="element-form">
                <label>Nomor Telepon</label>
                <span><input type="text" name="nomor_telepon" placeholder="Nomor telepon" /></span>
            </div>

            <div class="element-form">
                <label>Alamat Penerima</label>
                <span><textarea name="alamat" id="" cols="30" rows="10"></textarea></span>
            </div>

            <div class="element-form">
                <label>Kota</label>
                <span>
                    <select name="kota" id="">
                        <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM kota");
                            
                            while($row = mysqli_fetch_assoc($query)){
                                echo "<option value='$row[kota_id]'>$row[kota] (" . rupiah($row['tarif']) . ")</option>";
                            }
                        ?>
                    </select>
                </span>
            </div>

            <div class="element-form">
                <span><input type="submit" value="Submit" /></span>
            </div>
        </form>
    </div>
</div>

<div id="frame-data-detail">
    <h3 class="label-data-pengiriman">Detail Order</h3>
    <div id="frame-detail-order">
        <table class="table-list">
            <tr>
                <th class="kiri">Nama Barang</th>
                <th class="tengah">Quantity</th>
                <th class="kanan">Total</th>
            </tr>
            
            <?php
                $subtotal = 0;
                foreach($keranjang AS $key => $value){
                    $barang_id = $key;

                    $nama_barang = $value['nama_barang'];
                    $harga = $value['harga'];
                    $quantity = $value['quantity'];
                    $total = $quantity * $harga;
                    $subtotal = $subtotal + $total;

                    echo "<tr>
                            <td class='kiri'>$nama_barang</td>
                            <td class='tengah'>$quantity</td>
                            <td class='kanan'>" . rupiah($total) . "</td>
                        </tr>";
                }

                echo "<tr>
                        <td colspan='2' class='kanan'><b>Sub Total</b></td>
                        <td class='kanan'><b>" . rupiah($subtotal) . "</b></td>
                    </tr>";
            ?>
        
        </table>
    </div>
</div>