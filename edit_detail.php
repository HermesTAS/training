<?php

require_once "core/init.php";

$id = $_GET['id'];
$error ="";
$find = mysqli_fetch_assoc(find($id));
$barang = read_detail($id);
if (isset($_POST["submit"])) {
    $barangs   = $_POST['barang'];
    $harga   = $_POST['harga'];
    $detail_id   = $_POST['detail_id'];
    $data=[
        'barang'=>$barangs,
        'harga'=>$harga,
        'detail_id'=>$detail_id,
    ];
    // var_dump($data);
        if (edit_detail($data,$id)) {
            header("Location: single.php?id=".$id);
        }else {
            $error = "salah";
            // code...
        }

}
 ?>
<a href="index.php">Home</a>

<table>
    <tr>
        <?php echo $error; ?>
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
<form class="" action="" method="post">
    <table id="barang">
        <thead>
            <th>Barang</th>
            <th>Harga</th>
            <th><a href="edit_detail.php?id=<?=$id?>">edit</a></th>
        </thead>
        <tbody>
                <?php while ($kolom = mysqli_fetch_assoc($barang)):?>
                    <tr>
                        <td><input type="text"  name="barang[]" value="<?=$kolom['barang']?>"></td>
                        <td><input type="number"  name="harga[]" value="<?=$kolom['harga']?>"></td>
                        <td class="hapus">
                            <input type="hidden"  name="detail_id[]" value="<?=$kolom['id']?>">
                            Remove
                            <!-- <a href="delete_detail.php?faktur_id=<?=$id?>&id=<?=$kolom['id']?>">Delete</a> -->
                        </td>
                    </tr>
                <?php endwhile;?>
        </tbody>
    </table>
    <input type="submit" name="submit" value="Submit">
</form>

<div class="controls">
    <a href="#" id="tambah">Add More</a>
</div>

<script
src="https://code.jquery.com/jquery-3.6.1.min.js"
integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
crossorigin="anonymous"></script>

<script type="text/javascript">
    $('table').on('click', '.hapus', function () {
        console.log('sadsa');
        $(this).parent().remove();
    });

    $('#tambah').click(function (e) {
        var tr = `<tr class="row">
            <td><input type="text"  name="barang[]" value=""></td>
            <td><input type="number"  name="harga[]" value=""></td>
            <td class="hapus">Remove</td>

        </tr>`;
        $('#barang').append(tr);

    })
</script>
