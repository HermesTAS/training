<?php
require_once "core/init.php";

global $konek;

$pelanggan = read();

$page = $_REQUEST['page'];
$limit = $_REQUEST['rows'];
$sidx = $_REQUEST['sidx'];
$sord = $_REQUEST['sord'];

if (! $sidx){
    $sidx = 1;
}
$result = mysqli_query($konek, "SELECT COUNT(*) AS count FROM faktur");
$row = mysqli_fetch_array($result);

$count = $row['count'];
if ($count > 0 && $limit > 0) {
    $total_pages = ceil($count / $limit);
} else {
    $total_pages = 0;
}
if ($page > $total_pages)
    $page = $total_pages;
$start = $limit * $page - $limit;
if ($start < 0)
    $start = 0;

$SQL = "SELECT * FROM faktur ORDER BY $sidx $sord LIMIT $start , $limit";

$result = mysqli_query($konek, $SQL) or die("Couldn't execute query." . mysqli_error($konek));

$i = 0;
while ($kolom = mysqli_fetch_assoc($result)){

    $responce->rows[$i]['id'] = $kolom['id'];
    $responce->rows[$i]['cell'] = array(
        $kolom['nofaktur'],
        $kolom['tanggalfaktur'],
        $kolom['namapelanggan'],
        // '<a href="single.php?id='.$kolom['id'].'">Lihat</a> | <a href="edit.php?id='.$kolom['id'].'">Edit</a> | <a href="delete.php?id='.$kolom['id'].'">Delete</a>'
    );
    $i++;
}

// echo $total_pages = ceil($count / $limit);
$responce->total=$total_pages;
$responce->page =$page;
$responce->records=$count;
echo json_encode($responce);

 ?>
