#!/usr/bin/php
<?php

$date = getdate(time());

$normalPercentDay1 = rand(15,20);
$normalPercentDay3 = rand(3,4);
$normalPercentDay2 = 100 - $normalPercentDay1 - $normalPercentDay3;
$chek = $normalPercentDay1 + $normalPercentDay2 + $normalPercentDay3;

$m = new MongoClient();
$db = $m->betkey;
$collection = $db->percentDay;

$collection -> insert(array(
    'Year'          => $date['year'],
    'Month'         => $date['month'],
    'Day'           => $date['mday'],
    'UNIXTime'      => time(),
    'Percent False' => $normalPercentDay1,
    'Percent Half'  => $normalPercentDay2,
    'Percent Right' => $normalPercentDay3,
    'check'         => $chek
));

?>