
<!-- SideBar -->
<aside class="sidebar sidebar-sticky">
    <a href="#" class="sidebar-toggle"><i class="icon-arrow-left2"></i></a>

    <div class="sidebar-inner">
        <!-- Widget Pie Chart -->
        <div class="widget widget-chart">
            <h3 class="widget-title">РЕЗУЛЬТАТ ЗА 24 ЧАСА</h3>

            <div class="widget-content padding">
                <h4 class="title">Всего прогнозов</h4>

                <div class="pie-chart-frame">
                    <?php include('includes/chart-1.php'); ?>
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

                
//                for ($i = 1; $i < 4; $i++) {
//                    $filterPrediction[$i]   = array('bkRobotResult' => $i);
//                    $archPrediction[$i]     -> limit(10);
//                    $archPrediction[$i]     = $collectionArchive    ->find($filterPrediction[$i]);
//                    $countPrediction[$i]    = $archPrediction[$i]   ->count();
//                }
//                $allCount = $countPrediction[1]+$countPrediction[2]+$countPrediction[3];
                ?>
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

                <a href="/archive-list" class="btn btn-yellow btn-wide">ПОДРОБНЕЕ</a>
            </div>
        </div>
        <!--/ Widget Pie Chart -->

                <!-- Widget Partners -->
        <div class="widget widget-partners">
            <h4 class="widget-title">НАШИ ПАРТНЕРЫ</h4>

            <div class="widget-content">
                <ul class="clearfix">
                    <?php
                    $list = $collectionBk -> find();
                    $list -> limit(4);
                    while($bk = $list->getNext()) {
                        echo '<li>';
                        echo '<img src="/images/bkImage/'.$bk['img'].'" alt=""/>';
                        echo '<a href="/office-review/'.$bk['nameEng'].'" class="btn btn-small btn-wide">ОБЗОР</a>';
                        echo '<a href="'.$bk['link'].'" class="btn btn-yellow btn-small btn-wide">ПЕРЕЙТИ НА САЙТ</a>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!--/ Widget Partners -->
    </div>
</aside>

<!--/ SideBar -->