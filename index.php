<?php
require_once "core/init.php";

require_once "view/header.php";
?>

<table id="transaksi"></table>
<div id="transaksiPager"></div>
<div id="transaksiDialog"></div>
<div id="progressbar" style="position: relative; z-index: 999;"></div>

<table id="detail"></table>
<div id="detailPager"></div>
<div id="detailDialog"></div>
<div id="progressbar" style="position: relative; z-index: 999;"></div>


<script type="text/javascript">
 let baseUrl = `<?=  "http://". $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>`
//  let baseUrl = "http://localhost/crudtest/"
</script>


<?php require_once "view/footer.php"; ?>

