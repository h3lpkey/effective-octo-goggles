<?php
header('Content-type: text/html; charset=utf-8');

/*
 * 1 - False
 * 2 - Half
 * 3 - Right
 */


// Функция фильтрации игр которые мы ведём на сайте.
function xBetGameFilter ($game) {
    if (    $game->SportNameEng == "Football"        ||
            $game->SportNameEng == "Ice hockey"      ||
            $game->SportNameEng == "Tennis"          ||
            $game->SportNameEng == "Volleyball"      ||
            $game->SportNameEng == "Snooker"         ||
            $game->SportNameEng == "Baseball"        ||
            $game->SportNameEng == "Badminton"       ||
            $game->SportNameEng == "Formula 1"       ||
            $game->SportNameEng == "Cricket"         ||
            $game->SportNameEng == "Bicycle Racing"  ||
            $game->SportNameEng == "Rugby"           ||
            $game->SportNameEng == "Basketball"      ||
            $game->SportNameEng == "Handball"
    ) {
        return true;
    } else {
        return false;
    }
}

// Проверка базы текущих игр
function checkGamesDB ($key, $collectionGame) {
    $filter     = array('key' => $key);
    $collector  = $collectionGame->find($filter);
    if($collector->count() == 1) {
        return true;
    } else {
        return false;
    }
}

// Создание игры в базе текущих игр
function makeGameDB ($key, $collectionGame, $game) {
    // Генерируем ссылки на игры
    $headlinkxbet = "https://nl.1xbet.com/live/";
    $xbet = $game->SportNameEng."/".$game->LigaId."-".$game->ChampEng."/".$game->MainGameId.
        "-".str_replace('/', '', $game->Opp1Eng)."-".str_replace('/', '', $game->Opp2Eng)."/";
    $xbet = ereg_replace("[^-a-zA-Z0-9 /-]", "", $xbet);
    $xbet = str_replace(' ', '-', $xbet);

    $xbetGameLink = $headlinkxbet.$xbet;
    $xbetGameLink = iconv('utf-8', 'windows-1251//IGNORE', $xbetGameLink);

    $collector = array(
        'key'           => $key,
        'SportNameRus'  => $game->SportNameRus,
        'SportNameEng'  => $game->SportNameEng,
        'Team1Rus'      => $game->Opp1Rus,
        'Team2Rus'      => $game->Opp2Rus,
        'Team1Eng'      => $game->Opp1Eng,
        'Team2Eng'      => $game->Opp2Eng,
        'ChampRus'      => $game->ChampRus,
        'ChampEng'      => $game->ChampEng,
        'Date'          => date('Y-m-d H:i:s', $game->Start),
        'MatchTime'     => date('n:s', $game->Scores->TimeSec),
        'GamingNow'     => $game->Scores->TimeRun,
        'ScoreTeam1'    => $game->Scores->FullScore->Sc1,
        'ScoreTeam2'    => $game->Scores->FullScore->Sc2,
        'Finished'      => $game->Finished,
        'Prediction'    => false,
        'bkRobotResult' => 0,
        'xbetGameLink'  => $xbetGameLink,
        'xbetMax'       => array(
            'Win1'      => 0,
            'Draw'      => 0,
            'Win2'      => 0,
        ),
    );

    $collectionGame->insert($collector);
}

