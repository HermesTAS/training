
<?php
require_once "core/init.php";

if (isset($_POST["submit"])) {
    $nofaktur = $_POST['nofaktur'];
    $tanggalfaktur   = $_POST['tanggalfaktur'];
    $namapelanggan   = $_POST['namapelanggan'];
    $barang   = $_POST['barang'];
    $harga   = $_POST['harga'];




    $data=[
        "nofaktur"    =>$nofaktur,
        "tanggalfaktur"   =>$tanggalfaktur,
        "namapelanggan"   =>$namapelanggan,
        'barang'=>$barang,
        'harga'=>$harga,
    ];
    if(!empty($nofaktur) && !empty($tanggalfaktur) && !empty($namapelanggan)){

        header("Location: single.php?id=".create($data)[1]);

    }else{
        $error="Data Tidak Lengkap";
    }
}

?>

<form class="" action="" method="post">
    <label for="nofaktur">No Faktur</label><br>
    <input type="text" name="nofaktur" value=""><br><br><br>
    <label for="tanggalfaktur">Tanggal Faktur</label><br>
    <input type="date" name="tanggalfaktur" value=""><br><br><br>
    <label for="namapelanggan">Nama Pelanggan</label><br>
    <input type="text" name="namapelanggan" value=""><br><br><br>

    <div>
        <table  id="barang">
            <tr>
                <td>barang</td>
                <td>harga</td>
            </tr>
            <div>
                <tr>
                    <td><input type="text"  name="barang[]" value=""></td>
                    <td><input type="number"  name="harga[]" value=""></td>
                    <td class="hapus">Remove</td>

                </tr>
            </div>
        </table>

    </div>
    <div class="controls">
        <a href="#" id="tambah">Add More</a>
    </div>

    <br>

    <input type="submit" name="submit" value="submit">
</form>
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
