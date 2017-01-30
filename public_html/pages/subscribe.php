<?php include('includes/header.php'); ?>
<?php include('getData/connectDB.php'); ?>


    <!-- Subscribe Cards -->
    <section class="padding border-bottom">
        <div class="overflow-hidden">
            <div class="owl-carousel subscribe-cards-slider">
        <?php

        $filter     = array('type' => 'simple');
        $cursor = $collectionShop->find($filter);
        foreach ($cursor as $document) {
            $thePageText['content'] = $document['content'];

            echo '
                <div class="item">
                    <div class="subscribe-card padding" style="background-image: url(images/subscribeImage/'.$document['img'].');">
                        <div class="inner">
                            <h4 class="title">'.$document['h'].'</h4>
                            <div class="description">'.$document['text'].'</div>


                            <ul class="statistics">
                                '.$document['ul'].'
                            </ul>

                            <a href="#" class="btn btn-yellow btn-wide" id="'.$document['id'].'">ПОЛУЧИТЬ ПРОГНОЗ</a>
                        </div>
                    </div>
                </div>';
        }
        ?>
            </div>
        </div>
    </section>
    <!--/ Subscribe Cards -->

    <!-- Text Block -->
    <article class="news-item news-details">
        <?php

        $filter     = array('page' => 'subscribe');
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

    <!-- Subscribe Cards Style 2 -->
    <section class="padding border-bottom">
        <?php

        $filter     = array('type' => 'marathone');
        $cursor = $collectionShop->find($filter);
        foreach ($cursor as $document) {

            echo '<div class="subscribe-card style2 padding" style="background-image: url(images/subscribeImage/'.$document['img'].');">
            <div class="inner">
                <div class="row">
                    <div class="col-sm-9">
                        <h4 class="title">'.$document['h'].'</h4>
                        <div class="description">
                            '.$document['text'].'
                        </div>
                    </div>

                    <div class="col-sm-2 col-sm-offset-1">
                        <ul class="statistics">
                            '.$document['ul'].'
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                        <a href="#" class="btn btn-yellow btn-wide" id="'.$document['id'].'">ПОЛУЧИТЬ ПРОГНОЗ</a>
                    </div>
                </div>
            </div>
        </div>';
        }
        ?>
    </section>
    <!--/ Subscribe Cards Style 2 -->

    <div class="popup slim" id="buyPreditction1key">
        <a href="#" class="popup-close"><i class="icon-close"></i></a>

        <div class="popup-inner">

            <form action="">
                <h4 class="title text-center">Ваша почта:</h4>
                <input type=email class=form-control id=emailBuyer1 name=Shp_email placeholder=E-mail value='' required=required>
            </form>

            <form action='https://merchant.roboxchange.com/Index.aspx' method=POST id="buyPredictionForm1">
                <h3 class="title text-center">Покупка 1 KEY: 990 руб.</h3>
                <?php
                function getIdTran($collectionShop) {
                    $x = 0;
                    do {
                        $tran = rand(0,100000000);
                        $filter     = array('inv_id' => $tran);
                        $collector  = $collectionShop->find($filter);
                        if ($collector->count() != 1) {
                            $x = 1;
                        }
                    } while($x != 1);
                    return $tran;
                }


                $mrh_login  = "betkeyru";
                $mrh_pass1  = "ULg5tgSymaPyZR0G100A";
                $inv_id     = getIdTran($collectionShop);
                $inv_desc   = "Покупка 1 реального прогноза";
                $Shp_key    = "1key";
                $Shp_ip     = $_SERVER["REMOTE_ADDR"];
                $out_summ   = "925.23";
                $crc        = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_ip=$Shp_ip:Shp_key=$Shp_key");

                print "<input type=hidden name=MerchantLogin value=$mrh_login>".
                    "<input type=hidden name=OutSum value=$out_summ>".
                    "<input type=hidden name=InvoiceID value=$inv_id>".
                    "<input type=hidden name=Description value='$inv_desc'>".
                    "<input type=hidden name=SignatureValue value=$crc>".
                    "<input type=hidden name=Shp_ip value='$Shp_ip'>".
                    "<input type=hidden name=Shp_key value='$Shp_key'>".
                    "<input id='buybutton1' type=submit value='Pay' class='btn btn-yellow btn-wide'>";

                ?>
            </form>
        </div>
    </div>

    <div class="popup slim" id="buyPreditction3key">
        <a href="#" class="popup-close"><i class="icon-close"></i></a>

        <div class="popup-inner">
            <form action="">
                <h4 class="title text-center">Ваша почта:</h4>

                <input type=email class=form-control id=emailBuyer3 name=Shp_email placeholder=E-mail value='' required=required>
            </form>
            <form action='https://auth.robokassa.ru/Merchant/Index.aspx' method=POST id="buyPredictionForm3">
                <h3 class="title text-center">Покупка 3 KEY: 2,350 руб.</h3>
                <?php
                $mrh_login  = "betkeyru";
                $mrh_pass1  = "ULg5tgSymaPyZR0G100A";
                $inv_id     = getIdTran($collectionShop);
                $inv_desc   = "Покупка 3 реальных прогнозов!";
                $Shp_key    = "3key";
                $Shp_ip     = $_SERVER["REMOTE_ADDR"];
                $out_summ   = "2196.26";
                $crc        = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_ip=$Shp_ip:Shp_key=$Shp_key");

                print "<input type=hidden name=MerchantLogin value=$mrh_login>".
                    "<input type=hidden name=OutSum value=$out_summ>".
                    "<input type=hidden name=InvoiceID value=$inv_id>".
                    "<input type=hidden name=Description value='$inv_desc'>".
                    "<input type=hidden name=SignatureValue value=$crc>".
                    "<input type=hidden name=Shp_ip value='$Shp_ip'>".
                    "<input type=hidden name=Shp_key value='$Shp_key'>".
                    "<input id='buybutton3' type=submit value='Pay' class='btn btn-yellow btn-wide'>";

                ?>
            </form>
        </div>
    </div>

    <div class="popup slim" id="buyPreditction5key">
        <a href="#" class="popup-close"><i class="icon-close"></i></a>

        <div class="popup-inner">
            <form action="">
                <h4 class="title text-center">Ваша почта:</h4>

                <input type=email class=form-control id=emailBuyer5 name=Shp_email placeholder=E-mail value='' required=required>
            </form>
            <form action='https://auth.robokassa.ru/Merchant/Index.aspx' method=POST id="buyPredictionForm5">
                <h3 class="title text-center">Покупка 5 KEY: 3,900 руб.</h3>
                <?php
                $mrh_login  = "betkeyru";
                $mrh_pass1  = "ULg5tgSymaPyZR0G100A";
                $inv_id     = getIdTran($collectionShop);
                $inv_desc   = "Покупка 7 реальных прогнозов!";
                $Shp_key    = "5key";
                $Shp_ip     = $_SERVER["REMOTE_ADDR"];
                $out_summ   = "3644.86";
                $crc        = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_ip=$Shp_ip:Shp_key=$Shp_key");

                print "<input type=hidden name=MerchantLogin value=$mrh_login>".
                    "<input type=hidden name=OutSum value=$out_summ>".
                    "<input type=hidden name=InvoiceID value=$inv_id>".
                    "<input type=hidden name=Description value='$inv_desc'>".
                    "<input type=hidden name=SignatureValue value=$crc>".
                    "<input type=hidden name=Shp_ip value='$Shp_ip'>".
                    "<input type=hidden name=Shp_key value='$Shp_key'>".
                    "<input id='buybutton5' type=submit value='Pay' class='btn btn-yellow btn-wide'>";

                ?>
            </form>
        </div>
    </div>

    <div class="popup slim" id="buyPreditction7key">
        <a href="#" class="popup-close"><i class="icon-close"></i></a>

        <div class="popup-inner">
            <form action="">
                <h4 class="title text-center">Ваша почта:</h4>

                <input type=email class=form-control id=emailBuyer7 name=Shp_email placeholder=E-mail value='' required=required>
            </form>
            <form action='https://auth.robokassa.ru/Merchant/Index.aspx' method=POST id="buyPredictionForm7">
                <h3 class="title text-center">Покупка 7 KEY: 4,900 руб.</h3>
                <?php
                $mrh_login  = "betkeyru";
                $mrh_pass1  = "ULg5tgSymaPyZR0G100A";
                $inv_id     = getIdTran($collectionShop);
                $inv_desc   = "Покупка 7 реальных прогнозов!";
                $Shp_key    = "7key";
                $Shp_ip     = $_SERVER["REMOTE_ADDR"];
                $out_summ   = "4579.44";
                $crc        = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_ip=$Shp_ip:Shp_key=$Shp_key");

                print "<input type=hidden name=MerchantLogin value=$mrh_login>".
                    "<input type=hidden name=OutSum value=$out_summ>".
                    "<input type=hidden name=InvoiceID value=$inv_id>".
                    "<input type=hidden name=Description value='$inv_desc'>".
                    "<input type=hidden name=SignatureValue value=$crc>".
                    "<input type=hidden name=Shp_ip value='$Shp_ip'>".
                    "<input type=hidden name=Shp_key value='$Shp_key'>".
                    "<input id='buybutton7' type=submit value='Pay' class='btn btn-yellow btn-wide'>";

                ?>
            </form>
        </div>
    </div>

    <div class="popup slim" id="buyPreditction14key">
        <a href="#" class="popup-close"><i class="icon-close"></i></a>

        <div class="popup-inner">
            <form action="">
                <h4 class="title text-center">Ваша почта:</h4>

                <input type=email class=form-control id=emailBuyer14 name=Shp_email placeholder=E-mail value='' required=required>
            </form>
            <form action='https://auth.robokassa.ru/Merchant/Index.aspx' method=POST id="buyPredictionForm14">
                <h3 class="title text-center">Покупка 14 KEY: 6,900 руб.</h3>
                <?php
                $mrh_login  = "betkeyru";
                $mrh_pass1  = "ULg5tgSymaPyZR0G100A";
                $inv_id     = getIdTran($collectionShop);
                $inv_desc   = "Покупка 14 реальных прогнозов!";
                $Shp_key    = "14key";
                $Shp_ip     = $_SERVER["REMOTE_ADDR"];
                $out_summ   = "6448.60";
                $crc        = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_ip=$Shp_ip:Shp_key=$Shp_key");

                print "<input type=hidden name=MerchantLogin value=$mrh_login>".
                    "<input type=hidden name=OutSum value=$out_summ>".
                    "<input type=hidden name=InvoiceID value=$inv_id>".
                    "<input type=hidden name=Description value='$inv_desc'>".
                    "<input type=hidden name=SignatureValue value=$crc>".
                    "<input type=hidden name=Shp_ip value='$Shp_ip'>".
                    "<input type=hidden name=Shp_key value='$Shp_key'>".
                    "<input id='buybutton14' type=submit value='Pay' class='btn btn-yellow btn-wide'>";

                ?>
            </form>
        </div>
    </div>

