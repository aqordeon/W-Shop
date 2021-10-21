<?php
    $search = isset($_GET["search"]) ? $_GET["search"] : false;

    $where = "";
    $search_url = "";
    if($search){
        $search_url = "&search=$search";
        $where = "WHERE barang.nama_barang LIKE '%$search%'";
    }
?>

<div id="frame-tambah">
    <div id="left">
        <form action="<?php echo BASE_URL . "index.php"; ?>" method="GET">
            <input type="hidden" name="page" value="<?php echo $_GET['page']; ?>" />
            <input type="hidden" name="module" value="<?php echo $_GET['module']; ?>" />
            <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>" />
            <input type="text" name="search" value="<?php echo $search; ?>"/>
            <input type="submit" value="Search" />
        </form>
    </div>
    <div id="right">
        <a href="<?php echo BASE_URL.'index.php?page=my_profile&module=barang&action=form'; ?>" class="tombol-action">+ Tambah Barang</a>
    </div>
</div>

<?php
    
    $pagination = isset($_GET["pagination"]) ? $_GET["pagination"] : 1;
    $data_per_halaman = 5;
    $mulai_dari = ($pagination-1) * $data_per_halaman;

    $query = mysqli_query($koneksi, "SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id=kategori.kategori_id $where ORDER BY barang.barang_id DESC LIMIT $mulai_dari, $data_per_halaman");

    if(mysqli_num_rows($query) == 0){
        echo "<h3>Saat ini belum ada barang di dalam table barang</h3>";
    }else{
        echo "<table class='table-list'>";
        echo    "<tr class='baris-title'>
                    <th class='kolom-nomor'>No</th>
                    <th class='kiri'>Barang</th>
                    <th class='kiri'>Kategori</th>
                    <th class='kiri'>Harga</th>
                    <th class='tengah'>Status</th>
                    <th class='tengah'>Action</th>
                </tr>";
                
        $no = 1 + $mulai_dari;
        while($row = mysqli_fetch_assoc($query)){ ?>
            <tr>
                <td class='kolom-nomor'><?php echo $no; ?></td>
                <td class='kiri'><?php echo $row['nama_barang']; ?></td>
                <td class='kiri'><?php echo $row['kategori']; ?></td>
                <td class='kiri'><?php echo rupiah($row['harga']); ?></td>
                <td class='tengah'><?php echo $row['status']; ?></td>
                <td class='tengah'>
                    <a href="<?php echo BASE_URL.'index.php?page=my_profile&module=barang&action=form&barang_id='.$row['barang_id']; ?>" class="tombol-action"> EDIT </a>
                    <a href="<?php echo BASE_URL.'module/barang/action.php?button=Delete&barang_id='.$row['barang_id']; ?>" class="tombol-action"> DELETE </a>
                </td>
<?php       $no++;
        }
        echo "</table>";
        $queryHitungBarang = mysqli_query($koneksi, "SELECT * FROM barang $where");
        pagination($queryHitungBarang, $data_per_halaman, $pagination, "index.php?page=my_profile&module=barang&action=list$search_url");
    }

?>
