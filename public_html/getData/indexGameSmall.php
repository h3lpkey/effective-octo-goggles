<?php include('connectDB.php'); ?>

<?php

function checkerPOSTtype($type) {
    switch ($type) {
        case '' :
            $type = 'none';
            return $type;
            break;
        case 'football' :
            $type = 'Football';
            return $type;
            break;
        case 'hokkey' :
            $type = 'Ice hockey';
            return $type;
            break;
        case 'tennis' :
            $type = 'Tennis';
            return $type;
            break;
        case 'volley' :
            $type = 'Volleyball';
            return $type;
            break;
        case 'snooker' :
            $type = 'Snooker';
            return $type;
            break;
        case 'baseball' :
            $type = 'Baseball';
            return $type;
            break;
        case 'badminton' :
            $type = 'Badminton';
            return $type;
            break;
        case 'racing' :
            $type = 'Formula 1';
            return $type;
            break;
        case 'cricket' :
            $type = 'Cricket';
            return $type;
            break;
        case 'cycling' :
            $type = 'Bicycle Racing';
            return $type;
            break;
        case 'rugby' :
            $type = 'Rugby';
            return $type;
            break;
        case 'basketball' :
            $type = 'Basketball';
            return $type;
            break;
        case 'handball' :
            $type = 'Handball';
            return $type;
            break;
        default :
            exit();
            break;
    }
}

function checkerPOSTcount($count) {
    if ($count % 5 == 0) {
        return $count;
    } else {
        $count = 5;
        return $count;
    }
}
$sportType = checkerPOSTtype($_POST['type']);
$countViewGames = checkerPOSTcount($_POST['count']);
$sportFilter = array('SportNameEng' => $sportType);
if ($sportType == 'none') {
    $list = $collectionGame->find();
} else {
    $list = $collectionGame->find($sportFilter);
}
$list -> limit($countViewGames);
while($document = $list->getNext())
{
    if ($document['BetsXbet'] != null) {
        echo '<tr><td><ul><li><div class="row"><div class="col-xs-5"><i class="game-type icon-' . mb_strtolower($document['SportNameEng']) . '"></i>';
        if ($document['GamingNow'] == false) {
            echo '<span class="status"><span class="btn btn-small btn-yellow btn-label">Сейчас</span></span></div>';
        } else {
            echo '<span class="status">' . date("d/m", strtotime($document['Date'])) . '</span></div>';
        }
        echo '<div class="col-xs-7"><div><strong>Время: </strong><span>' . $document['MatchTime'] . '</span></div>' .
            '<div><strong>Команды: </strong><span>' . $document['Team1Rus'] . ' - ' . $document['Team2Rus'] . '</span></div></div></div></li>';

        // Отображение ставок 3 шт.
        $bets = $document['BetsXbet']; // Для входа в подмосив
        if ($bets[count($bets) - 1]['Win1'] >= $bets[count($bets) - 2]['Win1']) {
            echo '<div class="col-xs-4"><div class="stake-label"><span>';
        } else { // отображать в зависимости от прошлой ставки
            echo '<div class="col-xs-4"><div class="stake-label down"><span>';
        }
        echo $bets[count($bets) - 1]['Win1'];
        echo '</span></div></div>';

        if ($bets[count($bets) - 1]['Draw'] >= $bets[count($bets) - 2]['Draw']) {
            echo '<div class="col-xs-4"><div class="stake-label"><span>';
        } else { // отображать в зависимости от прошлой ставки
            echo '<div class="col-xs-4"><div class="stake-label down"><span>';
        }
        echo $bets[count($bets) - 1]['Draw'];
        echo '</span></div></div>';

        if ($bets[count($bets) - 1]['Win2'] >= $bets[count($bets) - 2]['Win2']) {
            echo '<div class="col-xs-4"><div class="stake-label"><span>';
        } else { // отображать в зависимости от прошлой ставки
            echo '<div class="col-xs-4"><div class="stake-label down"><span>';
        }
        echo $bets[count($bets) - 1]['Win2'];
        echo '</span></div></div>';
        echo '</div></div></li>';

        // построенние ссылки на игру на сайте

        echo '<li><a href="/game/' . $document['key'] . '" class="btn btn-small btn-wide">СРАВНИТЬ</a></li></ul></td></tr>';
    } else {
        $countViewGames++;
    }
}
?>