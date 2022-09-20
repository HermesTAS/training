<?php
function gender_all()
{
    $qry= "SELECT * FROM gender ";
    return result($qry);
}
//
// function run($qry){
// 	global $konek;
//
// 	if(mysqli_query($konek,$qry))return true;
// 	else return false;
// }
// function result($qry){
// 	global $konek;
// 	$show= mysqli_query($konek,$qry) or die("Maaf Ada Kesalahan di Server Kami");
// 	return $show;
// }
?>
