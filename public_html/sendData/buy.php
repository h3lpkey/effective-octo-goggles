<?php

$out_summ = $_POST['OutSum'];
$inv_id = $_POST['InvoiceID'];
$inv_desc = $_POST['Description'];
$crc = $_POST['SignatureValue'];
$email = $_POST['Shp_email'];
$Shp_ip = $_POST['Shp_ip'];
$Shp_key = $_POST['Shp_key'];

if($out_summ!=""&&
        $inv_desc!=""&&
        $crc!=""&&
        $email!=""&&
        $Shp_ip!=""&&
        $Shp_key!="") {
        
        print_r($email);
//        print_r($Shp_key);
        $m = new MongoClient();

        $db = $m->betkey;
        $collectionShop = $db->buyer;

        $collector = array(
            'email' => $email,
            'inv_desc' => $inv_desc,
            'inv_id' => $inv_id,
            'crc' => $crc,
            'Shp_ip' => $Shp_ip,
            'Shp_key' => $Shp_key,
            'out_summ' => $out_summ,
            'date' => date('Y-m-d H:i:s', time()),
            'check' => 'false',

        );
        $collectionShop->insert($collector);
}
?>