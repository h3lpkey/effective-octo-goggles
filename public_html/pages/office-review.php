<?php include('includes/header.php'); ?>
<?php include('getData/connectDB.php'); ?>
<?php

$filter     = array('nameEng' => $paramPage);
$cursor     = $collectionBk ->find($filter);
foreach ($cursor as $bk) {
    $theBK['nameRus']           = $bk['nameRus'];
    $theBK['nameEng']           = $bk['nameEng'];
    $theBK['link']              = $bk['link'];
    $theBK['reliability']       = $bk['reliability'];
    $theBK['lineMatch']         = $bk['lineMatch'];
    $theBK['lineLive']          = $bk['lineLive'];
    $theBK['coefficients']      = $bk['coefficients'];
    $theBK['convenienceFees']   = $bk['convenienceFees'];
    $theBK['support']           = $bk['support'];
    $theBK['rate']              = $bk['rate'];
    $theBK['img']               = $bk['img'];
    $theBK['about']             = $bk['about'];
}

?>
    <!-- Office Review -->
    <section class="section-office-review border-bottom" style="background-image: url(/images/bkImage/fan-football-stadium-sports.jpg);">
        <div class="column-left padding">
            <h1 class="title">Обзор букмекерской конторы <?php echo $theBK['nameRus']; ?></h1>

            <div class="office-rating">
                <span class="rating-label">Оценка</span>
                <div class="rating-stars">
                    <?php
                    for ($i=0; $i<5; $i++) {
                        if ($i < $theBK['rate']) {
                            echo '<i class="icon-star"></i>';
                        } else {
                            echo '<i class="icon-star2"></i>';
                        }
                    }
                    ?>
                </div>
                <span class="rating-label"><?php echo $theBK['rate']; ?>/5</span>
            </div>

            <div class="description">Букмекеры с оценкой 3 предоставляют услуги среднего качества или проходят испытательный период.</div>

            <a class="btn btn-yellow" href="<?php echo $theBK['link']; ?>">ПЕРЕЙТИ НА САЙТ</a>
        </div>

        <div class="column-right padding">
            <h4 class="title">Преимущества</h4>

            <!-- Advantages -->
            <div class="skill" data-percentage="<?php echo $theBK['reliability']*10; ?>">
                <div class="skill-info">
                    <span class="skill-title">Надежность</span>
                    <span class="skill-percentage"><?php echo $theBK['reliability']; ?>/10</span>
                </div>
                <div class="progress">
                    <div class="progress-bar"></div>
                </div>
            </div>

            <div class="skill" data-percentage="<?php echo $theBK['lineMatch']*10; ?>">
                <div class="skill-info">
                    <span class="skill-title">Линия в прематче</span>
                    <span class="skill-percentage"><?php echo $theBK['lineMatch']; ?>/10</span>
                </div>
                <div class="progress">
                    <div class="progress-bar"></div>
                </div>
            </div>

            <div class="skill" data-percentage="<?php echo $theBK['lineLive']*10; ?>">
                <div class="skill-info">
                    <span class="skill-title">Линия в лайве</span>
                    <span class="skill-percentage"><?php echo $theBK['lineLive']; ?>/10</span>
                </div>
                <div class="progress">
                    <div class="progress-bar"></div>
                </div>
            </div>

            <div class="skill" data-percentage="<?php echo $theBK['coefficients']*10; ?>">
                <div class="skill-info">
                    <span class="skill-title">Коэффициенты</span>
                    <span class="skill-percentage"><?php echo $theBK['coefficients']; ?>/10</span>
                </div>
                <div class="progress">
                    <div class="progress-bar"></div>
                </div>
            </div>

            <div class="skill" data-percentage="<?php echo $theBK['convenienceFees']*10; ?>">
                <div class="skill-info">
                    <span class="skill-title">Удобство платежей</span>
                    <span class="skill-percentage"><?php echo $theBK['convenienceFees']; ?>/10</span>
                </div>
                <div class="progress">
                    <div class="progress-bar"></div>
                </div>
            </div>

            <div class="skill" data-percentage="<?php echo $theBK['support']*10; ?>">
                <div class="skill-info">
                    <span class="skill-title">Служба поддержки</span>
                    <span class="skill-percentage"><?php echo $theBK['support']; ?>/10</span>
                </div>
                <div class="progress">
                    <div class="progress-bar"></div>
                </div>
            </div>
            <!--/ Advantages -->
        </div>
    </section>
    <!--/ Office Review -->

    <!-- Text Block -->
    <section class="section-text padding border-bottom">
        <h5 class="h5 no-transform margin-bottom-30"><?php echo $theBK['nameRus']; ?></h5>
        <?php echo $theBK['about']; ?>

    </section>
    <!--/ Text Block -->

    <!-- Site Link -->
    <section class="section padding border-bottom">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <a href="<?php echo $theBK['link']; ?>" class="btn btn-yellow btn-wide">ПЕРЕЙТИ НА САЙТ</a>
            </div>
        </div>
    </section>
    <!--/ Site Link -->

    <!-- Social Widgets -->
<?php include('includes/socialSubscribe.php'); ?>
    <!-- Subscribe Form -->
<?php include('includes/subscribeForm.php'); ?>
    <!--/ Subscribe Form -->

<?php include('includes/footer.php'); ?>