<?php
require_once 'core/init.php';

if ($_POST['oper'] == 'add') {
    $id = $_POST['id'];//: "6"
    $namapelanggan = $_POST['namapelanggan'];//: "3223243"
    $nofaktur = $_POST['nofaktur'];//: "1234555"
    $oper = $_POST['oper'];//: "edit"
    $tanggalfaktur = $_POST['tanggalfaktur'];//: "2022-08-23"
    $data=[
        "nofaktur"    =>$nofaktur,
        "tanggalfaktur"   =>$tanggalfaktur,
        "namapelanggan"   =>$namapelanggan
    ];
    create($data);
}elseif ($_POST['oper'] == 'edit') {
    $id = $_POST['id'];//: "6"
    $namapelanggan = $_POST['namapelanggan'];//: "3223243"
    $nofaktur = $_POST['nofaktur'];//: "1234555"
    $oper = $_POST['oper'];//: "edit"
    $tanggalfaktur = $_POST['tanggalfaktur'];//: "2022-08-23"
    $data=[
        "nofaktur"    =>$nofaktur,
        "tanggalfaktur"   =>$tanggalfaktur,
        "namapelanggan"   =>$namapelanggan
    ];
    update($data,$id);

}elseif ($_POST['oper'] == 'del') {
    $id = $_POST['id'];//: "6"
    delete($id);
}else{
    return "asdasd";
}
 ?>
