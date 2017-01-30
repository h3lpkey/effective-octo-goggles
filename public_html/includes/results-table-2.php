<!-- Results Table -->
<div class="overflow-hidden">
    <table class="table table-striped table-hover border-bottom margin-bottom-0">
        <thead>
        <tr>
            <td class="fsz18">Игры</td>
        </tr>
        </thead>

        <tbody id="archive-index-small">
        <script type="text/javascript">
            $(document).ready(function () {
                var sportType = '';
                var viewGame = 10;
                RenderTableArchiveIndexSmall(sportType, viewGame);
                setInterval(function () {
                    RenderTableArchiveIndexSmall(sportType, viewGame);
                },5000);

                $("body").on('click', '#countViewArchive', function(){
                    viewGame = viewGame + 5;
                    RenderTableArchiveIndexSmall(sportType, viewGame);
                });

                function RenderTableArchiveIndexSmall(sportType, viewGame, append = false) {
                    $.post('/getData/indexArchiveSmall.php', {count:viewGame,type:sportType}, function(out){
                        if(append){
                            $("#archive-index-small").append(out);
                        }else {
                            $("#archive-index-small").html(out);
                        }
                    });
                }

                $("body").on('click', '.side-menu li', function(){
                    var type = $(this).find('a').attr('class');
                    sportType = type;
                    RenderTableArchiveIndexSmall(sportType, viewGame);
                });
            });
        </script>
        </tbody>
    </table>
</div>
<!--/ Results Table -->