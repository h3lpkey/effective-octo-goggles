<?php include('includes/connectDB.php'); ?>

<?php
$currentPage = $_POST['page'];
$list = $collectionNews->find();
$list -> limit(3);
while($document = $list->getNext()) {

    echo '<article class="news-item style2 padding border-bottom">
            <div class="post-content">
                <div class="post-media">
                    <a href="/news-item/'.$document['link'].'"><img src="'.$document['imgPreview'].'" alt=""></a>
                </div>

                <h4 class="post-title"><a href="/news-item/'.$document['link'].'">'.$document['title'].'</a></h4>

                <div class="post-description">
                    '.$document['textPreview'].'
                </div>

                <div class="row">
                    <div class="col-xs-7">
                        <div class="post-date">Опубликовано: '.$document['date'].'</div>
                    </div>

                    <div class="col-xs-5 text-right">
                        <a class="link-go" href="/news-item/'.$document['link'].'">ПОДРОБНЕЕ</a>
                    </div>
                </div>
            </div>
        </article>';
}

//echo '<div class="pagination-wrapper padding border-bottom">
//        <ul class="pagination">
//            <li><a class="prev page-numbers" href="#"></a></li>
//            <li><a class="page-numbers" href="#">1</a></li>
//            <li><span class="current">2</span></li>
//            <li><span>&hellip;</span></li>
//            <li><a class="page-numbers" href="#">34</a></li>
//            <li><a class="page-numbers" href="#">35</a></li>
//            <li><a class="next page-numbers" href="#"></a></li>
//        </ul>
//    </div>';
?>