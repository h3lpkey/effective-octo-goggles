<?php
$email = $_POST['email'];
$name = $_POST['name'];
$message = $_POST['msg'];
echo $email.' '.$name.' '.$message;

if((isset($email) && $email!="")&&(isset($name) && $name!="")&&(isset($message) && $message!="")) { //Проверка отправилось ли наше поля name и не пустые ли они
    if (preg_match('/^[а-яА-Яa-zA-Z0-9_\.\-]+@[а-яА-Яa-zA-Z0-9\-]+\.[а-яА-Яa-zA-Z\-\.]+$/Du',$email)) {
                $m = new MongoClient();
                $db = $m -> betkey;
                $collectionFB         = $db   -> getFeedBack;

                $collector = array(
                    'email'     => $email,
                    'name'      => $name,
                    'message'   => $message,
                    'date'      => getdate(time()),

                );

                $collectionFB->insert($collector);

                
    } else {
        
    }


} else {
    
}
?>