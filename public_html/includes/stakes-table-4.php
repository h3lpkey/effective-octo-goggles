<!-- Stakes Table -->
<div class="overflow-hidden">
    <table class="table table-striped table-hover border-bottom margin-bottom-0">
        <thead>
        <tr>
            <td class="fsz18">Ставки</td>
        </tr>
        </thead>

        <tbody>
        <?php $bets = $document['BetsXbet']; ?>
        <tr>
            <td>
                <ul>
                    <li>
                        <div class="row">
                            <div class="col-xs-4">
                                <img src="/images/temp/partner-xbet.png" alt=""/>
                            </div>

                            <div class="col-xs-4 text-center">
                                <a href="/office-review/xbet" class="btn btn-small">ОБЗОР</a>
                            </div>

                            <div class="col-xs-4 text-right">
                                <a href="https://1xbet.com" class="btn btn-small btn-yellow">ПЕРЕЙТИ</a>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="stake-label"><span><?php echo $bets[count($bets)-1]['Win1']; ?></span></div>
                            </div>

                            <div class="col-xs-4">
                                <div class="stake-label down"><span><?php echo $bets[count($bets)-1]['Draw']; ?></span></div>
                            </div>

                            <div class="col-xs-4">
                                <div class="stake-label"><span><?php echo $bets[count($bets)-1]['Win2']; ?></span></div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <a href="<?php echo $document['xbetGameLink'] ?>" class="btn btn-medium btn-red btn-wide">СДЕЛАТЬ СТАВКУ</a>
                    </li>
                </ul>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<!--/ Stakes Table -->