<?php
require_once "core/init.php";
function report()
{
    global $konek;
    $pelanggan = read();
    $search="";
    if (isset($_REQUEST['global_search']) && strlen($_REQUEST['global_search'])) {
        $global_search = $_REQUEST['global_search'];
        $search .=" transaksi.nofaktur like '%$global_search%' or";
        $search .=" tanggal like '%$global_search%' or";
        $search .=" transaksi.nama like '%$global_search%' or";
        $search .=" gender.nama like '%$global_search%' or";
        $search .=" transaksi.phone like '%$global_search%' or";
        $search .=" transaksi.address like '%$global_search%' or";
        $search .=" transaksi.saldo like '%$global_search%' ";
    }else{
        if(isset($_REQUEST['nofaktur'])){
            $nofaktur = $_REQUEST['nofaktur'];
            $search .=" transaksi.nofaktur like '%$nofaktur%' and";
        }
        if(isset($_REQUEST['tanggal'])){
            $tanggal = date("Y-m-d", strtotime($_REQUEST['tanggal']));
            $search .=" tanggal = '$tanggal' and";
        }
        if(isset($_REQUEST['nama'])){
            $nama = $_REQUEST['nama'];
            $search .=" transaksi.nama like '%$nama%' and";
        }
        if(isset($_REQUEST['gender'])){
            $gender = $_REQUEST['gender'];
            $search .=" gender_id = '$gender' and";
        }
        if(isset($_REQUEST['phone'])){
            $phone = $_REQUEST['phone'];
            $search .=" transaksi.phone like '%$phone%' and";
        }
        if(isset($_REQUEST['address'])){
            $address = $_REQUEST['address'];
            $search .=" transaksi.address like '%$address%' and";
        }
        if(isset($_REQUEST['saldo'])){
            $saldo = $_REQUEST['saldo'];
            $search .=" transaksi.saldo like '%$saldo%' and";
        }
        $search .= " 1 ";
    }
    $sidx = $_REQUEST['sidx'];
    $sord = $_REQUEST['sord'];
    if ($sidx == 'gender') {
        $sidx = "gender.nama";
    }else {
        $sidx = "transaksi.".$sidx;
    }

    $SQL = "SELECT transaksi.*, gender.nama as genders FROM transaksi LEFT JOIN gender on gender.id = transaksi.gender_id where $search ORDER BY $sidx $sord ";
    $result = mysqli_query($konek, $SQL) or die("Couldn't execute query." . mysqli_error($konek));
    $responce = new stdClass();

    // echo $SQL; return 0;
    $i = 0;
    $data = [];
    while ($kolom = mysqli_fetch_assoc($result)){
        $data[$i] = $kolom;
        $i++;
    }

  
    return json_encode($data);

}