<?php

require_once "core/init.php";

if(isset($_GET['id'])){
	if(delete_detail($_GET['id'])){
		header("Location: single.php?id=".$_GET['faktur_id']);
	}
}else{
	echo "Data Gagal Dihapus";
}
 ?>