// Обновление данных игры в базе текущих игр
function updateGameDB ($key, $collectionGame, $game) {
    //Обновление счёта
    $collectionGame -> update(
        array( 'key'        => $key),
        array( '$set'       => array(
            'MatchTime'     => date('i:s', $game->Scores->TimeSec),
            'ScoreTeam1'    => $game->Scores->FullScore->Sc1,
            'ScoreTeam2'    => $game->Scores->FullScore->Sc2,
            'LastUpdate'    => time(),
        ))
    );
    // Проверка на коррекнтость старта игры
    if ($game->Scores->TimeSec != '00:00' && $game->Scores->FullScore->Sc1 +
        $game->Scores->FullScore->Sc2 != 0) {
        $collectionGame -> update(
            array( 'key'        => $key),
            array( '$set'       => array(
                'GamingNow'     => true,
            ))
        );
    }

    if  (   $game->Events[0]->C != null &&
            $game->Events[1]->C != null &&
            $game->Events[2]->C != null) {
        // Обновление ставок
        $collectionGame -> update(
            array( 'key'    => $key ),
            array( '$push'  => array(
                'BetsXbet'  => array(
                    'Bets'  => 'Xbet',
                    'Time'  => time(),
                    'Win1'  => $game->Events[0]->C,
                    'Draw'  => $game->Events[1]->C,
                    'Win2'  => $game->Events[2]->C
                )
            ))
        );
    }
}

// Считываем суточную норму процентов предсказаний
function getPercentDay ($collectionPercent) {
    $date           = getdate(time());
    $filterDay      = array('Year' => $date['year'], 'Month' => $date['month'], 'Day' => $date['mday']);
    $percentArray   = $collectionPercent->findOne($filterDay);
    $normalPercentDay[1] = $percentArray['Percent False'];
    $normalPercentDay[2] = $percentArray['Percent Half'];
    $normalPercentDay[3] = $percentArray['Percent Right'];
    return $normalPercentDay;
}

// Считаем уже сделаные предсказания в процентах
function getPredictionPercent($collectionArchive) {
//    for ($i = 1; $i < 4; $i++) {
//        $filterPrediction[$i]   = array('bkRobotResult' => $i);
//        $archPrediction[$i]     = $collectionArchive    ->find($filterPrediction[$i]);
//        $countPrediction[$i]    = $archPrediction[$i]   ->count();
//    }
//
//    $allPrediction = $countPrediction[1] + $countPrediction[2] + $countPrediction[3];
//    if ($allPrediction == 0) { // ДОДУМАТЬ <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
//        $allPrediction = 1;
//    }
//
//    $percentPrediction[1] = ($countPrediction[1] / $allPrediction) * 100;
//    $percentPrediction[2] = ($countPrediction[2] / $allPrediction) * 100;
//    $percentPrediction[3] = ($countPrediction[3] / $allPrediction) * 100;


    $fail = 0;
    $half = 0;
    $right = 0;
    $time = time() - 86400;

    $filterTime   = array('LastUpdate' => array('$gt' => $time));
    $list  = $collectionArchive->find($filterTime);
    while($document = $list->getNext()) {
        if($document['bkRobotResult'] == 1) $fail++;
        if($document['bkRobotResult'] == 2) $half++;
        if($document['bkRobotResult'] == 3) $right++;
    }

    $allPrediction = $fail + $half + $right;
    if ($allPrediction == 0) { // ДОДУМАТЬ <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
        $allPrediction = 1;
    }

    $percentPrediction[1] = ($fail / $allPrediction) * 100;
    $percentPrediction[2] = ($half / $allPrediction) * 100;
    $percentPrediction[3] = ($right / $allPrediction) * 100;

    return $percentPrediction;
}

// Высчитываем максимальные ставки на игру за всё время
function getMaxBets($theGame) {

    $theGame['xbetMax']['Win1'] = 0;
    $theGame['xbetMax']['Draw'] = 0;
    $theGame['xbetMax']['Win2'] = 0;

    $bets = $theGame['BetsXbet']; // Для входа в подмосив
    for ($i=0;$i<count($bets)-1;$i++) {
        if($theGame['xbetMax']['Win1'] < $bets[$i]['Win1']) {
            $theGame['xbetMax']['Win1'] = $bets[$i]['Win1'];
        }
        if($theGame['xbetMax']['Draw'] < $bets[$i]['Draw']) {
            $theGame['xbetMax']['Draw'] = $bets[$i]['Draw'];
        }
        if($theGame['xbetMax']['Win2'] < $bets[$i]['Win2']) {
            $theGame['xbetMax']['Win2'] = $bets[$i]['Win2'];
        }
    }
return $theGame;

}

