<?php


$message = $_POST['fb-message'];
if((isset($email) && $email!="")) { //Проверка отправилось ли наше поля name и не пустые ли они
    if (preg_match('/^[а-яА-Яa-zA-Z0-9_\.\-]+@[а-яА-Яa-zA-Z0-9\-]+\.[а-яА-Яa-zA-Z\-\.]+$/Du',$email)) {
        $m = new MongoClient();
        $db = $m -> betkey;
        $collectionFree         = $db   -> getFreePrediction;

        $collector = array(
            'email'  => $email,
            'date'   => getdate(time()),

        );

        $collectionFree->insert($collector);

        echo 'lol '.$email;
    } else {
        echo '\4et ne tak '.$email;
    }


} else {
    echo 'gde danie? GDEEEE???';
}
?>