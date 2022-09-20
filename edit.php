<?php

require_once "core/init.php";

$id = $_GET['id'];
$error ="";
if (isset($_POST["submit"])) {
    $nofaktur = $_POST['nofaktur'];
	$tanggalfaktur   = $_POST['tanggalfaktur'];
	$namapelanggan   = $_POST['namapelanggan'];

    $data=[
        "nofaktur"    =>$nofaktur,
        "tanggalfaktur"   =>$tanggalfaktur,
        "namapelanggan"   =>$namapelanggan
    ];
    if(!empty($nofaktur) && !empty($tanggalfaktur) && !empty($namapelanggan)){
		if(update($data,$id)){
			header("Location: index.php");
		}else{
		    $error="Ada Masalah di Server";
		}
	}else{
		$error="Data Tidak Lengkap";
	}
}

$find = mysqli_fetch_assoc(find($id));
 ?>



<?php echo $error; ?>
 <form class="" action="" method="post">
     <label for="nofaktur">No Faktur</label><br>
     <input type="text" name="nofaktur" value="<?=$find['nofaktur'];?>"><br><br><br>
     <label for="tanggalfaktur">Tanggal Faktur</label><br>
     <input type="date" name="tanggalfaktur" value="<?=$find['tanggalfaktur'];?>"><br><br><br>
     <label for="namapelanggan">Nama Pelanggan</label><br>
     <input type="text" name="namapelanggan" value="<?=$find['namapelanggan'];?>"><br><br><br>
     <input type="submit" name="submit" value="submit">
 </form>
