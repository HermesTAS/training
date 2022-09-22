<?php

$host= "localhost";
$user= "root";
$pass= "";
$dbase= "crudtest";

$konek= mysqli_connect($host,$user,$pass,$dbase);

if(! $konek){
	die("ada eror");
}
// mysqli_autocommit($konek,FALSE);
?>
