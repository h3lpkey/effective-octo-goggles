<?php include('includes/header.php'); ?>
<?php include('getData/connectDB.php'); ?>
<?php
$filter     = array('key' => $paramPage);
$cursor = $collectionArchive->find($filter);
foreach ($cursor as $document) {
$theGamePage['Team1Rus'] = $document['Team1Rus'];
$theGamePage['Team2Rus'] = $document['Team2Rus'];
$theGamePage['icon'] = mb_strtolower($document['SportNameEng']);
$theGamePage['ChampRus'] = $document['ChampRus'];
$theGamePage['Date'] = date("d.m.Y", strtotime($document['Date']));
$theGamePage['MatchTime'] = $document['MatchTime'];
$theGamePage['ScoreTeam1'] = $document['ScoreTeam1'];
$theGamePage['ScoreTeam2'] = $document['ScoreTeam2'];
$theGamePage['bkRobotScore1'] = $document['bkRobotScore1'];
$theGamePage['bkRobotScore2'] = $document['bkRobotScore2'];
$theGamePage['bkRobotResult'] = $document['bkRobotResult'];
$theGamePage['xbetMax'] = $document['xbetMax'];
}

?>

    <!-- BreadCrumbs -->
    <ul class="breadcrumbs padding border-bottom clearfix">
        <li><a href="/index.php">Главная</a></li>
        <li><span>Архив игр</span></li>
    </ul>
    <!--/ BreadCrumbs -->

    <!-- Stakes Style 2 -->
    <section class="section-stakes style2">
        <div class="stakes-controls padding border-bottom">
            <div class="row">
                <div class="col-sm-7">
                    <ul class="tab-header clearfix">
<!--                        <li class="active"><a href="#table1" data-toggle="tab">Сейчас</a></li>-->
<!--                        <li><a href="#table2" data-toggle="tab">2 часа</a></li>-->
<!--                        <li><a href="#table3" data-toggle="tab">4 часа</a></li>-->
<!--                        <li><a href="#table4" data-toggle="tab">Линия</a></li>-->
                    </ul>
                </div>

                <div class="col-sm-5 text-right">
                    <a href="/subscribe" class="btn btn-medium btn-red btn-icon-right">ПОЛУЧИТЬ 100% ПРОГНОЗ<i class="icon-arrow-right4"></i></a>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <div id="table1" class="tab-pane fade in active">
                <ul class="event-details padding border-bottom clearfix">
                    <li><i class="game-type icon-<?php echo $theGamePage['icon']; ?>"></i></li>
                    <li><?php echo date("d/m", strtotime($theGamePage['Date']));?></li>
                    <li><strong><?php echo $theGamePage['Team1Rus'].' - '.$theGamePage['Team2Rus']; ?></strong></li>
                </ul>

                <div class="hidden-xs">
                    <?php include('includes/arch-table-3.php'); ?>
                </div>

                <div class="visible-xs">
                    <?php include('includes/arch-table-4.php'); ?>
                </div>
            </div>
        </div>
    </section>
    <!--/ Stakes Style 2 -->

        <!-- Game Details Style 2 -->
    <section class="section-game-details style2 border-bottom">
        <h2 class="section-title green">Результаты BetKey Robots</h2>

        <div class="game-teams padding" style="background-image: url(/images/temp/game-details-bg.jpg);">
            <h4 class="title"><?php echo $theGamePage['ChampRus']; ?></h4>
            <div class="game-date">Дата матча: <?php echo $theGamePage['Date']; ?></div>

            <div class="inner">
                <div class="team">
                    <div class="name"><?php echo $theGamePage['Team1Rus']; ?></div>
<!--                    <div class="coat"><img src="images/temp/coat-1.png" alt=""/></div>-->
                </div>

                <div class="team visible-xs-inline-block">
                    <div class="name"><?php echo $theGamePage['Team2Rus']; ?></div>
<!--                    <div class="coat"><img src="images/temp/coat-2.png" alt=""/></div>-->
                </div>

                <div class="score">
                    <span><?php echo $theGamePage['bkRobotScore1']; ?></span><em>:</em><span><?php echo $theGamePage['bkRobotScore2']; ?></span>
                </div>

                <div class="team hidden-xs">
                    <div class="name"><?php echo $theGamePage['Team2Rus']; ?></div>
<!--                    <div class="coat"><img src="images/temp/coat-2.png" alt=""/></div>-->
                </div>
            </div>

            <a href="/subscribe" class="btn <?php
                switch ($theGamePage['bkRobotResult']) {
                    case 1:
                        echo 'btn-red">Ставка не сыграла';
                        break;
                    case 2:
                        echo '<i class="icon-star"></i> <i class="icon-star"></i> <i class="icon-star"></i> Ставка сыграла не полностью';
                        break;
                    case 3:
                        echo 'btn-yellow"><i class="icon-star"></i> <i class="icon-star"></i> <i class="icon-star"></i> Ставка сыграла полностью';
                        break;
                }
                ?></a>
        </div>
    </section>
    <!--/ Game Details Style 2 -->

    <!-- Game Details -->
    <section class="section-game-details border-bottom">
