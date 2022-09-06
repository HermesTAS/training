<?php



function create_transaksi($data)
{
    $nofaktur   = strtoupper($data['nofaktur']);
    $tanggalfaktur  = $data['tanggalfaktur'];
    $namapelanggan  = strtoupper($data['namapelanggan']);
    $gender_id  = strtoupper($data['gender_id']);
    $phone  = $data['phone'];
    $saldo  = $data['saldo'];
    $address    = strtoupper($data['address']);
    $saldo = substr($saldo,4);
    $saldo = str_replace(".","",$saldo);
    $tanggalfaktur = date("Y-m-d", strtotime($tanggalfaktur));
    $phone = str_replace("_","",$phone);
    if(substr($phone,-1) == "-"){
        $phone = substr_replace($phone ,"",-1);
    }
    $qry= "INSERT INTO transaksi (nofaktur,tanggal,nama,gender_id,phone,saldo,address)
        VALUES('$nofaktur','$tanggalfaktur','$namapelanggan','$gender_id','$phone','$saldo','$address')";

    global $konek;
    run($qry);
}

function find_transaksi($id)
{
    $qry= "SELECT * FROM transaksi where id = $id";
    return result($qry);
}
function delete_transaksi($id)
{
    $qry= "SELECT * FROM transaksi where id = $id";
    if (run($qry)) {
        $qry= "DELETE FROM transaksi WHERE id = $id";
        return run($qry);
    }
}

function update_transaksi($data,$id)
{
    $qry= "SELECT * FROM transaksi where id = $id";
    if (run($qry)) {
        $nofaktur   = strtoupper($data['nofaktur']);
        $tanggalfaktur  = $data['tanggal'];
        $namapelanggan  = strtoupper($data['nama']);
        $gender_id  = $data['gender_id'];
        $phone  = strtoupper($data['phone']);
        $saldo  = strtoupper($data['saldo']);
        $address    = strtoupper($data['address']);
        $saldo = substr($saldo,4);
        $saldo = str_replace(".","",$saldo);
        $tanggalfaktur = date("Y-m-d", strtotime($tanggalfaktur));
        $phone = str_replace("_","",$phone);
        if(substr($phone,-1) == "-"){
            $phone = substr_replace($phone ,"",-1);
        }
         $qry=  "UPDATE transaksi SET
        nofaktur='$nofaktur',
        tanggal='$tanggalfaktur',
        nama='$namapelanggan',
        phone='$phone',
        gender_id='$gender_id',
        saldo='$saldo',
        address='$address'
        where id = $id";
        global $konek;
        run($qry);

    }
}

 ?>
