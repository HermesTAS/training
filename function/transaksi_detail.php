<?php

function find($id)
{
    $qry= "SELECT * FROM faktur where id = $id";
    return result($qry);
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
        $all_query_ok=true;

        $delete_qry= "DELETE FROM `transaksi_detail` WHERE transaksi_id = $id";
        run($delete_qry);
        for ($i=0; $i < count($data); $i++) {
            $insert = [
                "barang" => $data[$i]['barang'],
                "harga" => $data[$i]['harga'],
                "qty" => $data[$i]['qty'],
            ];
            create_detail($insert,$id) ? null : $all_query_ok=false;
        }
    }else {
        $all_query_ok=false;
    }
    return $all_query_ok;
}
function create_detail($data,$id)
{
    $barang  = strtoupper($data['barang']);
    $qty  = strtoupper($data['qty']);

    $harga = $data['harga'];
    $harga = str_replace("idr ","",$harga);
    $harga = str_replace(".","",$harga);

    $check = "SELECT * FROM transaksi where id = $id";
    if (run($check)) {
        $transaksi_id = $id;
        $qry= "INSERT INTO transaksi_detail (barang,harga,quantity,transaksi_id) VALUES('$barang','$harga','$qty','$transaksi_id')";
        return run($qry);
    }
    return run($check);
}


function delete_detail ($id) {
    $check = "SELECT * FROM transaksi_detail where id = $id";
    if (run($check)) {
        $qry= "DELETE FROM `transaksi_detail` WHERE id = $id";
        return run($qry);
    }
    return run($check);
}




 ?>
