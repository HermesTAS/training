<?php

require_once "core/init.php";

if(isset($_GET['id'])){
	if(delete($_GET['id'])){
		header("Location: index.php");
	}
}else{
	echo "Data Gagal Dihapus";
}

?>
