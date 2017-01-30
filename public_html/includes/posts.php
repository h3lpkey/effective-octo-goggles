<?php
$i = 1;
$list = $collectionNews->find();
$list -> limit(2);
while($document = $list->getNext()){
    $theNews[$i]['date'] = $document['date'];
    $theNews[$i]['link'] = $document['link'];
    $theNews[$i]['title'] = $document['title'];
    $theNews[$i]['imgPreview'] = $document['imgPreview'];
    $theNews[$i]['title'] = $document['title'];
    $theNews[$i]['textPreview'] = $document['textPreview'];
    $i++;
}
$list = $collectionArticles->find();
$list -> limit(1);
while($document = $list->getNext()){
    $theArticle['date'] = $document['date'];
    $theArticle['link'] = $document['link'];
    $theArticle['title'] = $document['title'];
    $theArticle['imgPreview'] = $document['imgPreview'];
    $theArticle['title'] = $document['title'];
    $theArticle['textPreview'] = $document['textPreview'];
    $i++;
}

?>
        <!-- Posts -->
        <section class="section-posts border-bottom clearfix">
            <div class="column-left">
                <h2 class="section-title">НОВОСТИ</h2>

                <!-- News -->
                <div class="news-list padding">
                    <article class="news-item">
                        <div class="post-date">Опубликовано: <?php echo $theNews[1]['date']; ?></div>

                        <div class="post-content">
                            <?php echo $theNews[1]['title']; ?>
                        </div>

                        <div class="text-right">
                            <a class="link-go" href="/news-item/<?php echo $theNews[1]['link']; ?>">ПОДРОБНЕЕ</a>
                        </div>
                    </article>

                    <article class="news-item">
                        <div class="post-date">Опубликовано: <?php echo $theNews[2]['date']; ?></div>

                        <div class="post-content">
                            <?php echo $theNews[2]['title']; ?>
                        </div>

                        <div class="text-right">
                            <a class="link-go" href="/news-item/<?php echo $theNews[2]['link']; ?>">ПОДРОБНЕЕ</a>
                        </div>
                    </article>

                    <div class="text-center">
                        <a class="link-go yellow" href="/news">ВСЕ НОВОСТИ</a>
                    </div>
                </div>
                <!--/ News -->
            </div>

            <div class="column-right">
                <h2 class="section-title">СТАТЬИ</h2>

                <!-- Article -->
                <article class="article featured padding">
                    <div class="post-media pull-left">
                        <img src="/images/articlePreview/<?php echo $theArticle['imgPreview']; ?>" alt=""/>
                    </div>

                    <h4 class="post-title"><?php echo $theArticle['title']; ?></h4>

                    <div class="post-content">
                        <p>
                        <?php echo $theArticle['textPreview']; ?>
                        </p>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="post-date">Опубликовано: <?php echo $theArticle['date']; ?></div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-xs-6">
                                    <a class="link-go yellow" href="/articles">АРХИВ СТАТЕЙ</a>
                                </div>

                                <div class="col-xs-6 text-right">
                                    <a class="link-go" href="/articles-item/<?php echo $theArticle['link']; ?>">ПОДРОБНЕЕ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <!--/ Article -->
            </div>
        </section>
        <!--/ Posts -->