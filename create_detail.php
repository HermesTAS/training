<?php

require_once "core/init.php";
$id = $_GET['id'];
if (isset($_POST["submit"])) {
    $barang = $_POST['barang'];
    $harga = $_POST['harga'];

    $data=[
        "barang" =>$barang,
        "harga" =>$harga,
    ];
    if(!empty($barang) && !empty($harga)){
		if(create_detail($data,$id)){
			header("Location: single.php?id=".$id);
		}else{
		    $error="Ada Masalah di Server";
		}
	}else{
		$error="Data Tidak Lengkap";
	}
}

 ?>

 <form class="" action="" method="post">
     <label for="barang">barang</label><br>
     <input type="text" name="barang" value=""><br><br><br>
     <label for="tanggalfaktur">harga</label><br>
     <input type="number" name="harga" value=""><br><br><br>

     <input type="submit" name="submit" value="submit">
 </form>
