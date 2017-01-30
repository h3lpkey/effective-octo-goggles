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
    $list = $collectionArchive->find();
} else {
    $list = $collectionArchive->find($sportFilter);
}
$list -> limit($countViewGames);
$list -> sort(array('$natural' => -1, 'bkRobotResult' => 1));
while($document = $list->getNext())
{
    if ($document['bkRobotResult'] != null) {
        echo '<tr><td><ul><li><div class="row"><div class="col-xs-5"><i class="game-type icon-' . mb_strtolower($document['SportNameEng']) . '"></i>';
        echo '<span class="status">' . date("d/m", strtotime($document['Date'])) . '</span></div>';
        echo '<div class="col-xs-7"><div><strong>Время: </strong><span>' . date("H:i", strtotime($document['TimeMove'])) . '</span></div>';
        echo '<div><strong>Команды</strong>: <span>' . $document['Team1Rus'] . ' - ' . $document['Team2Rus'] . '</span>';
        echo '<div><strong>Результат: </strong><span class="font-semi color-green">' . $document['ScoreTeam1'] . ' : ' . $document['ScoreTeam2'] . '</span></div></div></div></li>';
        switch ($document['bkRobotResult']) {
            case 1:
                echo '<li class="margin-top-20"><a href="/game-archive/' . $document['key'] . '" class="btn btn-small btn-red btn-icon-left btn-wide">Не СЫГРАНО</a>';
                break;
            case 2:
                echo '<li class="margin-top-20"><a href="/game-archive/' . $document['key'] . '" class="btn btn-small btn-icon-left btn-wide" style="background-color: #ffc01a;"><i class="icon-star"></i><i class="icon-star"></i>СЫГРАНО</a>';
                break;
            case 3:
                echo '<li class="margin-top-20"><a href="/game-archive/' . $document['key'] . '" class="btn btn-small btn-icon-left btn-wide" style="background-color: #ffa80e;"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>СЫГРАНО</a>';
                break;
        }
        echo '</ul></td></tr>';
    } else {
        $countViewGames++;
    }
}
?>