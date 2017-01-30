<!-- Left SideBar -->
<div class="sidebar-left">
    <a href="#" class="sidebar-left-toggle"><i class="icon-menu"></i>Меню</a>

    <header class="row-top">
        <!-- Logo -->
        <div class="logo"><a href="/"><img src="/images/logo.png" alt=""/></a></div>
        <!--/ Logo -->
    </header>

    <div class="row-middle">
        <div class="box">
            <!-- SideBar Menu -->
            <ul class="side-menu nicescroll">
                <?php
                if ($paramSite != 'archive-list') {
                    echo '
                <li><a href="#" class="football"><i class="icon-football"></i>Футбол</a></li>
                <li><a href="#" class="tennis"><i class="icon-tennis"></i>Теннис</a></li>
                <li><a href="#" class="basketball"><i class="icon-basketball"></i>Баскетбол</a></li>
                <li ><a href="#" class="racing"><i class="icon-racing"></i>Автоспорт</a></li>
                <li ><a href="#" class="badminton"><i class="icon-badminton"></i>Бадминтон</a></li>
                <li ><a href="#" class="baseball"><i class="icon-baseball"></i>Бейсбол</a></li>
                <li ><a href="#" class="volley"><i class="icon-volley"></i>Волейбол</a></li>
                <li ><a href="#" class="cycling"><i class="icon-cycling"></i>Велоспорт</a></li>
                <li ><a href="#" class="handball"><i class="icon-handball"></i>Гандбол</a></li>
                <li ><a href="#" class="cricket"><i class="icon-cricket"></i>Крикет</a></li>
                <li ><a href="#" class="rugby"><i class="icon-rugby"></i>Регби</a></li>
                <li ><a href="#" class="snooker"><i class="icon-snooker"></i>Снукер</a></li>
                <li ><a href="#" class="chess"><i class="icon-chess"></i>Скачки</a></li>
                <li ><a href="#" class="hokkey"><i class="icon-hokkey"></i>Хоккей</a></li>';
                } else {
                    echo '
                <li><a href="/archive-list/football" class="football"><i class="icon-football"></i>Футбол</a></li>
                <li><a href="/archive-list/tennis" class="tennis"><i class="icon-tennis"></i>Теннис</a></li>
                <li><a href="/archive-list/basketball" class="basketball"><i class="icon-basketball"></i>Баскетбол</a></li>
                <li ><a href="/archive-list/racing" class="racing"><i class="icon-racing"></i>Автоспорт</a></li>
                <li ><a href="/archive-list/badminton" class="badminton"><i class="icon-badminton"></i>Бадминтон</a></li>
                <li ><a href="/archive-list/baseball" class="baseball"><i class="icon-baseball"></i>Бейсбол</a></li>
                <li ><a href="/archive-list/volley" class="volley"><i class="icon-volley"></i>Волейбол</a></li>
                <li ><a href="/archive-list/cycling" class="cycling"><i class="icon-cycling"></i>Велоспорт</a></li>
                <li ><a href="/archive-list/handball" class="handball"><i class="icon-handball"></i>Гандбол</a></li>
                <li ><a href="/archive-list/cricket" class="cricket"><i class="icon-cricket"></i>Крикет</a></li>
                <li ><a href="/archive-list/rugby" class="rugby"><i class="icon-rugby"></i>Регби</a></li>
                <li ><a href="/archive-list/snooker" class="snooker"><i class="icon-snooker"></i>Снукер</a></li>
                <li ><a href="/archive-list/chess" class="chess"><i class="icon-chess"></i>Скачки</a></li>
                <li ><a href="/archive-list/hokkey" class="hokkey"><i class="icon-hokkey"></i>Хоккей</a></li>';
                }
                ?>

            </ul>
            <!--/ SideBar Menu -->
        </div>
    </div>

    <div class="row-bottom">
        <div class="box box-black">
            <!-- Social Buttons -->
            <ul class="social-links">
                <li><a href="https://vk.com/betkey.official" class="icon-vk2"></a></li>
                <li><a href="https://www.facebook.com/BetKey-1064301880332753/ " class="icon-fb"></a></li>
                <li><a href="https://twitter.com/bet_betkey" class="icon-tw"></a></li>
                <li><a href="#" class="icon-ok"></a></li>
                <li><a href="#" class="icon-google"></a></li>
            </ul>
            <!--/ Social Buttons -->

            <a href="#" class="btn btn-yellow btn-wide" data-popup="open" data-popup-target="#contactUs">НАПИСАТЬ НАМ</a>
        </div>

        <div class="box">
            <!-- Contacts -->
            <ul class="contact-links">
                <li><a href="#"><i class="icon-phone"></i>+7 919 371 50 75</a></li>
                <li><a href="#"><i class="icon-skype"></i>betkeypoint.com</a></li>
                <li><a href="#"><i class="icon-envelope"></i>betkey@mail.ru</a></li>
                <li><a href="#"><i class="icon-phone2"></i>+7 919 371 50 75</a></li>
            </ul>
            <!--/ Contacts -->
        </div>

        <footer class="box box-black">
            <div class="copyright">&copy; 2015-2016 BetKey <br/>Все права защищены</div>
        </footer>
    </div>
