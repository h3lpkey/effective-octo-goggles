<?php
$m = new MongoClient();

$db                   = $m    -> betkey;
$collectionGame       = $db   -> games;               // Игры в текущий момент
$collectionArchive    = $db   -> archive;             // Архив игр
$collectionPercent    = $db   -> percentDay;          // Норма процентов в сутки
$collectionBk         = $db   -> bk;                  // Инфа про Букмекерские конторы
$collectionNews       = $db   -> news;                // Новости сайта
$collectionArticles   = $db   -> articles;            // Статьи сайта
$collectionTages      = $db   -> pagesTags;           // Title & description на страницах
$collectionSportText  = $db   -> sportText;           // Текст для страниц со спортом
$collectionFB         = $db   -> getFeedBack;         // Отзывы и обратная связь
$collectionFree       = $db   -> getFreePrediction;   // Подписка на прогнозы
$collectionPageText   = $db   -> pagesText;           // Текст для страниц
$collectionShop       = $db   -> subscribeShop;       // Карточки магазина
$collectionSlider     = $db   -> slider;       // Карточки магазина

?>