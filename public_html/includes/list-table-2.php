<?php include('connectDB.php'); ?>

<?php

$list = $collectionBk->find();
while($bk = $list->getNext()){
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
    $theBK['bonus']             = $bk['bonus'];

    ?>
<!-- Stakes Table -->
<div class="overflow-hidden">
    <table class="table table-striped table-hover border-bottom margin-bottom-0"><!--TODO: You can use either images or .png sprite for the country flags-->
        <tbody>
        <?php

        echo '<tr><td><ul><li class="margin-bottom-10 text-center">';
        echo '<div class="row"><div class="col-xs-6">';
        echo '<img class="inline-block" src="images/bkImage/'.$theBK['img'].'" alt=""/></div>';
        echo '<div class="col-xs-6"><span class="highlight-green"><span></div></div></li>';

        echo '<li class="margin-bottom-20 text-center">';
//        echo '<span class="flag flag-russia" title="Russia"></span>';
//        echo '<span class="flag flag-ukraine" title="Ukraine"></span>';
//        echo '<span class="flag flag-belarus" title="Belarus"></span>';
        echo '</li>';
        
        echo '<li class="text-center"><div class="row"><div class="col-xs-6">';
        echo '<a href="/office-review/'.$bk['nameEng'].'" class="btn btn-small btn-width-120">ОБЗОР</a></div>';
        echo '<div class="col-xs-6"><a href="'.$theBK['link'].'" class="btn btn-small btn-yellow btn-width-120">ПЕРЕЙТИ НА САЙТ</a></div>';
        echo '</div></li></ul></td></tr>';
        ?>

        <!--<img class="flag" src="images/flag-russia.jpg" title="Russia" alt=""/>
        <img class="flag" src="images/flag-ukraine.jpg" title="Ukraine" alt=""/>
        <img class="flag" src="images/flag-belarus.jpg" title="Belarus" alt=""/>-->
        </tbody>

    </table>
</div>
<!--/ Stakes Table -->
    
<?php
}
?>