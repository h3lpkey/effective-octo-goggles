<!-- Stakes Table -->
<div class="overflow-hidden">
    <table class="table table-striped table-hover border-bottom margin-bottom-0">
        <thead>
        <tr>
            <td class="fsz18">Игры</td>
        </tr>
        </thead>

        <tbody id="game-index-small">
        <script type="text/javascript">
            $(document).ready(function () {
                var sportType = '';
                var viewGame = 10;
                RenderTableGameIndexSmall(sportType, viewGame);
                setInterval(function () {
                    RenderTableGameIndexSmall(sportType, viewGame);
                },5000);

                $("body").on('click', '#countViewGames', function(){
                    viewGame = viewGame + 5;
                    RenderTableGameIndexSmall(sportType, viewGame);
                });

                function RenderTableGameIndexSmall(sportType, viewGame, append = false) {
                    $.post('/getData/indexGameSmall.php', {count:viewGame,type:sportType}, function(out){
                        if(append){
                            $("#game-index-small").append(out);
                        }else {
                            $("#game-index-small").html(out);
                        }
                    });
                }

                $("body").on('click', '.side-menu li', function(){
                    var type = $(this).find('a').attr('class');
                    sportType = type;
                    RenderTableGameIndexSmall(sportType, viewGame);
                });
            });
        </script>
        </tbody>
    </table>
</div>
<!--/ Stakes Table -->