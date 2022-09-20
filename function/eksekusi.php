<?php

function run($qry){
	global $konek;
    return mysqli_query($konek,$qry);
	// if(mysqli_query($konek,$qry))return true;
	// else return false;
}
function result($qry){
	global $konek;
	$show= mysqli_query($konek,$qry) or die("Maaf Ada Kesalahan di Server Kami");
	return $show;
}