// Рандомим предсказание
function getPredictionGame($normalPercentDay, $predictionPercent, $theGame, $collectionArchive) {

    $list = $collectionArchive->find();
    $list -> limit(5);
    $list -> sort(array('$natural' => - 1, 'bkRobotResult' => 1));
    $fail = 0;
    $half = 0;
    $right = 0;

    while($document = $list->getNext()) {

        if($document['bkRobotResult'] == 1) $fail++;
        if($document['bkRobotResult'] == 2) $half++;
        if($document['bkRobotResult'] == 3) $right++;
    }

    if ($fail >= 2 || $half >= 5 || $right >= 2) {

        if ($fail >= 2) {
            if ($predictionPercent[3] < $normalPercentDay[3]) {
                $theGame['Prediction']      = true;
                $theGame['bkRobotResult']   = 3;
            }
            if ($predictionPercent[2] < $normalPercentDay[2]) {
                $theGame['Prediction']      = true;
                $theGame['bkRobotResult']   = 2;
            }
        }
        if ($half >= 5) {
            if ($predictionPercent[3] < $normalPercentDay[3]) {
                $theGame['Prediction']      = true;
                $theGame['bkRobotResult']   = 3;
            }
            if ($predictionPercent[1] < $normalPercentDay[1]) {
                $theGame['Prediction']      = true;
                $theGame['bkRobotResult']   = 1;
            }
        }
        if ($right >= 2) {
            if ($predictionPercent[2] < $normalPercentDay[2]) {
                $theGame['Prediction']      = true;
                $theGame['bkRobotResult']   = 2;
            }
            if ($predictionPercent[1] < $normalPercentDay[1]) {
                $theGame['Prediction']      = true;
                $theGame['bkRobotResult']   = 1;
            }
        }
    } else {
        $over = 0;

        while ($theGame['Prediction'] != true) {
            $rand = rand(1,3);
            switch ($rand) {
                case 1:
                    $over++;
                    echo $rand.' <<< rand '.$over.' <<< over||| ';

                    if ($predictionPercent[1] < $normalPercentDay[1]) {
                        $theGame['Prediction'] = true;
                        $theGame['bkRobotResult'] = 1;
                    }
                    if ($over >= 5) {
                        $theGame['Prediction'] = true;
                        $theGame['bkRobotResult'] = 1;
                    }
                    break;

                case 2:
                    $over++;
                    echo $rand.' <<< rand '.$over.' <<< over||| ';

                    if ($predictionPercent[2] < $normalPercentDay[2]) {
                        $theGame['Prediction'] = true;
                        $theGame['bkRobotResult'] = 2;
                    }
                    if ($over >= 5) {
                        $theGame['Prediction'] = true;
                        $theGame['bkRobotResult'] = 1;
                    }
                    break;

                case 3:
                    $over++;
                    echo $rand.' <<< rand '.$over.' <<< over||| ';

                    if ($predictionPercent[3] < $normalPercentDay[3]) {
                        $theGame['Prediction'] = true;
                        $theGame['bkRobotResult'] = 3;
                    }
                    if ($over >= 5) {
                        $theGame['Prediction'] = true;
                        $theGame['bkRobotResult'] = 1;
                    }
                    break;
            }
        }
    }

    if($theGame['SportNameEng'] == 'Football') {
        if($theGame['ScoreTeam1'] > $theGame['ScoreTeam2']) {
            $score = $theGame['ScoreTeam1'] - $theGame['ScoreTeam2'];
        } else {
            $score = $theGame['ScoreTeam2'] - $theGame['ScoreTeam1'];
        }
        if ($score >= 3) {
            $rand = rand(1,2);
            switch ($rand) {
                case 1 :
                    $theGame['Prediction']      = true;
                    $theGame['bkRobotResult']   = 1;
                    break;
                case 2 :
                    $theGame['Prediction']      = true;
                    $theGame['bkRobotResult']   = 2;
                    break;
            }
        }
    }
    if ($theGame['Prediction'] == false) { // костыль
        $rand = rand(1,3);
        switch ($rand) {
            case 1 :
                $theGame['Prediction']      = true;
                $theGame['bkRobotResult']   = 1;
                break;
            case 2 :
                $theGame['Prediction']      = true;
                $theGame['bkRobotResult']   = 2;
                break;
            case 3 :
                $theGame['Prediction']      = true;
                $theGame['bkRobotResult']   = 3;
                break;
        }
    }

    return $theGame;
}

