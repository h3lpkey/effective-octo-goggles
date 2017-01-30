<?php
$_url = $_GET['route'];


if($_url == ''){
    include 'pages/main.php';
    exit();
}
$_e = explode('/', $_url);

$_count_e = count($_e);
$paramSite = $_e[0];
$paramPage = $_e[1];

if  ($_count_e == 1)    {   // Первый уровень
    if  (is_file('pages/'.$_e[0].'.php'))   {
        include 'pages/'.$_e[0].'.php';
        exit();
    } else {
        //404
        $paramSite = '404';
        include 'pages/404.php';
        exit();
    }
}

if  ($_count_e >= 2)    { //    Второй уровень

    if  (is_file('pages/'.$_e[0].'.php'))   {

        include 'pages/'.$_e[0].'.php';
        exit();
    } else {
        //404
        $paramSite = '404';
        include 'pages/404.php';
        exit();
    }
}

exit();

?>
    