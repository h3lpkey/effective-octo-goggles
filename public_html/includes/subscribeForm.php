<form class="form-subscribe padding border-bottom" method="post" id="subscribe-form" action="#">
    <div class="row">
        <div class="col-sm-2 col-md-3">
            <label for="subscribe-email">Получите 10 бесплатных прогнозов</label>
        </div>

        <div class="col-sm-6">
            <input type="email" id="subscribe-email" class="form-control" name="subscribe-email" placeholder="E-mail"/>
        </div>

        <div class="col-sm-4 col-md-3">
            <input type="button" id="subscribe-button" class="btn btn-red btn-wide" value="ПОЛУЧИТЬ ПРОГНОЗ"/>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function () {
        $('#subscribe-button').click(
            function () {
                console.log('goData');
                jQuery.ajax({
                    url:     "/sendData/sendFreePrediction.php", //url страницы (action_ajax_form.php)
                    type:     "POST", //метод отправки
                    dataType: "html", //формат данных
                    data: jQuery("#subscribe-email").serialize(),  // Сеарилизуем объект
                    success: function(response) { //Данные отправлены успешно
                        $( "#subscribe-button" ).removeClass( "btn-red" );
                        $( "#subscribe-button" ).val( "Готово!" );
                    },
                    error: function(response) { // Данные не отправлены
                        console.log('failed');

                        document.getElementById(subscribe-email).innerHTML = "Ошибка. Данные не отправленны.";
                    }
                });

            }
        )
    });
</script>