// В зависимости от предсказания выставляем победителя, проигравшего или ничью
function setGameTeamStatus($theGame) {
    switch ($theGame['bkRobotResult']) {
        case 1:
            $theGame['bkRobotTeamRus'] = ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] ?
                ($theGame['ScoreTeam1'] < $theGame['ScoreTeam2'] ? $theGame['Team1Rus'] : $theGame['Team2Rus']) : 'Ничья');
            $theGame['bkRobotTeamEng'] = ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] ?
                ($theGame['ScoreTeam1'] < $theGame['ScoreTeam2'] ? $theGame['Team1Eng'] : $theGame['Team2Eng']) : 'Draw');
            break;
        case 2:
            $theGame['bkRobotTeamRus'] = ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] ?
                ($theGame['ScoreTeam1'] > $theGame['ScoreTeam2'] ? $theGame['Team1Rus'] : $theGame['Team2Rus']) : 'Ничья');
            $theGame['bkRobotTeamEng'] = ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] ?
                ($theGame['ScoreTeam1'] > $theGame['ScoreTeam2'] ? $theGame['Team1Eng'] : $theGame['Team2Eng']) : 'Draw');
            break;
        case 3:
            $theGame['bkRobotTeamRus'] = ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] ?
                ($theGame['ScoreTeam1'] > $theGame['ScoreTeam2'] ? $theGame['Team1Rus'] : $theGame['Team2Rus']) : 'Ничья');
            $theGame['bkRobotTeamEng'] = ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] ?
                ($theGame['ScoreTeam1'] > $theGame['ScoreTeam2'] ? $theGame['Team1Eng'] : $theGame['Team2Eng']) : 'Draw');
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam1'];
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam2'];
            break;
    }

    return $theGame;
}

