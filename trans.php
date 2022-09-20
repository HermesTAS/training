<?php


require_once "core/init.php";
global $konek;
// Turn autocommit off
mysqli_begin_transaction($konek);
$all_query_ok = true;
// Insert some values
$arr =[
  [
    'nama'=>"1 pestet",
    'umur'=>35,
    'phone'=>"43201734127098"
  ],
  [
    'nama'=>"2 samsus",
    'umur'=>35,
    'phone'=>"324234324"
    ]
  ];
  foreach ($arr as $arrs) {
    // mysqli_query($konek,testtrans($arrs)) ? null : $all_query_ok=false;
    testtrans($arrs) ? null : $all_query_ok=false;
  }
  mysqli_query($konek,"INSERT INTO trans (nama,umur,phone) VALUES ('3 Peter',35,'87978978979')") ? null : $all_query_ok=false;;
  mysqli_query($konek,"INSERT INTO trans (nama,umur,phone) VALUES ('4 Glenn',33,'asdsadsas')") ? null : $all_query_ok=false;;
  
  $all_query_ok ? mysqli_commit($konek) : mysqli_rollback($konek);
