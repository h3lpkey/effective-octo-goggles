<?php include('includes/header.php'); ?>
<?php include('getData/connectDB.php'); ?>

    <!-- Posts -->
    <section class="section-news">
        <h2 class="section-title text-left">НОВОСТИ</h2>
        <?php
        $list = $collectionNews->find();
        while($document = $list->getNext()) {

            echo '<article class="news-item style2 padding border-bottom">
            <div class="post-content">
                <div class="post-media">
                    <a href="news-item/'.$document['link'].'"><img src="/images/newsPreview/'.$document['imgPreview'].'" alt=""></a>
                </div>

                <h4 class="post-title"><a href="news-item/'.$document['link'].'">'.$document['title'].'</a></h4>

                <div class="post-description">
                    '.$document['textPreview'].'
                </div>

                <div class="row">
                    <div class="col-xs-7">
                        <div class="post-date">Опубликовано: '.$document['date'].'</div>
                    </div>

                    <div class="col-xs-5 text-right">
                        <a class="link-go" href="news-item/'.$document['link'].'">ПОДРОБНЕЕ</a>
                    </div>
                </div>
            </div>
        </article>';

        }
        ?>

    </section>
    <!--/ Posts -->

<!-- Social Widgets -->
<?php include('includes/socialSubscribe.php'); ?>
<!-- Subscribe Form -->
<?php include('includes/subscribeForm.php'); ?>

<?php include('includes/footer.php'); ?>