<?php include('includes/header.php'); ?>
<?php include('getData/connectDB.php'); ?>
<?php
$filter     = array('link' => $paramPage);
$cursor = $collectionNews->find($filter);
foreach ($cursor as $document) {
    $theNewPage['date'] = $document['date'];
    $theNewPage['title'] = $document['title'];
    $theNewPage['textPreview'] = $document['textPreview'];
    $theNewPage['content'] = $document['content'];
}

?>
    <!-- News Item -->
    <article class="news-item news-details">
        <div class="padding border-bottom">
            <div class="post-date"><?php echo $theNewPage['date']; ?></div>

        </div>
        <?php
        $countContentBlocks = count($theNewPage['content']); // Считаем сколько блоков будет выводить
        for ( $i=0; $i<$countContentBlocks; $i++ )  {

            switch ($theNewPage['content'][$i]['type']) {
                case 'text1' :
                    echo '<div class="description padding border-bottom">';
                    echo '<h1 class="post-title">'.$theNewPage['content'][$i]['h'].'</h1>';
                    echo $theNewPage['content'][$i]['text'];
                    echo '</div>';
                    break;
                case 'text2' :
                    echo '<div class="description padding border-bottom">';
                    echo '<h2 class="post-title">'.$theNewPage['content'][$i]['h'].'</h2>';
                    echo $theNewPage['content'][$i]['text'];
                    echo '</div>';
                    break;
                case 'text3' :
                    echo '<div class="description padding border-bottom">';
                    echo '<h3 class="post-title">'.$theNewPage['content'][$i]['h'].'</h3>';
                    echo $theNewPage['content'][$i]['text'];
                    echo '</div>';
                    break;
                case 'text4' :
                    echo '<div class="description padding border-bottom">';
                    echo '<h4 class="post-title">'.$theNewPage['content'][$i]['h'].'</h4>';
                    echo $theNewPage['content'][$i]['text'];
                    echo '</div>';
                    break;
                case 'li1' :
                    echo '<div class="description padding padding-bottom-10 background-light border-bottom">';
                    echo '<h4>'.$theNewPage['content'][$i]['h'].'</h4>';
                    echo '<div class="row"><div class="col-sm-12">';
                    echo $theNewPage['content'][$i]['text'];
                    echo '</div></div></div>';
                    break;
                case 'li2' :
                    echo '<div class="description padding padding-bottom-10 background-light border-bottom">';
                    echo '<h4>'.$theNewPage['content'][$i]['h'].'</h4>';
                    echo '<div class="row"><div class="col-sm-6">';
                    $findUL = '</ul><ul>';
                    $instertNewUL = '</ul></div><div class="col-sm-6"><ul>';
                    $placeUL = strpos($theNewPage['content'][$i]['text'], $findUL);
                    echo substr_replace($theNewPage['content'][$i]['text'], $instertNewUL, $placeUL, 0);
                    echo '</div></div></div>';
                    break;
                case 'gallery' :
                    echo '<div class="description padding border-bottom"><h4>Фото / Видео</h4>';
                    echo '<div class="overflow-hidden"><div class="owl-carousel photo-slider">';
                    $countMediaBlocks = count($theNewPage['content'][$i]['media']);
                    for ( $j=0; $j<$countMediaBlocks; $j++ ) {
                        switch ($theNewPage['content'][$i]['media'][$j]['type']) {
                            case 'photo' :
                                echo '<div class="item"><div class="inner">';
                                echo '<img src="'.$theNewPage['content'][$i]['media'][$j]['src'].'" alt=""/>';
                                echo '<a rel="photo" class="swipebox icon-photo" title="'.$theNewPage['content'][$i]['media'][$j]['title'].'" href="'.$theNewPage['content'][$i]['media'][$j]['src'].'"></a>';
                                echo '<div class="slide-description">'.$theNewPage['content'][$i]['media'][$j]['text'].'</div>';
                                echo '</div></div>';
                                break;
                            case 'video' :
                                echo '<div class="item"><div class="inner">';
                                echo '<img src="'.$theNewPage['content'][$i]['media'][$j]['imgSrc'].'" alt=""/>';
                                echo '<a rel="video" class="swipebox icon-play" title="'.$theNewPage['content'][$i]['media'][$j]['title'].'" href="'.$theNewPage['content'][$i]['media'][$j]['src'].'"></a>';
                                echo '<div class="slide-description">'.$theNewPage['content'][$i]['media'][$j]['text'].'</div>';
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
    <!-- Social Widgets -->
<?php include('includes/socialSubscribe.php'); ?>
    <!-- Subscribe Form -->
<?php include('includes/subscribeForm.php'); ?>


<?php include('includes/footer.php'); ?>