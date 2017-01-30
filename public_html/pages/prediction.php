<?php include('includes/header.php'); ?>
<?php

if($paramPage == 'success') {
    include ('includes/success.php');
}
if($paramPage == 'fail') {
    include ('includes/fail.php');
}
if($paramPage == 'images') {
    exit();
}
    // as a part of SuccessURL script

// HTTP parameters:
    $out_summ = $_POST['out_summ'];
    $inv_id = $_POST['inv_id'];
    $crc = $_POST['crc'];
    $Email = $_POST['Email'];
    $Shp_ip = $_POST['Shp_ip'];
    $Shp_key = $_POST['Shp_key'];

    $crc = strtoupper($crc);  // force uppercase

// build own CRC
$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass1:Shp_ip=$Shp_ip:Shp_key=$Shp_key"));
$m = new MongoClient();

$db                   = $m    -> betkey;
$collectionShop       = $db   -> buyer;

    if ($my_crc != $crc)
    {
        echo 'Ошибка передачи';
        exit();
    }

    if ($my_crc == $crc) {
        $filter     = array('inv_id' => $inv_id);
        $collector  = $collectionShop->find($filter);
        if($collector->count() == 1) {
            $collectionShop -> update(
                array( 'inv_id'     => $inv_id),
                array( '$set'       => array(
                        'check'    => 'true',
                ))
            );
        } else {
            echo 'Нет такой транзакции';
        }
    }

// you can check here, that resultURL was called
// (for better security)

// OK, payment proceeds



    ?>


