<?php include('includes/header.php'); ?>
<?php include('getData/connectDB.php'); ?>


    <!-- Archive -->
    <section class="section-archive border-bottom">
        <div class="archive-controls padding border-bottom">
            <div class="row">
                <div class="col-md-4 text-right hidden-sm hidden-xs">
                    <a href="/subscribe" class="btn btn-medium btn-red btn-icon-right">ПОЛУЧИТЬ 100% ПРОГНОЗ<i class="icon-arrow-right4"></i></a>
                </div>
            </div>
        </div>

        <div class="hidden-xs">
            <?php include('includes/archive-table-1.php'); ?>
        </div>

        <div class="visible-xs">
            <?php include('includes/archive-table-2.php'); ?>
        </div>

        <div class="show-more-wrapper"><a class="show-more" id="countViewArchiveList" href="#">ЕЩЕ<i class="icon-arrow-down3"></i></a></div>
    </section>
    <!--/ Archive -->

    <!-- Text Block -->
    <article class="news-item news-details">
        <?php
        if ($paramPage == '') {
            $filter     = array('page' => 'archive-list');
            $cursor = $collectionPageText->find($filter);
            foreach ($cursor as $document) {
                $thePageText['content'] = $document['content']; // обрати внимание, базы разные, записываются в одну переменную
            }
            $countContentBlocks = count($thePageText['content']); // Считаем сколько блоков будет выводить
            
        } else {
            $filter = array('sportName' => $paramPage);
            $cursor = $collectionSportText->find($filter);
            foreach ($cursor as $document) {
                $thePageText['content'] = $document['content']; // обрати внимание, базы разные, записываются в одну переменную
            }
            $countContentBlocks = count($thePageText['content']); // Считаем сколько блоков будет выводить
        }
        
            for ( $i=0; $i<$countContentBlocks; $i++ )  {
                switch ($thePageText['content'][$i]['type']) {
                    case 'text1' :
                        echo '<div class="description padding border-bottom">';
                        echo '<h1 class="h1 post-title">'.$thePageText['content'][$i]['h'].'</h1>';
                        echo $thePageText['content'][$i]['text'];
                        echo '</div>';
                        break;
                    case 'text2' :
                        echo '<div class="description padding border-bottom">';
                        echo '<h2 class="h2 no-transform margin-bottom-30">'.$thePageText['content'][$i]['h'].'</h2>';
                        echo '<p>'.$thePageText['content'][$i]['text'].'</p>';
                        echo '</div>';
                        break;
                    case 'text3' :
                        echo '<div class="description padding border-bottom">';
                        echo '<h3 class="h3 no-transform margin-bottom-30">'.$thePageText['content'][$i]['h'].'</h3>';
                        echo '<p>'.$thePageText['content'][$i]['text'].'</p>';
                        echo '</div>';
                        break;
                    case 'text4' :
                        echo '<div class="description padding border-bottom">';
                        echo '<h4 class="h4 no-transform margin-bottom-30">'.$thePageText['content'][$i]['h'].'</h4>';
                        echo '<p>'.$thePageText['content'][$i]['text'].'</p>';
                        echo '</div>';
                        break;
                    case 'li1' :
                        echo '<div class="description padding padding-bottom-10 background-light border-bottom">';
                        echo '<h4>'.$thePageText['content'][$i]['h'].'</h4>';
                        echo '<div class="row"><div class="col-sm-12">';
                        echo $thePageText['content'][$i]['text'];
                        echo '</div></div></div>';
                        break;
                    case 'li2' :
                        echo '<div class="description padding padding-bottom-10 background-light border-bottom">';
                        echo '<h2>'.$thePageText['content'][$i]['h'].'</h2>';
                        echo '<div class="row"><div class="col-sm-6">';
                        $findUL = '</ul><ul>';
                        $instertNewUL = '</ul></div><div class="col-sm-6"><ul>';
                        $placeUL = strpos($thePageText['content'][$i]['text'], $findUL);
                        echo substr_replace($thePageText['content'][$i]['text'], $instertNewUL, $placeUL, 0);
                        echo '</div></div></div>';
                        break;
                }
        }
        ?>

    </article>
    <!--/ Text Block -->

    <!-- Results Chart -->
    <section class="section-results-chart border-bottom">
        <h2 class="section-title">Результаты BetKey Robots За 24 ЧАСА</h2>

        <div class="padding">
            <div class="row">
                <div class="col-sm-7">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="pie-chart-frame">
                                <?php include('includes/chart-2.php'); ?>
                            </div>
                        </div>
                        <?php
                        for ($i = 1; $i < 4; $i++) {
                            $filterPrediction[$i]   = array('bkRobotResult' => $i);
                            $archPrediction[$i]     = $collectionArchive    ->find($filterPrediction[$i]);
                            $countPrediction[$i]    = $archPrediction[$i]   ->count();
                        }
                        ?>
                        <div class="col-md-8">
                            <ul class="pie-chart-legend">
                                <li>
                                    <i style="background-color: #ffa80e;"></i>
                                    <strong style="color: #ffa80e;"><?php echo $right; ?></strong>
                                    <span>Ставок зашло полностью</span>
                                </li>

                                <li>
                                    <i style="background-color: #ffc01a;"></i>
                                    <strong style="color: #ffc01a;"><?php echo $half; ?></strong>
                                    <span>Ставок зашло не полностью</span>
                                </li>

                                <li>
                                    <i style="background-color: #f26c4f;"></i>
                                    <strong style="color: #f26c4f;"><?php echo $false; ?></strong>
                                    <span>Ставок не зашли вообще</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <p class="text-center margin-top-40">Что бы узнать - какие ставки сыграли, можно посмотреть подробнее в лобби ставок! Приятного просмотра.</p>
                    <a href="#" class="btn btn-wide">ПРОСМОТРЕТЬ РЕЗУЛЬТАТЫ ПОДРОБНЕЕ</a>
                </div>
            </div>
        </div>
    </section>
    <!--/ Results Chart -->

    <!-- Social Widgets -->
<?php include('includes/socialSubscribe.php'); ?>

    <!-- Subscribe Form -->
<?php include('includes/subscribeForm.php'); ?>

<?php include('includes/footer.php'); ?>