<?php

require_once "core/init.php";

$id = $_GET['id'];
$error ="";
$find = mysqli_fetch_assoc(find($id));
$barang = read_detail($id);
 ?>
<?php echo $error; ?>
<a href="index.php">Home</a>

<table>
    <tr>
        <td><b>No Faktur</b></td>
        <td><?=$find['nofaktur']?></td>
    </tr>
    <tr>
        <td><b>Tanggal Faktur</b></td>
        <td><?=$find['tanggalfaktur']?></td>
    </tr>
    <tr>
        <td><b>Nama Pelanggan</b></td>
        <td><?=$find['namapelanggan']?></td>
    </tr>
</table>
<br><br>
<table>
    <thead>
        <th>no Faktur</th>
        <th>Barang</th>
        <th>Harga</th>
        <th><a href="edit_detail.php?id=<?=$id?>">edit</a></th>
    </thead>
    <tbody>
        <?php while ($kolom = mysqli_fetch_assoc($barang)):?>
        <tr >
            <td><?=$find['nofaktur']?></td>
            <td><?=$kolom['barang']?></td>
            <td><?=$kolom['harga']?></td>
            <td>
                <a href="delete_detail.php?faktur_id=<?=$id?>&id=<?=$kolom['id']?>">Delete</a>
            </td>
        </tr>
        <?php endwhile;?>
    </tbody>
</table>
<br>
<a href="create_detail.php?id=<?=$id?>">Tambah Barang</a>