<!--        <div class="game-time padding border-bottom">Время игры 23 мин. : 11 сек.</div>-->

        <div class="game-teams padding">
            <div class="team">
                <div class="name"><?php echo $theGamePage['Team1Rus']; ?></div>
<!--                <div class="coat"><img src="images/temp/coat-1.png" alt=""/></div>-->
            </div>

            <div class="team visible-xs-inline-block">
                <div class="name"><?php echo $theGamePage['Team2Rus']; ?></div>
<!--                <div class="coat"><img src="images/temp/coat-2.png" alt=""/></div>-->
            </div>

            <div class="score">
                <span><?php echo $theGamePage['ScoreTeam1']; ?></span><em>:</em><span><?php echo $theGamePage['ScoreTeam2']; ?></span>
            </div>

            <div class="team hidden-xs">
                <div class="name"><?php echo $theGamePage['Team2Rus']; ?></div>
<!--                <div class="coat"><img src="images/temp/coat-2.png" alt=""/></div>-->
            </div>
        </div>
    </section>
    <!--/ Game Details -->

    <!-- Text Block -->
    <section class="section-text padding">
        <h5 class="h5 no-transform margin-bottom-30">Футбол</h5>

        <p>
            Футбол называют самой популярной игрой в мире, и он, безусловно, имеет очень много поклонников в Великобритании. Это игра, в которую играют почти во всех странах.
            Команда состоит из 11 игроков: вратарь, защитники, полузащитники и нападающие. Капитаном команды, как правило, является самый старший или самый лучший игрок.
            Футбольное поле должно быть от 100 до 130 метров в длину и от 50 до 100 метров в ширину.
        </p>

        <p>
            Оно делится на две половины по средней линии. В середине поля есть центральный круг и есть ворота на каждой стороне. Перед каждыми воротами находится штрафная площадка.
            В штрафной площади есть "точка" пенальти и дуга за ее пределами. Игра в футбол обычно длится полтора часа. В перерыве команды меняются сторонами площадки.
            Целью каждой команды является забить как можно больше голов.
        </p>

        <p>
            Финал чемпионата по футболу в Англии проходит ежегодно в мае на знаменитом стадионе "Уэмбли" в Лондоне. Некоторые из наиболее известных клубов в Англии:
            "Манчестер Юнайтед", "Ливерпуль" и "Арсенал". В Шотландии Рейнджерс, либо Сельтик или Абердин обычно выигрывают кубок или чемпионат.
        </p>
    </section>
    <!--/ Text Block -->

    <!-- Social Widgets -->
    <section class="section-social-widgets section-light padding padding-bottom-10 border-bottom">
        <div class="row">
            <div class="col-sm-4">
                <a href="#" class="btn btn-icon-left btn-wide btn-vk"><i class="icon-vk"></i>Подписаться</a>
            </div>

            <div class="col-sm-4">
                <a href="#" class="btn btn-icon-left btn-wide btn-fb"><i class="icon-fb"></i>Подписаться</a>
            </div>

            <div class="col-sm-4">
                <a href="#" class="btn btn-icon-left btn-wide btn-tw"><i class="icon-tw"></i>Подписаться</a>
            </div>
        </div>

        <!--<div class="row">
            <div class="col-sm-4">
                <script type="text/javascript" src="//vk.com/js/api/openapi.js?124"></script>

                <!— VK Widget —>
                <div id="vk_groups"></div>
                <script type="text/javascript">
                    VK.Widgets.Group("vk_groups", {redesign: 1, mode: 4, width: "220", height: "400", color1: 'FFFFFF', color2: '000000', color3: '5E81A8'}, 122420357);
                </script>
            </div>

            <div class="col-sm-4">
                <a class="twitter-timeline" href="https://twitter.com/betkey_official">Tweets by betkey_official</a>
                <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>

            <div class="col-sm-4">
                <a class="twitter-timeline" href="https://twitter.com/betkey_official">Tweets by betkey_official</a>
                <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
        </div>-->
    </section>
    <!--/ Social Widgets -->

    <!-- Subscribe Form -->
    <form class="form-subscribe padding border-bottom" action="#">
        <div class="row">
            <div class="col-sm-2 col-md-3">
                <label for="subscribe-email">Получите 10 бесплатных прогнозов</label>
            </div>

            <div class="col-sm-6">
                <input type="email" id="subscribe-email" class="form-control" name="subscribe-email" placeholder="E-mail"/>
            </div>

            <div class="col-sm-4 col-md-3">
                <input type="submit" class="btn btn-red btn-wide" value="ПОЛУЧИТЬ ПРОГНОЗ"/>
            </div>
        </div>
    </form>
    <!--/ Subscribe Form -->

<?php include('includes/footer.php'); ?>