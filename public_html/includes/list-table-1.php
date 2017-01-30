<?php include('connectDB.php'); ?>
<div class="overflow-hidden">
    <table class="table table-striped table-hover border-bottom margin-bottom-0"><!--TODO: You can use either images or .png sprite for the country flags-->
        <tbody>
        <!-- List Table -->

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

        <?php

        echo '<tr>';
        echo '<td><img  src="images/bkImage/'.$theBK['img'].'" alt=""/></td>';
        echo '<td><span class="highlight-green">'.$bk['nameRus'].'<span></td>';
        echo '<td><a href="/office-review/'.$bk['nameEng'].'" class="btn btn-small btn-width-120">ОБЗОР</a></td>';
        echo '<td><a href="'.$theBK['link'].'" class="btn btn-small btn-yellow btn-width-120 hidden-sm">ПЕРЕЙТИ НА САЙТ</a></td>';
        echo '</tr>';
        ?>


<?php
}
?>
<!--/ List Table -->

        </tbody>
    </table>
</div>