// Подстановка счёта в зависимости от предсказания
function setGameScore($theGame) {
    if ($theGame['bkRobotResult'] == 1) { // Не угадали матч совсем
        if ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 5)  {
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam2'] + 0;
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam1'] + 1;
        }

        if ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 5 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 10)  {
            $rand = rand(-1, 2);
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam2'] + $rand;
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam1'] + $rand;
        }

        if ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 10 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 15) {
            $rand = rand(-4, 4);
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam2'] + $rand;
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam1'] + $rand;
        }

        if ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 15 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 20) {
            $rand = rand(-6, 6);
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam2'] + $rand;
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam1'] + $rand;
        }

        if ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 20 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 30) {
            $rand = rand(-10, 10);
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam2'] + $rand;
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam1'] + $rand;
        }

        if ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 30 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 40) {
            $rand = rand(-15, 15);
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam2'] + $rand;
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam1'] + $rand;
        }

        if ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 40 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 55) {
            $rand = rand(-15, 20);
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam2'] + $rand;
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam1'] + $rand;
        }

        if ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 55 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 80) {
            $rand = rand(-20, 25);
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam2'] + $rand;
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam1'] + $rand;
        }

        if ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 80) {
            $rand = rand(-30, 35);
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam2'] + $rand;
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam1'] + $rand;
        }


        if ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 5) {
            $theGame['bkRobotScore1'] = ($theGame['ScoreTeam1'] < $theGame['ScoreTeam2'] ? $theGame['ScoreTeam2'] + 1 : $theGame['ScoreTeam2']);
            $theGame['bkRobotScore2'] = ($theGame['ScoreTeam2'] < $theGame['ScoreTeam1'] ? $theGame['ScoreTeam1'] + 1 : $theGame['ScoreTeam1']);
        }

        if ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 5 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 10) {
            $rand = rand(-2, 3);
            $theGame['bkRobotScore1'] = ($theGame['ScoreTeam1'] < $theGame['ScoreTeam2'] ? $theGame['ScoreTeam2'] + $rand : $theGame['ScoreTeam2'] + $rand);
            $theGame['bkRobotScore2'] = ($theGame['ScoreTeam2'] < $theGame['ScoreTeam1'] ? $theGame['ScoreTeam1'] + $rand : $theGame['ScoreTeam1'] + $rand);
        }

        if ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 10 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 15) {
            $rand = rand(-4, 4);
            $theGame['bkRobotScore1'] = ($theGame['ScoreTeam1'] < $theGame['ScoreTeam2'] ? $theGame['ScoreTeam2'] + $rand : $theGame['ScoreTeam2'] + $rand);
            $theGame['bkRobotScore2'] = ($theGame['ScoreTeam2'] < $theGame['ScoreTeam1'] ? $theGame['ScoreTeam1'] + $rand : $theGame['ScoreTeam1'] + $rand);
        }

        if ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 15 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 20) {
            $rand = rand(-6, 6);
            $theGame['bkRobotScore1'] = ($theGame['ScoreTeam1'] < $theGame['ScoreTeam2'] ? $theGame['ScoreTeam2'] + $rand : $theGame['ScoreTeam2'] + $rand);
            $theGame['bkRobotScore2'] = ($theGame['ScoreTeam2'] < $theGame['ScoreTeam1'] ? $theGame['ScoreTeam1'] + $rand : $theGame['ScoreTeam1'] + $rand);
        }

        if ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 20 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 30) {
            $rand = rand(-10, 10);
            $theGame['bkRobotScore1'] = ($theGame['ScoreTeam1'] < $theGame['ScoreTeam2'] ? $theGame['ScoreTeam2'] + $rand : $theGame['ScoreTeam2'] + $rand);
            $theGame['bkRobotScore2'] = ($theGame['ScoreTeam2'] < $theGame['ScoreTeam1'] ? $theGame['ScoreTeam1'] + $rand : $theGame['ScoreTeam1'] + $rand);
        }

        if ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 30 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 40) {
            $rand = rand(-15, 15);
            $theGame['bkRobotScore1'] = ($theGame['ScoreTeam1'] < $theGame['ScoreTeam2'] ? $theGame['ScoreTeam2'] + $rand : $theGame['ScoreTeam2'] + $rand);
            $theGame['bkRobotScore2'] = ($theGame['ScoreTeam2'] < $theGame['ScoreTeam1'] ? $theGame['ScoreTeam1'] + $rand : $theGame['ScoreTeam1'] + $rand);
        }

        if ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 40 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 55) {
            $rand = rand(-15, 20);
            $theGame['bkRobotScore1'] = ($theGame['ScoreTeam1'] < $theGame['ScoreTeam2'] ? $theGame['ScoreTeam2'] + $rand : $theGame['ScoreTeam2'] + $rand);
            $theGame['bkRobotScore2'] = ($theGame['ScoreTeam2'] < $theGame['ScoreTeam1'] ? $theGame['ScoreTeam1'] + $rand : $theGame['ScoreTeam1'] + $rand);
        }

        if ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 55 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 80) {
            $rand = rand(-20, 25);
            $theGame['bkRobotScore1'] = ($theGame['ScoreTeam1'] < $theGame['ScoreTeam2'] ? $theGame['ScoreTeam2'] + $rand : $theGame['ScoreTeam2'] + $rand);
            $theGame['bkRobotScore2'] = ($theGame['ScoreTeam2'] < $theGame['ScoreTeam1'] ? $theGame['ScoreTeam1'] + $rand : $theGame['ScoreTeam1'] + $rand);
        }

        if ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 80) {
            $rand = rand(-30, 35);
            $theGame['bkRobotScore1'] = ($theGame['ScoreTeam1'] < $theGame['ScoreTeam2'] ? $theGame['ScoreTeam2'] + $rand : $theGame['ScoreTeam2'] + $rand);
            $theGame['bkRobotScore2'] = ($theGame['ScoreTeam2'] < $theGame['ScoreTeam1'] ? $theGame['ScoreTeam1'] + $rand : $theGame['ScoreTeam1'] + $rand);
        }
    }

    if ($theGame['bkRobotResult'] == 2) { // Угадали сторону, но не счёт
        if ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 5) {
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam1'] + 1;
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam2'] + 1;
        }

        if ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 5 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 10) {
            $rand = rand(-2,3);
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam1'] + $rand;
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam2'] + $rand;
        }

        if ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 10 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 15) {
            $rand = rand(-4,4);
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam1'] + $rand;
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam2'] + $rand;
        }

        if ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 15 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 20) {
            $rand = rand(-6,6);
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam1'] + $rand;
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam2'] + $rand;
        }

        if ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 20 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 30) {
            $rand = rand(-10,10);
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam1'] + $rand;
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam2'] + $rand;
        }

        if ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 30 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 40) {
            $rand = rand(-15,15);
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam1'] + $rand;
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam2'] + $rand;
        }

        if ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 40 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 55) {
            $rand = rand(-20,20);
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam1'] + $rand;
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam2'] + $rand;
        }

        if ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 55 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 80) {
            $rand = rand(-25,25);
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam1'] + $rand;
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam2'] + $rand;
        }

        if ($theGame['ScoreTeam1'] == $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 80) {
            $rand = rand(-35,35);
            $theGame['bkRobotScore1'] = $theGame['ScoreTeam1'] + $rand;
            $theGame['bkRobotScore2'] = $theGame['ScoreTeam2'] + $rand;
        }


        if ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 5) {
            $theGame['bkRobotScore1'] = ($theGame['ScoreTeam1'] > $theGame['ScoreTeam2'] ? $theGame['ScoreTeam1'] + 1 : $theGame['ScoreTeam1']);
            $theGame['bkRobotScore2'] = ($theGame['ScoreTeam2'] > $theGame['ScoreTeam1'] ? $theGame['ScoreTeam2'] + 1 : $theGame['ScoreTeam2']);
        }

        if ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 5 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 10) {
            $rand = rand(-2,3);
            $theGame['bkRobotScore1'] = ($theGame['ScoreTeam1'] > $theGame['ScoreTeam2'] ? $theGame['ScoreTeam1'] + $rand : $theGame['ScoreTeam1'] + $rand);
            $theGame['bkRobotScore2'] = ($theGame['ScoreTeam2'] > $theGame['ScoreTeam1'] ? $theGame['ScoreTeam2'] + $rand : $theGame['ScoreTeam2'] + $rand);
        }

        if ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 10 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 15) {
            $rand = rand(-4,4);
            $theGame['bkRobotScore1'] = ($theGame['ScoreTeam1'] > $theGame['ScoreTeam2'] ? $theGame['ScoreTeam1'] + $rand : $theGame['ScoreTeam1'] + $rand);
            $theGame['bkRobotScore2'] = ($theGame['ScoreTeam2'] > $theGame['ScoreTeam1'] ? $theGame['ScoreTeam2'] + $rand : $theGame['ScoreTeam2'] + $rand);
        }

        if ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 15 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 20) {
            $rand = rand(-6,6);
            $theGame['bkRobotScore1'] = ($theGame['ScoreTeam1'] > $theGame['ScoreTeam2'] ? $theGame['ScoreTeam1'] + $rand : $theGame['ScoreTeam1'] + $rand);
            $theGame['bkRobotScore2'] = ($theGame['ScoreTeam2'] > $theGame['ScoreTeam1'] ? $theGame['ScoreTeam2'] + $rand : $theGame['ScoreTeam2'] + $rand);
        }

        if ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 20 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 30) {
            $rand = rand(-10,10);
            $theGame['bkRobotScore1'] = ($theGame['ScoreTeam1'] > $theGame['ScoreTeam2'] ? $theGame['ScoreTeam1'] + $rand : $theGame['ScoreTeam1'] + $rand);
            $theGame['bkRobotScore2'] = ($theGame['ScoreTeam2'] > $theGame['ScoreTeam1'] ? $theGame['ScoreTeam2'] + $rand : $theGame['ScoreTeam2'] + $rand);
        }

        if ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 30 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 40) {
            $rand = rand(-15,15);
            $theGame['bkRobotScore1'] = ($theGame['ScoreTeam1'] > $theGame['ScoreTeam2'] ? $theGame['ScoreTeam1'] + $rand : $theGame['ScoreTeam1'] + $rand);
            $theGame['bkRobotScore2'] = ($theGame['ScoreTeam2'] > $theGame['ScoreTeam1'] ? $theGame['ScoreTeam2'] + $rand : $theGame['ScoreTeam2'] + $rand);
        }

        if ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 40 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 55) {
            $rand = rand(-20,20);
            $theGame['bkRobotScore1'] = ($theGame['ScoreTeam1'] > $theGame['ScoreTeam2'] ? $theGame['ScoreTeam1'] + $rand : $theGame['ScoreTeam1'] + $rand);
            $theGame['bkRobotScore2'] = ($theGame['ScoreTeam2'] > $theGame['ScoreTeam1'] ? $theGame['ScoreTeam2'] + $rand : $theGame['ScoreTeam2'] + $rand);
        }

        if ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 55 && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] <= 80) {
            $rand = rand(-25,25);
            $theGame['bkRobotScore1'] = ($theGame['ScoreTeam1'] > $theGame['ScoreTeam2'] ? $theGame['ScoreTeam1'] + $rand : $theGame['ScoreTeam1'] + $rand);
            $theGame['bkRobotScore2'] = ($theGame['ScoreTeam2'] > $theGame['ScoreTeam1'] ? $theGame['ScoreTeam2'] + $rand : $theGame['ScoreTeam2'] + $rand);
        }

        if ($theGame['ScoreTeam1'] != $theGame['ScoreTeam2'] && $theGame['ScoreTeam1'] + $theGame['ScoreTeam2'] > 80) {
            $rand = rand(-35,35);
            $theGame['bkRobotScore1'] = ($theGame['ScoreTeam1'] > $theGame['ScoreTeam2'] ? $theGame['ScoreTeam1'] + $rand : $theGame['ScoreTeam1'] + $rand);
            $theGame['bkRobotScore2'] = ($theGame['ScoreTeam2'] > $theGame['ScoreTeam1'] ? $theGame['ScoreTeam2'] + $rand : $theGame['ScoreTeam2'] + $rand);
        }
    }

    return $theGame;

}