<script type="text/javascript">
$(document).ready(function () {

    $('#1key').on('click', function () {
        console.log('1key');
        $('#buyPreditction1key').addClass('active');
    })
    $('#3key').on('click', function () {
        console.log('3key');
        $('#buyPreditction3key').addClass('active');

    })
    $('#5key').on('click', function () {
        console.log('5key');
        $('#buyPreditction5key').addClass('active');

    })
    $('#7key').on('click', function () {
        console.log('7key');
        $('#buyPreditction7key').addClass('active');

    })
    $('#14key').on('click', function () {
        console.log('14key');
        $('#buyPreditction14key').addClass('active');

    })
    $('#buybutton1').on('click', function () {
            console.log('goData');
            var Shp_email = $('#emailBuyer1').val();
            console.log(Shp_email);
            jQuery.ajax({
                url:     "/sendData/buy.php", //url страницы (action_ajax_form.php)
                type:     "POST", //метод отправки
                dataType: "html", //формат данных
                data: jQuery("#buyPredictionForm1").serialize()+"&Shp_email="+Shp_email,  // Сеарилизуем объект
                success: function(response) { //Данные отправлены успешно
//                    console.log(response);
                },
                error: function(response) { // Данные не отправлены
                    console.log('failed');
                }
            });

        }
    )
    $('#buybutton3').on('click', function () {
            console.log('goData');
            var Shp_email = $('#emailBuyer3').val();
            console.log(Shp_email);
            jQuery.ajax({
                url:     "/sendData/buy.php", //url страницы (action_ajax_form.php)
                type:     "POST", //метод отправки
                dataType: "html", //формат данных
                data: jQuery("#buyPredictionForm3").serialize()+"&Shp_email="+Shp_email,  // Сеарилизуем объект
                success: function(response) { //Данные отправлены успешно
//                    console.log(response);
                },
                error: function(response) { // Данные не отправлены
                    console.log('failed');
                }
            });

        }
    )
    $('#buybutton5').on('click', function () {
            console.log('goData');
            var Shp_email = $('#emailBuyer5').val();
            console.log(Shp_email);
            jQuery.ajax({
                url:     "/sendData/buy.php", //url страницы (action_ajax_form.php)
                type:     "POST", //метод отправки
                dataType: "html", //формат данных
                data: jQuery("#buyPredictionForm5").serialize()+"&Shp_email="+Shp_email,  // Сеарилизуем объект
                success: function(response) { //Данные отправлены успешно
//                    console.log(response);
                },
                error: function(response) { // Данные не отправлены
                    console.log('failed');
                }
            });

        }
    )
    $('#buybutton7').on('click', function () {
            console.log('goData');
            var Shp_email = $('#emailBuyer7').val();
            console.log(Shp_email);
            jQuery.ajax({
                url:     "/sendData/buy.php", //url страницы (action_ajax_form.php)
                type:     "POST", //метод отправки
                dataType: "html", //формат данных
                data: jQuery("#buyPredictionForm7").serialize()+"&Shp_email="+Shp_email,  // Сеарилизуем объект
                success: function(response) { //Данные отправлены успешно
//                    console.log(response);
                },
                error: function(response) { // Данные не отправлены
                    console.log('failed');
                }
            });

        }
    )
    $('#buybutton14').on('click', function () {
            console.log('goData');
            var Shp_email = $('#emailBuyer14').val();
            console.log(Shp_email);
            jQuery.ajax({
                url:     "/sendData/buy.php", //url страницы (action_ajax_form.php)
                type:     "POST", //метод отправки
                dataType: "html", //формат данных
                data: jQuery("#buyPredictionForm14").serialize()+"&Shp_email="+Shp_email,  // Сеарилизуем объект
                success: function(response) { //Данные отправлены успешно
//                    console.log(response);
                },
                error: function(response) { // Данные не отправлены
                    console.log('failed');
                }
            });

        }
    )
});

</script>

    <!-- Results Chart -->
<?php include('includes/preChart.php'); ?>
    <!--/ Results Chart -->

    <!-- Social Widgets -->
<?php include('includes/socialSubscribe.php'); ?>
    <!--/ Social Widgets -->

    <!-- Subscribe Form -->
<?php include('includes/subscribeForm.php'); ?>

    <!--/ Subscribe Form -->

<?php include('includes/footer.php'); ?>