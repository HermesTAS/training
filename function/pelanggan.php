<?php

function create($data)
{
    $nofaktur = $data['nofaktur'];
    $tanggalfaktur = $data['tanggalfaktur'];
    $namapelanggan = $data['namapelanggan'];
    $qry= "INSERT INTO faktur (nofaktur,tanggalfaktur,namapelanggan) VALUES('$nofaktur','$tanggalfaktur','$namapelanggan')";
    global $konek;
    if (run($qry)) {
        $id = mysqli_insert_id($konek);
        if (isset($data['barang'])) {
            for ($i=0; $i < count($data['barang']); $i++) {
                echo $data['barang'][$i];
                $detail=[
                    "barang" =>$data['barang'][$i],
                    "harga" =>$data['harga'][$i],
                ];
                create_detail($detail,$id);
            }
            return [true,$id];

        }
    }
}

function read()
{
    $qry= "SELECT * FROM transaksi";
    return result($qry);
}

function find($id)
{
    $qry= "SELECT * FROM faktur where id = $id";
    return result($qry);
}

function update($data,$id)
{
    $nofaktur = $data['nofaktur'];
    $tanggalfaktur = $data['tanggalfaktur'];
    $namapelanggan = $data['namapelanggan'];

    $check = "SELECT * FROM faktur where id = $id";
    if (run($check)) {
        $qry= "UPDATE `faktur` SET  `nofaktur`= '$nofaktur',`tanggalfaktur`='$tanggalfaktur',`namapelanggan`='$namapelanggan' WHERE id = $id ";
        return run($qry);
    }
    return run($show);
}

function delete($id) {
    $check = "SELECT * FROM faktur where id = $id";
    if (run($check)) {
        $qry= "DELETE FROM `faktur` WHERE id = $id";
        return run($qry);
    }
}

function read_detail($id)
{
    $qry= "SELECT * FROM transaksi_detail where transaksi_id = '$id'";
    return result($qry);
}
function edit_detail($data,$id)
{
    $qry="";
    $check = "SELECT * FROM transaksi where id = $id";
    if (run($check)) {
        $delete_qry= "DELETE FROM `transaksi_detail` WHERE transaksi_id = $id";
        run($delete_qry);
        for ($i=0; $i < count($data); $i++) {
            $insert = [
                "barang" => $data[$i]['barang'],
                "harga" => $data[$i]['harga'],
                "qty" => $data[$i]['qty'],
            ];
            create_detail($insert,$id);
        }
        return 1;
        // echo $qry;
    }

}
function create_detail($data,$id)
{
    $barang  = strtoupper($data['barang']);
    $qty  = strtoupper($data['qty']);

    $harga = $data['harga'];
    $harga = str_replace("idr ","",$harga);
    // $harga = substr($harga,4);
    $harga = str_replace(".","",$harga);

    $check = "SELECT * FROM transaksi where id = $id";
    if (run($check)) {
        $transaksi_id = $id;
        $qry= "INSERT INTO transaksi_detail (barang,harga,quantity,transaksi_id) VALUES('$barang','$harga','$qty','$transaksi_id')";
        return run($qry);
    }
    return run($show);
}


function delete_detail ($id) {
    $check = "SELECT * FROM transaksi_detail where id = $id";
    if (run($check)) {
        $qry= "DELETE FROM `transaksi_detail` WHERE id = $id";
        return run($qry);
    }
    return run($show);
}

function run($qry){
	global $konek;

	if(mysqli_query($konek,$qry))return true;
	else return false;
}
function result($qry){
	global $konek;
	$show= mysqli_query($konek,$qry) or die("Maaf Ada Kesalahan di Server Kami");
	return $show;
}


 ?>
