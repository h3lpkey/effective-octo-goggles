<?php include('includes/header.php'); ?>
<?php include('getData/connectDB.php'); ?>
<?php

$filter     = array('link' => $paramPage);
$cursor = $collectionArticles->find($filter);
foreach ($cursor as $document) {
    $theArticlePage['date'] = $document['date'];
    $theArticlePage['title'] = $document['title'];
    $theArticlePage['textPreview'] = $document['textPreview'];
    $theArticlePage['content'] = $document['content'];
}

?>
    <!-- News Item -->
    <article class="news-item news-details">
        <div class="padding border-bottom">
            <div class="post-date"><?php echo $theArticlePage['date']; ?></div>
        </div>
        <?php
        $countContentBlocks = count($theArticlePage['content']); // Считаем сколько блоков будет выводить
        for ( $i=0; $i<$countContentBlocks; $i++ )  {

            switch ($theArticlePage['content'][$i]['type']) {
                case 'text1' :
                    echo '<div class="description padding border-bottom">';
                    echo '<h1 class="post-title">'.$theArticlePage['content'][$i]['h'].'</h1>';
                    echo $theArticlePage['content'][$i]['text'];
                    echo '</div>';
                    break;
                case 'text2' :
                    echo '<div class="description padding border-bottom">';
                    echo '<h2 class="post-title">'.$theArticlePage['content'][$i]['h'].'</h2>';
                    echo $theArticlePage['content'][$i]['text'];
                    echo '</div>';
                    break;
                case 'text3' :
                    echo '<div class="description padding border-bottom">';
                    echo '<h3 class="post-title">'.$theArticlePage['content'][$i]['h'].'</h3>';
                    echo $theArticlePage['content'][$i]['text'];
                    echo '</div>';
                    break;
                case 'text4' :
                    echo '<div class="description padding border-bottom">';
                    echo '<h4 class="post-title">'.$theArticlePage['content'][$i]['h'].'</h4>';
                    echo $theArticlePage['content'][$i]['text'];
                    echo '</div>';
                    break;
                case 'li1' :
                    echo '<div class="description padding padding-bottom-10 background-light border-bottom">';
                    echo '<h4>'.$theArticlePage['content'][$i]['h'].'</h4>';
                    echo '<div class="row"><div class="col-sm-12">';
                    echo $theArticlePage['content'][$i]['text'];
                    echo '</div></div></div>';
                    break;
                case 'li2' :
                    echo '<div class="description padding padding-bottom-10 background-light border-bottom">';
                    echo '<h4>'.$theArticlePage['content'][$i]['h'].'</h4>';
                    echo '<div class="row"><div class="col-sm-6">';
                    $findUL = '</ul><ul>';
                    $instertNewUL = '</ul></div><div class="col-sm-6"><ul>';
                    $placeUL = strpos($theArticlePage['content'][$i]['text'], $findUL);
                    echo substr_replace($theArticlePage['content'][$i]['text'], $instertNewUL, $placeUL, 0);
                    echo '</div></div></div>';
                    break;
                case 'gallery' :
                    echo '<div class="description padding border-bottom"><h4>Фото / Видео</h4>';
                    echo '<div class="overflow-hidden"><div class="owl-carousel photo-slider">';
                    $countMediaBlocks = count($theArticlePage['content'][$i]['media']);
                    for ( $j=0; $j<$countMediaBlocks; $j++ ) {
                        switch ($theArticlePage['content'][$i]['media'][$j]['type']) {
                            case 'photo' :
                                echo '<div class="item"><div class="inner">';
                                echo '<img src="'.$theArticlePage['content'][$i]['media'][$j]['src'].'" alt=""/>';
                                echo '<a rel="photo" class="swipebox icon-photo" title="'.$theArticlePage['content'][$i]['media'][$j]['title'].'" href="'.$theArticlePage['content'][$i]['media'][$j]['src'].'"></a>';
                                echo '<div class="slide-description">'.$theArticlePage['content'][$i]['media'][$j]['text'].'</div>';
                                echo '</div></div>';
                                break;
                            case 'video' :
                                echo '<div class="item"><div class="inner">';
                                echo '<img src="'.$theArticlePage['content'][$i]['media'][$j]['imgSrc'].'" alt=""/>';
                                echo '<a rel="video" class="swipebox icon-play" title="'.$theArticlePage['content'][$i]['media'][$j]['title'].'" href="'.$theArticlePage['content'][$i]['media'][$j]['src'].'"></a>';
                                echo '<div class="slide-description">'.$theArticlePage['content'][$i]['media'][$j]['text'].'</div>';
                                echo '</div></div>';
                                break;
                        }
                    }
                    echo '</div></div></div>';
                    break;
            }

        }

        ?>


        <div class="text-right padding padding-top-0" style="margin-top: 25px">
            <?php include('includes/socialShare.php'); ?>

    </article>
    <!--/ News Item -->

    <!-- Posts -->
<?php include('includes/posts.php'); ?>
    <!--/ Posts -->

    <!-- Social Widgets -->
<?php include('includes/socialSubscribe.php'); ?>
    <!-- Subscribe Form -->
<?php include('includes/subscribeForm.php'); ?>
    <!--/ Subscribe Form -->


<?php include('includes/footer.php'); ?>