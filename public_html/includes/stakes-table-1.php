<!-- Stakes Table -->
<div class="overflow-hidden">
    <table class="table table-striped table-hover border-bottom margin-bottom-0">
        <thead>
        <tr>
            <td class="fsz18" colspan="2">Игры</td>
            <td>Время</td>
            <td>Команды</td>
            <td class="text-center">1</td>
            <td class="text-center">x</td>
            <td class="text-center">2</td>
            <td></td>
        </tr>
        </thead>
        <tbody id="game-index">
        <script type="text/javascript">
            $(document).ready(function () {
                var sportType = '';
                var viewGame = 15;
                RenderTableGameIndex(sportType, viewGame);
                setInterval(function () {
                    RenderTableGameIndex(sportType, viewGame);
                },5000);

                $("body").on('click', '#countViewGames', function(){
                    viewGame = viewGame + 5;
                    RenderTableGameIndex(sportType, viewGame);
                });

                function RenderTableGameIndex(sportType, viewGame, append = false) {
                    $.post('/getData/indexGame.php', {count:viewGame,type:sportType}, function(out){
                        if(append){
                            $("#game-index").append(out);
                        }else {
                            $("#game-index").html(out);
                        }
                    });
                }

                $("body").on('click', '.side-menu li', function(){
                    var type = $(this).find('a').attr('class');
                    sportType = type;
                    RenderTableGameIndex(sportType, viewGame);
                });
            });
        </script>
        </tbody>
    </table>
</div>
<!--/ Stakes Table -->