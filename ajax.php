<?php
require_once 'core/init.php';

switch ($_GET['cari']) {
    case 'gender':
    $SQL = "SELECT * FROM gender";
    $result = mysqli_query($konek, $SQL) or die("Couldn't execute query." . mysqli_error($konek));
        $arr = [];
        while ($koloms = mysqli_fetch_array($result)){
            $arr[ ] = array(
                'id_gender'=>$koloms['id'],
                'gender'=>$koloms['nama'],
            );
        }
        echo json_encode($arr);
        break;
    case 'store_transaksi':
        create_transaksi($_POST);
        $res=['status' => 'submitted',"postData"=>$_POST];
        echo json_encode($res,200);
        return 0;
        break;
    case 'update_transaksi':
        update_transaksi($_POST,$_GET['id']);
        $res=['status' => 'submitted',"postData"=>$_POST];
        echo json_encode($res,200);
        return 0;
        break;
    case 'delete_confirm':
        delete_transaksi($_GET['id']);
        $res=['deleted'];
        echo json_encode($res,200);
        return 0;
        break;
    case 'show':
        global $konek;
        $nofaktur = $_GET['nofaktur'];
        $postData = $_GET['postData'];
        $sort_index = $_GET['sort_index'];
        $sort_order = $_GET['sort_order'];
        $limit = $_GET['limit'];

        $operator = ($sort_order == 'asc') ? '<=' : '>=';

        $order_by = " ORDER BY $sort_index $sort_order ";

		if ($sort_index == 'tanggal') $postData = date('Y-m-d', strtotime($postData));
		if ($sort_index == 'phone') {
            $postData = str_replace("_","",$postData);
            if(substr($postData,-1) == "-"){
                $postData = substr_replace($postData ,"",-1);
            }
            $postData = "+".trim($postData);
        }
            
		
        $transaksi = mysqli_fetch_array( mysqli_query($konek,"SELECT * FROM transaksi Where nofaktur = '$nofaktur' LIMIT 1") );
        
		$count = mysqli_fetch_array(mysqli_query($konek,"SELECT COUNT(*) as count  FROM transaksi"))['count'];
		$row = mysqli_fetch_array(mysqli_query($konek,"SELECT COUNT(*) as count FROM transaksi where $sort_index $operator '$postData' $order_by "))['count'];
		$page = ceil($row / $limit);
		if ($page > 1) $row -= $limit * ($page - 1);
        

		echo json_encode([
			'postData' => $postData,
			'operator' => $operator,
			'page' => $page,
			'row' => $row,
			'records' => $count,
			'data' => $transaksi,
		]);
        return 0;
        break;
    case 'loopseribu':
        // $arr = [];
        for ($i=1; $i <= 1000; $i++) { 
            $angka = sprintf("%04s", $i);
            $gender = ($i%2) ? "1":"2";
            create_transaksi([
                "nofaktur"=> "FTR-$angka",
                "tanggalfaktur"=> "27-09-2022",
                "namapelanggan"=> "Pelanggan $angka",
                "gender_id"=> $gender,
                "phone"=> "+62 324697$angka",
                "saldo"=> "idr 99.$angka,00",
                "address"=> "jl jalan no. $i"
            ]) ;
        }
        // create_transaksi($arr);
        // echo json_encode($arr);
        return 0;
        break;
    case 'datatable':

    global $konek;
    $pelanggan = read();
    $search="";
    if (isset($_REQUEST['global_search']) && strlen($_REQUEST['global_search'])) {
        $global_search = $_REQUEST['global_search'];
        $search .=" transaksi.nofaktur like '%$global_search%' or";
        $search .=" tanggal like '%$global_search%' or";
        $search .=" transaksi.nama like '%$global_search%' or";
        $search .=" gender.nama like '%$global_search%' or";
        $search .=" transaksi.phone like '%$global_search%' or";
        $search .=" transaksi.address like '%$global_search%' or";
        $search .=" transaksi.saldo like '%$global_search%' ";
    }else{
        if(isset($_REQUEST['nofaktur'])){
            $nofaktur = $_REQUEST['nofaktur'];
            $search .=" transaksi.nofaktur like '%$nofaktur%' and";
        }
        if(isset($_REQUEST['tanggal'])){
            $tanggal = date("Y-m-d", strtotime($_REQUEST['tanggal']));
            $search .=" tanggal = '$tanggal' and";
        }
        if(isset($_REQUEST['nama'])){
            $nama = $_REQUEST['nama'];
            $search .=" transaksi.nama like '%$nama%' and";
        }
        if(isset($_REQUEST['gender'])){
            $gender = $_REQUEST['gender'];
            $search .=" gender_id = '$gender' and";
        }
        if(isset($_REQUEST['phone'])){
            $phone = $_REQUEST['phone'];
            $search .=" transaksi.phone like '%$phone%' and";
        }
        if(isset($_REQUEST['address'])){
            $address = $_REQUEST['address'];
            $search .=" transaksi.address like '%$address%' and";
        }
        if(isset($_REQUEST['saldo'])){
            $saldo = $_REQUEST['saldo'];
            $search .=" transaksi.saldo like '%$saldo%' and";
        }
        $search .= " 1 ";
    }



    $page = $_REQUEST['page'];
    $limit = $_REQUEST['rows'];
    $sidx = $_REQUEST['sidx'];
    $sord = $_REQUEST['sord'];

    if (! $sidx){
        $sidx = 1;
    }
    $result = mysqli_query($konek, "SELECT COUNT(*) AS count FROM transaksi LEFT JOIN gender on gender.id = transaksi.gender_id where $search  ");
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

    $SQL = "SELECT transaksi.*, gender.nama as genders FROM transaksi LEFT JOIN gender on gender.id = transaksi.gender_id where $search ORDER BY $sidx $sord LIMIT $start , $limit";
    $result = mysqli_query($konek, $SQL) or die("Couldn't execute query." . mysqli_error($konek));
    $responce = new stdClass();

    // echo $SQL; return 0;
    $i = 0;
    while ($kolom = mysqli_fetch_assoc($result)){

        $responce->rows[$i]['id'] = $kolom['id'];
        $responce->rows[$i]['cell'] = array(
            $kolom['nofaktur'],
            date('d-m-Y', strtotime($kolom['tanggal'])),
            $kolom['nama'],
            $kolom['genders'],
            $kolom['phone'],
            $kolom['address'],
            $kolom['saldo'],

        );
        $i++;
    }

    $total_pages = ceil($count / $limit);
    $responce->total=$total_pages;
    $responce->page =$page;
    $responce->records=$count;
    echo json_encode($responce);


    default:
        // code...
        break;
}
 ?>
