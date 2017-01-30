<!-- Stakes Table -->
<div class="overflow-hidden">
    <table class="table table-striped table-hover border-bottom margin-bottom-0">
        <thead>
        <tr>
            <td colspan="3"></td>
            <td class="text-center">1</td>
            <td class="text-center">x</td>
            <td class="text-center">2</td>
            <td></td>
        </tr>
        </thead>

        <tbody id="game-game">

<?php $bets = $document['BetsXbet']; ?>
        <tr>
            <td><img src="/images/bkImage/xbet.gif" alt=""/></td>
            <td><a href="/office-review/xbet" class="btn btn-small">ОБЗОР</a></td>
            <td><a href="https://1xbet.com" class="btn btn-small btn-yellow">ПЕРЕЙТИ НА САЙТ</a></td>
            <td class="text-center"><div class="stake-label"><span><?php echo $bets[count($bets)-1]['Win1']; ?></span></div></td>
            <td class="text-center"><div class="stake-label down"><span><?php echo $bets[count($bets)-1]['Draw']; ?></span></div></td>
            <td class="text-center"><div class="stake-label"><span><?php echo $bets[count($bets)-1]['Win2']; ?></span></div></td>
            <td class="text-right"><a href="<?php echo $document['xbetGameLink'] ?>" class="btn btn-medium btn-red">СДЕЛАТЬ СТАВКУ</a></td>
        </tr>

        </tbody>
    </table>
</div>
<!--/ Stakes Table -->