<?php include('connectDB.php'); ?>

<?php
$list = $collectionBk->find();
while($document = $list->getNext())
{
    echo '<tr><td><i class="game-type icon-'.mb_strtolower($document['SportNameEng']).'"></i></td>';
    if ($document['GamingNow'] != false) {
        echo '<td><span class="btn btn-small btn-yellow btn-label">Сейчас</span></td>';
    } else {
        echo '<td>'.date("d/m", strtotime($document['Date'])).'</td>';
    }
    echo '<td>'.$document['MatchTime'].'</td>'.
        '<td>'.$document['Team1Rus'].' - '.$document['Team2Rus'].'</td>';

    // Отображение ставок 3 шт.
    $bets = $document['BetsXbet']; // Для входа в подмосив
    if($bets[count($bets)-1]['Win1'] >= $bets[count($bets)-2]['Win1']) {
        echo '<td class="text-center"><div class="stake-label"><span>';
    } else { // отображать в зависимости от прошлой ставки
        echo '<td class="text-center"><div class="stake-label down"><span>';
    }
    echo $bets[count($bets)-1]['Win1'];
    echo '</span></div></td>';
    if($bets[count($bets)-1]['Draw'] >= $bets[count($bets)-2]['Draw']) {
        echo '<td class="text-center"><div class="stake-label"><span>';
    } else {
        echo '<td class="text-center"><div class="stake-label down"><span>';
    }
    echo $bets[count($bets)-1]['Draw'];
    echo '</span></div></td>';

    if($bets[count($bets)-1]['Win2'] >= $bets[count($bets)-2]['Win2']) {
        echo '<td class="text-center"><div class="stake-label"><span>';
    } else {
        echo '<td class="text-center"><div class="stake-label down"><span>';
    }
    echo $bets[count($bets)-1]['Win2'];
    echo '</span></div></td>';

    // построенние ссылки на игру на сайте

    echo '<td class="text-right"><a href="/game/'.$document['key'].'" class="btn btn-small">СРАВНИТЬ</a></td></tr>';

}
?>