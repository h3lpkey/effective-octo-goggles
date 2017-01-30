<?php include('includes/header.php'); ?>
<?php include('getData/connectDB.php'); ?>

    <!-- List -->
    <section class="section-stakes style2">


        <div class="tab-content">
            <div id="table1" class="tab-pane fade in active">
                <!-- Text Block -->
                <article class="news-item news-details">
                    <?php

                    $filter     = array('page' => 'list');
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

                <div class="hidden-xs">
                    <?php include('includes/list-table-1.php'); ?>
                </div>

                <div class="visible-xs">
                    <?php include('includes/list-table-2.php'); ?>
                </div>
            </div>
        </div>
    </section>
    <!--/ List -->

    <!-- Social Widgets -->
<?php include('includes/socialSubscribe.php'); ?>

<?php include('includes/subscribeForm.php'); ?>


<?php include('includes/footer.php'); ?>