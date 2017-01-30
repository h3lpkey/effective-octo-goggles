//Подключаем нужные модули
var page = require('webpage').create();
page.injectJs('/var/www/betkey.ru/public_hmtl/lib/js/jquery.min.js');
var filesystem = require('fs');
// Ссылка на json xbet
var url = 'https://nl.1xbet.com/LiveFeed/BestGamesExt?sportId=0&sports=&champs=&tf=1000000&tz=0&afterDays=0&count=50&cnt=50&lng=ru&cfview=0&page=0&antisports=&mode=4&subGames=&cyberFlag=0&country=222&partner=1';

var timerId = setInterval(function() {
    // Открываем страницу
    page.open(url, function (status) {
        if (status === 'success') {
                //Забираем json
                var jsonSource = page.plainText;
                // Запись в файл
                var path = "/var/www/betkey.ru/parser/json/xbet/xbet.json";
                var content = jsonSource;
                filesystem.write(path, content, 'w');
        }
    });
//Каждые 5 сек
}, 10000);

// После 60сек закрываем фантом
setTimeout(function() {
    clearInterval(timerId);
    phantom.exit();

}, 60000);