function bkRobotResult ($theGame) {

    $t1 = $theGame['ScoreTeam1'];
    $b1 = $theGame['bkRobotScore1'];
    $t2 = $theGame['ScoreTeam2'];
    $b2 = $theGame['bkRobotScore2'];

    if(($t1 == $b1 && $t2 == $b2) || ($t1 == $t2 && $b1 == $b2)) {  // Если счёт равен
        $theGame['bkRobotResult'] = 3;
    } else {
        if(($t1 > $t2 && $b1 > $b2) || ($t1 < $t2 && $b1 < $b2)) { // Если угадана сторона
            $theGame['bkRobotResult'] = 2;
        } else { // Если даже сторона не угадана
            $theGame['bkRobotResult'] = 1;
        }
    }

    return $theGame;
}

// Перенос игры из базы текущих игр в архив (вставка, удаление)
function gameToArchive($key, $collectionGame, $collectionArchive, $collectionPercent) {
    $normalPercentDay   = getPercentDay($collectionPercent);
    $predictionPercent  = getPredictionPercent($collectionArchive);
    $filter             = array('key' => $key);
    $theGame            = $collectionGame->findOne($filter);
    $theGame            = getMaxBets($theGame);

    if ($theGame['Prediction'] != true) { // Делал ли наш аналитик предсказание?
        $theGame = getPredictionGame($normalPercentDay, $predictionPercent, $theGame, $collectionArchive);
        $theGame = setGameTeamStatus($theGame);
        $theGame = setGameScore($theGame);
    } else {
        $theGame = bkRobotResult($theGame);
        $theGame = setGameTeamStatus($theGame);
    }

    $theGame['TimeMove'] = date('Y-m-d H:i:s');
    $filterArch = array('key'=> $theGame['key']);
    $keyRemove  = array('key' => $theGame['key']);

    if($collectionArchive   ->  findOne($filterArch) || $theGame['BetsXbet'] == null) {
        $collectionGame     ->  remove($theGame);
        $collectionGame     ->  remove($keyRemove);
    } else {
        $collectionArchive  ->  insert($theGame);
        $collectionGame     ->  remove($theGame);
        $collectionGame     ->  remove($keyRemove);
    }



}

