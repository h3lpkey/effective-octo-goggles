<!-- Results Table -->
<div class="overflow-hidden">
    <table class="table table-striped table-hover border-bottom margin-bottom-0">
        <thead>
        <tr>
            <td class="fsz18" colspan="2">Игры</td>
            <td>Время</td>
            <td>Команды</td>
            <td>Результаты</td>
            <td></td>
        </tr>
        </thead>

        <tbody id="archive-index">
        <script type="text/javascript">
            $(document).ready(function () {
                var sportType = '';
                var viewGame = 15;
                RenderTableArchiveIndex(sportType, viewGame);
                setInterval(function () {
                    RenderTableArchiveIndex(sportType, viewGame);
                },5000);

                $("body").on('click', '#countViewArchive', function(){
                    viewGame = viewGame + 5;
                    RenderTableArchiveIndex(sportType, viewGame);
                });

                function RenderTableArchiveIndex(sportType, viewGame, append = false) {
                    $.post('/getData/indexArchive.php', {count:viewGame,type:sportType}, function(out){
                        if(append){
                            $("#archive-index").append(out);
                        }else {
                            $("#archive-index").html(out);
                        }
                    });
                }

                $("body").on('click', '.side-menu li', function(){
                    var type = $(this).find('a').attr('class');
                    sportType = type;
                    RenderTableArchiveIndex(sportType, viewGame);
                });
            });
        </script>
        </tbody>
    </table>
</div>
<!--/ Results Table -->