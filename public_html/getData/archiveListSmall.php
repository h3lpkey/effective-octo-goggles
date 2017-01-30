<?php include('connectDB.php'); ?>

<?php

function checkerPOSTtype($type) {
    switch ($type) {
        case '' :
            $type = 'Football';
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
$list = $collectionArchive->find($sportFilter);

$list -> limit($countViewGames);
$list -> sort(array('$natural' => -1));

while($document = $list->getNext())
{
    if ($document['bkRobotResult'] != null) {
    echo '<tr>
            <td>
                <ul>
                    <li>
                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-1">
                                <i class="game-type icon-'.mb_strtolower($document['SportNameEng']).'"></i>
                                <span class="status">'.date("d/m", strtotime($document['Date'])).'</span>
                            </div>

                            <div class="col-xs-7">
                                <div>
                                    <strong>Время:</strong>
                                    <span>'.date("H:i", strtotime($document['LastUpdate'])).'</span>
                                </div>

                                <div>
                                    <strong>Команды</strong>
                                    <span>'.$document['Team1Rus'].' - '.$document['Team2Rus'].'</span>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="stake-label no-arrow"><span>'.$document['ScoreTeam1'].' - '.$document['ScoreTeam2'].'</span></div>
                            </div>

                            <div class="col-xs-6">
                                <div class="stake-label no-arrow"><span>'.$document['bkRobotScore1'].' - '.$document['bkRobotScore2'].'</span></div>
                            </div>
                        </div>
                    </li>';
    switch ($document['bkRobotResult']) {
        case 1:
            echo '<li>
                      <a href="/game-archive/'.$document['key'].'"><span class="btn btn-small btn-label btn-red btn-wide">НЕ СОВПАЛО</span></a>
                  </li>';
            break;
        case 2:
            echo '<li>
                      <a href="/game-archive/'.$document['key'].'"><span class="btn btn-small btn-label btn btn-wide" style="background-color: #ffc01a;">СОВПАЛО НЕ ПОЛНОСТЬЮ</span></a>
                  </li>';
            break;
        case 3:
            echo '<li>
                      <a href="/game-archive/'.$document['key'].'"><span class="btn btn-small btn-label btn-wide" style="background-color: #ffa80e;">СОВПАЛО ПОЛНОСТЬЮ</span></a>
                  </li>';
            break;
    }
echo '          </ul>
            </td>
        </tr>';
} else {
        $countViewGames++;
    }
}
?>