<?php
$m = new MongoClient();

$db                     = $m    -> betkey;
$collectionGame         = $db   -> games;       // Игры в текущий момент
$collectionArchive      = $db   -> archive;     // Архив игр
$collectionPercent      = $db   -> percentDay;  // Норма процентов в сутки
$collectionBk           = $db   -> bk;          // Список букмекеров
$collectionNews         = $db   -> news;        // Новости сайта
$collectionArticles     = $db   -> articles;    // Статьи сайта

?>