</div>
<!--/ Left SideBar -->

<!-- Floating Menu -->
<nav class="floating-menu">
    <ul>
        <li class="active"><a href="#" data-popup="open" data-popup-target="#feedBack"><i class="icon-pencil"></i><span>обратная связь</span></a></li>
        <li><a href="/archive-list"><i class="icon-books"></i><span>архив</span></a></li>
        <li><a href="/articles-item/aboutUs"><i class="icon-home"></i><span>о нас</span></a></li>
        <li><a href="/subscribe"><i class="icon-star2"></i><span>прогнозы</span></a></li>
        <li><a href="/list"><i class="icon-chart"></i><span>рейтинг бк</span></a></li>
        <li><a href="/articles"><i class="icon-list"></i><span>статьи</span></a></li>
        <li><a href="/news"><i class="icon-list2"></i><span>новости</span></a></li>
        <li><a href="/articles-item/faq"><i class="icon-question"></i><span>FAQ</span></a></li>
        <li><a href="/articles-item/cooperation"><i class="icon-wallet"></i><span>сотрудничество</span></a></li>
    </ul>

    <a class="to-top anchor" href="#page"><i class="icon-arrow-up2"></i>ВВЕРХ</a>
</nav>
<!--/ Floating Menu -->

<!-- ContactUs -->
<div class="popup slim" id="contactUs">
    <a href="#" class="popup-close"><i class="icon-close"></i></a>

    <div class="popup-inner">
        <form class="contact-form" action="#" method="post" id="contactUs-form">
            <h3 class="title text-center">НАПИСАТЬ НАМ</h3>

            <input type="text" class="form-control" id="cu-name" placeholder="Имя" required="required"/>
            <input type="email" class="form-control" id="cu-email" placeholder="E-mail" required="required"/>
            <textarea class="form-control" id="cu-message" placeholder="Сообщение" required="required"></textarea>

            <input type="button" id="contactUs-button" class="btn btn-yellow btn-wide" value="ОТПРАВИТЬ"/>
        </form>
    </div>
</div>
<!--/ ContactUs -->

<!-- FeedBack -->
<div class="popup slim" id="feedBack">
    <a href="#" class="popup-close"><i class="icon-close"></i></a>

    <div class="popup-inner">
        <form class="feedback-form" action="#" method="post" id="feedback-form-bt">
            <h3 class="title text-center">ОБРАТНАЯ СВЯЗЬ</h3>

            <input type="text" class="form-control" id="fb-name" placeholder="Имя" required="required"/>
            <input type="email" class="form-control" id="fb-email" placeholder="E-mail" required="required"/>
            <textarea class="form-control" id="fb-message" placeholder="Сообщение" required="required"></textarea>

            <input type="button" id="feedback-button" class="btn btn-yellow btn-wide fb-button" value="ОТПРАВИТЬ"/>
        </form>
    </div>
</div>
<!--/ FeedBack -->

<script type="text/javascript">
    $(document).ready(function () {
        $('#contactUs-button').click(
            function () {
                var name = $('#cu-name').val();
                var email = $('#cu-email').val();
                var msg = $('#cu-message').val();
                var data = {name:name, email:email, msg:msg};
                jQuery.ajax({
                    url:     "/sendData/sendFeedBack.php", //url страницы (action_ajax_form.php)
                    type:     "POST", //метод отправки
                    dataType: "html", //формат данных
                    data: data,  // Сеарилизуем объект
                    success: function(response) { //Данные отправлены успешно
                        $( "#contactUs-button" ).removeClass( "btn-yellow" );
                        $( "#contactUs-button" ).val( "Получили!" );

                    },
                    error: function(response) { // Данные не отправлены

                    }
                });

            }
        )
        $('#feedback-button').click(
            function () {
                var name = $('#fb-name').val();
                var email = $('#fb-email').val();
                var msg = $('#fb-message').val();
                var data = {name:name, email:email, msg:msg};
                jQuery.ajax({
                    url:     "/sendData/sendFeedBack.php", //url страницы (action_ajax_form.php)
                    type:     "POST", //метод отправки
                    dataType: "html", //формат данных
                    data: data,  // Сеарилизуем объект
                    success: function(response) { //Данные отправлены успешно
                        $( "#feedback-button" ).removeClass( "btn-yellow" );
                        $( "#feedback-button" ).val( "Приняли!" );
                    },
                    error: function(response) { // Данные не отправлены

                    }
                });

            }
        )
    });
</script>