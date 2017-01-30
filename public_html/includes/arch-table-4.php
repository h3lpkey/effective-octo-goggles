<!-- Stakes Table -->
<div class="overflow-hidden">
    <table class="table table-striped table-hover border-bottom margin-bottom-0">
        <thead>
        <tr>
            <td class="fsz18">Ставки</td>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>
                <ul>
                    <li>
                        <div class="row">
                            <div class="col-xs-4">
                                <img src="/images/bkImage/xbet.gif" alt=""/>
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
                                <div class="stake-label"><span><?php echo $theGamePage['xbetMax']['Win1']; ?></span></div>
                            </div>

                            <div class="col-xs-4">
                                <div class="stake-label down"><span><?php echo $theGamePage['xbetMax']['Draw']; ?></span></div>
                            </div>

                            <div class="col-xs-4">
                                <div class="stake-label"><span><?php echo $theGamePage['xbetMax']['Win2']; ?></span></div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <?php
                        switch ($theGamePage['bkRobotResult']) {
                            case 1:
                                echo '<div class="btn btn-medium btn-red btn-wide">Ставка не сыграла</div>';
                                break;
                            case 2:
                                echo '<div class="btn btn-medium btn-wide"><i class="icon-star"></i> <i class="icon-star"></i> <i class="icon-star"></i> Ставка сыграла не полностью</div>';
                                break;
                            case 3:
                                echo '<div class="btn btn-medium btn-yellow btn-wide"><i class="icon-star"></i> <i class="icon-star"></i> <i class="icon-star"></i> Ставка сыграла полностью</div>';
                                break;
                        }
                        ?>
                    </li>
                </ul>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<!--/ Stakes Table -->