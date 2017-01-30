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
    if($document['BetsXbet'] != null) {
        $bets = $document['BetsXbet']; // Для входа в подмосив
        echo '<tr class="' . mb_strtolower($document['SportNameEng']) . '"><td><i class="game-type icon-' . mb_strtolower($document['SportNameEng']) . '"></i></td>';
        if ($document['GamingNow'] != false) {
            echo '<td><span class="btn btn-small btn-yellow btn-label">Сейчас</span></td>';
        } else {
            echo '<td>' . date("d/m", strtotime($document['Date'])) . '</td>';
        }
        echo '<td>' . $document['MatchTime'] . '</td>' .
            '<td>' . $document['Team1Rus'] . ' - ' . $document['Team2Rus'] . '</td>';

        // Отображение ставок 3 шт.
        if ($bets[count($bets) - 1]['Win1'] >= $bets[count($bets) - 2]['Win1']) {
            echo '<td class="text-center"><div class="stake-label"><span>';
        } else { // отображать в зависимости от прошлой ставки
            echo '<td class="text-center"><div class="stake-label down"><span>';
        }
        echo $bets[count($bets) - 1]['Win1'];
        echo '</span></div></td>';
        if ($bets[count($bets) - 1]['Draw'] >= $bets[count($bets) - 2]['Draw']) {
            echo '<td class="text-center"><div class="stake-label"><span>';
        } else {
            echo '<td class="text-center"><div class="stake-label down"><span>';
        }
        echo $bets[count($bets) - 1]['Draw'];
        echo '</span></div></td>';

        if ($bets[count($bets) - 1]['Win2'] >= $bets[count($bets) - 2]['Win2']) {
            echo '<td class="text-center"><div class="stake-label"><span>';
        } else {
            echo '<td class="text-center"><div class="stake-label down"><span>';
        }
        echo $bets[count($bets) - 1]['Win2'];
        echo '</span></div></td>';

        // построенние ссылки на игру на сайте

        echo '<td class="text-right"><a href="/game/' . $document['key'] . '" class="btn btn-small">СРАВНИТЬ</a></td></tr>';
    } else {
        $countViewGames++;
    }

}
?>