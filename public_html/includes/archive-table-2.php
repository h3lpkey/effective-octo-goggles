<!-- Stakes Table -->
<div class="overflow-hidden">
    <table class="table table-striped table-hover border-bottom margin-bottom-0">
        <thead>
        <tr>
            <td class="fsz18">Игры</td>
        </tr>
        </thead>

        <tbody id="archive-list-small">
        <script type="text/javascript">
            $(document).ready(function () {
                var sportType = '<?php echo $paramPage; ?>';
                var viewGame = 5;
                RenderTableArchiveListSmall(sportType, viewGame);
                setInterval(function () {
                    RenderTableArchiveListSmall(sportType, viewGame);
                },5000);

                $("body").on('click', '#countViewArchiveList', function(){
                    viewGame = viewGame + 5;
                    RenderTableArchiveListSmall(sportType, viewGame);
                });

                function RenderTableArchiveListSmall(sportType, viewGame, append = false) {
                    $.post('/getData/archiveListSmall.php', {count:viewGame,type:sportType}, function(out){
                        if(append){
                            $("#archive-list-small").append(out);
                        }else {
                            $("#archive-list-small").html(out);
                        }
                    });
                }
            });
        </script>
        </tbody>
    </table>
</div>
<!--/ Stakes Table -->