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
                    $false =0;
                    $half = 0;
                    $right = 0;

                    $list = $collectionArchive->find();
                    $list -> limit(300);
                    $list -> sort(array('$natural' => - 1, 'bkRobotResult' => 1));
                    while($document = $list->getNext()) {
                        if($document['bkRobotResult'] == 1) $false++;
                        if($document['bkRobotResult'] == 2) $half++;
                        if($document['bkRobotResult'] == 3) $right++;
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
                <a href="/archive-list" class="btn btn-wide">ПРОСМОТРЕТЬ РЕЗУЛЬТАТЫ ПОДРОБНЕЕ</a>
            </div>
        </div>
    </div>
</section>