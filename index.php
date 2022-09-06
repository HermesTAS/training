<?php
require_once "core/init.php";

$pelanggan = read();
require_once "view/header.php";
?>

<table id="transaksi"></table>
<div id="transaksiPager"></div>
<div id="transaksiDialog"></div>
<div id="progressbar" style="position: relative; z-index: 999;"></div>


<script type="text/javascript">
//  let baseUrl = "= base_url() ?>"
 let baseUrl = "http://localhost/crudtest/"
</script>


<?php require_once "view/footer.php"; ?>

