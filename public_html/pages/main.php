<?php include('includes/header.php'); ?>
<?php include('getData/connectDB.php'); ?>
<!-- Stakes -->
<section class="section-stakes border-bottom">
    <div class="stakes-controls padding border-bottom">
        <div class="row">
            <div class="col-sm-7">
                <ul class="tab-header clearfix headerTable">
<!--                    <li class="active"><a href="#table1" data-index="now" data-toggle="tab">Сейчас</a></li>-->
<!--                    <li><a href="#table2" data-index="2" data-toggle="tab">2 часа</a></li>-->
<!--                    <li><a href="#table3" data-index="4" data-toggle="tab">4 часа</a></li>-->
<!--                    <li><a href="#table4" data-index="line" data-toggle="tab">Линия</a></li>-->
                </ul>
            </div>

            <div class="col-sm-5 text-right">
                <a href="/subscribe" class="btn btn-medium btn-red btn-icon-right">ПОЛУЧИТЬ 100% ПРОГНОЗ<i class="icon-arrow-right4"></i></a>
            </div>
        </div>
    </div>

    <div class="tab-content">
        <div id="table1" class="tab-pane fade in active">
            <div class="hidden-xs">
                <?php include('includes/stakes-table-1.php'); ?>
            </div>

            <div class="visible-xs">
                <?php include('includes/stakes-table-2.php'); ?>
            </div>

            <div class="show-more-wrapper"><a class="show-more" id="countViewGames" href="#">Еще<i class="icon-arrow-down3"></i></a></div>
        </div>
</section>
<!--/ Stakes -->

<!-- Results -->
<section class="section-results border-bottom">
    <h2 class="section-title green">Результаты BetKey Robots</h2>

    <div class="hidden-xs">
        <?php include('includes/results-table-1.php'); ?>
    </div>

    <div class="visible-xs">
        <?php include('includes/results-table-2.php'); ?>
    </div>

    <div class="show-more-wrapper"><a class="show-more" id="countViewArchive" href="#">ЕЩЕ<i class="icon-arrow-down3"></i></a></div>
</section>
<!--/ Results -->

<!-- Results Chart -->
<?php include('includes/preChart.php'); ?>

<!-- Social Widgets -->
<section class="section-social-widgets section-light padding border-bottom">
    <?php include('includes/socialSubscribe.php'); ?>


    <div class="row">
        <div class="col-sm-4">
            <script type="text/javascript" src="//vk.com/js/api/openapi.js?124"></script>

            <!— VK Widget —>
            <div id="vk_groups"></div>
            <script type="text/javascript">
                VK.Widgets.Group("vk_groups", {redesign: 1, mode: 4, width: "300", height: "400", color1: 'FFFFFF', color2: '000000', color3: '5E81A8'}, 122420357);
            </script>
        </div>

        <div class="col-sm-4">
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.7";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
            <div class="fb-page" data-width="300" data-height="400" data-href="https://www.facebook.com/BetKey-1064301880332753/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/BetKey-1064301880332753/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/BetKey-1064301880332753/">BetKey</a></blockquote></div>
        </div>

        <div class="col-sm-4">
            <a class="twitter-timeline" href="https://twitter.com/bet_betkey" width="300" height="400" data-chrome="noheader nofooter noborders transparent" font-family="'Proxima Nova', sans-serif">Tweets by bet_betkey</a>
            <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>



    </div>
</section>
<!--/ Social Widgets -->

<!-- Text Block -->
    <article class="news-item news-details">
    <?php

    $filter     = array('page' => 'main');
    $cursor = $collectionPageText->find($filter);
    foreach ($cursor as $document) {
        $thePageText['content'] = $document['content'];
    }
    
    $countContentBlocks = count($thePageText['content']); // Считаем сколько блоков будет выводить
    for ( $i=0; $i<$countContentBlocks; $i++ )  {

        switch ($thePageText['content'][$i]['type']) {
            case 'text1' :
                echo '<div class="description padding border-bottom">';
                echo '<h1 class="post-title">'.$thePageText['content'][$i]['h'].'</h1>';
                echo $thePageText['content'][$i]['text'];
                echo '</div>';
                break;
            case 'text2' :
                echo '<div class="description padding border-bottom">';
                echo '<h2 class="post-title">'.$thePageText['content'][$i]['h'].'</h2>';
                echo $thePageText['content'][$i]['text'];
                echo '</div>';
                break;
            case 'text3' :
                echo '<div class="description padding border-bottom">';
                echo '<h3 class="post-title">'.$thePageText['content'][$i]['h'].'</h3>';
                echo $thePageText['content'][$i]['text'];
                echo '</div>';
                break;
            case 'text4' :
                echo '<div class="description padding border-bottom">';
                echo '<h4 class="post-title">'.$thePageText['content'][$i]['h'].'</h4>';
                echo $thePageText['content'][$i]['text'];
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
                echo '<h4>'.$thePageText['content'][$i]['h'].'</h4>';
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

<!-- Subscribe Form -->
<?php include('includes/subscribeForm.php'); ?>

<!--/ Subscribe Form -->
<?php include('includes/posts.php'); ?>


<?php include('includes/footer.php'); ?>