/*
 * 
 *  Начало
 * 
 */

/* Конектимся к базе и подключаем все коллекции */
$timeLoggerStart = microtime(true); // Считаем как долго выполнялся скрипт
$m = new MongoClient();

$db                     = $m    -> betkey;
$collectionGame         = $db   -> games;       // Игры в текущий момент
$collectionArchive      = $db   -> archive;     // Архив игр
$collectionPercent      = $db   -> percentDay;  // Норма процентов в сутки
$collectionLog          = $db   -> log;         // Норма процентов в сутки

/* Достаём json сайта 1xbet */
$file       = '/var/www/betkey.ru/parser/json/xbet/xbet.json';
$content    = file_get_contents($file);
$json       = json_decode($content);
$iterationCounter = 0;
$iterationLogger = array();

// Перебираем игры
foreach ($json->Value as $game) {
    $iterationStart = microtime(true);
    $iterationCounter++;

    if(xBetGameFilter($game)) { // Отсееваем игры
        $key = str_replace(' ', '', $game->SportNameEng . '-' .
            $game->Opp1Eng . '-' . $game->Opp2Eng . '-' . date('Y-m-d', $game->Start)); // Ключ
        if (checkGamesDB($key, $collectionGame)) { // Есть ли игра в текущих?
            if($game->Finished == true) { // Пришли ли данные с пометкой о том, что игра завершилась?
                updateGameDB($key, $collectionGame, $game);
                gameToArchive($key, $collectionGame, $collectionArchive, $collectionPercent);
            } else {
                updateGameDB($key, $collectionGame, $game);
            }
            updateGameDB($key, $collectionGame, $game);
        } else {
            makeGameDB($key, $collectionGame, $game);
        }
    }
    $iterationLogger[$iterationCounter] = microtime(true) - $iterationStart;
}


// Проверка на старость игры
$timeCheck = time() - 20;
$list = $collectionGame->find();
while($document = $list->getNext())
{
    if($document['LastUpdate'] < $timeCheck && $document['LastUpdate'] != null && $document['BetsXbet'] != null) {
        gameToArchive($document['key'], $collectionGame, $collectionArchive, $collectionPercent);
    }
    if($document['Finished'] == true) {
        gameToArchive($document['key'], $collectionGame, $collectionArchive, $collectionPercent);
    }
    if($document['LastUpdate'] != null && $document['BetsXbet'] == null) {
        $collectionGame->remove($document);
    }
}


$timeLogger = microtime(true) - $timeLoggerStart; // Считаем как долго выполнялся скрипт
$logCollector = array(
    'Date'          => date('Y-m-d H:i:s'),
    'Timer'         => $timeLogger,
    'EverIteration' => $iterationLogger,
);

$collectionLog->insert($logCollector);
$m->close();

?>