<?php
// require_once "core/init.php";

function create_transaksi($data)
{
    global $konek;
    mysqli_begin_transaction($konek);
    $all_query_ok = true;

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
    $qry= "INSERT INTO transaksi (nofaktur,tanggal,nama,gender_id,phone,saldo,address) VALUES('$nofaktur','$tanggalfaktur','$namapelanggan','$gender_id','$phone','$saldo','$address')";
    
    
    if (mysqli_query($konek,$qry)) {
        $all_query_ok=true;

        $id = mysqli_insert_id($konek);
        if (isset($data['barang'])) {
            for ($i=0; $i < count($data['barang']); $i++) {
                $detail=[
                    "barang" =>$data['barang'][$i],
                    "harga" =>$data['harga'][$i],
                    "qty" =>$data['qty'][$i],
                ];
                create_detail($detail,$id)? null : $all_query_ok=false;
                

            }

        }
    }else {
        $all_query_ok=false;
    }

    if ($all_query_ok) {
        mysqli_commit($konek);
        return true;
    }else {
        mysqli_rollback($konek);
        return false;
    }
}

function find_transaksi($id)
{
    $qry= "SELECT * FROM transaksi where id = $id";
    return result($qry);
}

function update_transaksi($data,$id)
{
    global $konek;
    mysqli_begin_transaction($konek);
    $all_query_ok = true;

    $qry= "SELECT * FROM transaksi where id = $id";
    $detail=[];
    if (run($qry)) {
        $nofaktur   = strtoupper($data['nofaktur']);
        $tanggalfaktur  = $data['tanggal'];
        $namapelanggan  = strtoupper($data['nama']);
        $gender_id  = $data['gender_id'];
        $phone  = strtoupper($data['phone']);
        $saldo  = strtoupper($data['saldo']);
        $address    = strtoupper($data['address']);
        // $saldo = substr($saldo,4);
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
        if (mysqli_query($konek,$qry)) {
            $all_query_ok=true;
            if (isset($data['barang'])) {
                for ($i=0; $i < count($data['barang']); $i++) {
                    $detail[]=[
                        "barang" =>$data['barang'][$i],
                        "harga" =>$data['harga'][$i],
                        "qty" =>$data['qty'][$i],
                    ];
                }
                // return $detail;
                edit_detail($detail,$id)? null : $all_query_ok=false;
            }
        }
    }
    if ($all_query_ok) {
        mysqli_commit($konek);
        return true;
    }else {
        mysqli_rollback($konek);
        return false;
    }
}

function delete_transaksi($id)
{
    global $konek;
    mysqli_begin_transaction($konek);
    $all_query_ok = true;
    $qry= "SELECT * FROM transaksi where id = $id";
    if (run($qry)) {
        $qry= "DELETE FROM transaksi WHERE id = $id";
        return run($qry);
    }else{
        $all_query_ok = false;
    }

    if ($all_query_ok) {
        mysqli_commit($konek);
        return true;
    }else {
        mysqli_rollback($konek);
        return false;
    }
}

function testtrans($data)
{
    global $konek;
    
    $qry= "INSERT INTO trans (nama,umur,phone) VALUES ('{$data['nama']}','{$data['umur']}','{$data['phone']}')";
    return run($qry);
    return mysqli_query($konek,$qry);
}

?>
