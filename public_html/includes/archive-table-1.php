<!-- Archive Table -->
<div class="overflow-hidden">
    <table class="table table-striped table-hover border-bottom margin-bottom-0">
        <thead>
        <tr>
            <td class="fsz18" colspan="2"></td>
            <td>Время</td>
            <td>Команды</td>
            <td class="text-center">Результат</td>
            <td class="text-center">Наш результат</td>
            <td class="text-center">Совпадение</td>
        </tr>
        </thead>

        <tbody id="archive-list">
        <script type="text/javascript">
            $(document).ready(function () {
                var sportType = '<?php echo $paramPage; ?>';
                var viewGame = 10;
                RenderTableArchiveList(sportType, viewGame);
                setInterval(function () {
                    RenderTableArchiveList(sportType, viewGame);
                },5000);

                $("body").on('click', '#countViewArchiveList', function(){
                    viewGame = viewGame + 5;
                    RenderTableArchiveList(sportType, viewGame);
                });

                function RenderTableArchiveList(sportType, viewGame, append = false) {
                    $.post('/getData/archiveList.php', {count:viewGame,type:sportType}, function(out){
                        if(append){
                            $("#archive-list").append(out);
                        }else {
                            $("#archive-list").html(out);
                        }
                    });
                }
            });
        </script>
        </tbody>
    </table>
</div>
<!--/ Archive Table -->