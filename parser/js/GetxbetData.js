var urlXbet = "http://admlinux.ru/bkData/xbetData.php";
var xBet = new Object();
RenderTableXbet();
setInterval(function () {
    RenderTableXbet();
},5000);

function RenderTableXbet(Sport) {
    $.getJSON(urlXbet,
        function(BetsDataXbet){
            $('#list_bets_table').empty(); // Clear Table

            for(var i in BetsDataXbet.Value) { // Go deep into the JSON
                xBet.SportName = BetsDataXbet.Value[i].SportName;
                if (Sport == xBet.SportName || Sport == null) { // Sport Filter, need 
                    xBet.Data = MatchDate(BetsDataXbet.Value[i].Start);
                    xBet.Time = MatchTime(BetsDataXbet.Value[i].Start);
                    xBwwwet.Score1 = BetsDataXbet.Value[i].Scores.FullScore.Sc1;
                    xBet.Score2 = BetsDataXbet.Value[i].Scores.FullScore.Sc2;
                    xBet.Opp1 = BetsDataXbet.Value[i].Opp1;
                    xBet.Opp2 = BetsDataXbet.Value[i].Opp2;
                    xBet.urlVideo = BetsDataXbet.Value[i].TvChannel;
                    xBet.urlCompare = "#";

                    $('#list_bets_table').append( // Bilding table
                        '<div class="list-bets-line">' +
                        '<div id="live" class="live">' + xBet.Data + '</div>' +
                        '<div class="time">' + xBet.Time + '</div>' +
                        '<div class="score">' + xBet.Score1 + ":" + xBet.Score2 + '</div>' +
                        '<div class="teams">' + xBet.Opp1 + ":" + xBet.Opp2 + '</div>' +
                        '<div class="team-1-bet"></div>' +
                        '<div class="team-draw-bet"></div>' +
                        '<div class="team-2-bet"></div>' +
                        '<a href="#"><div id="compare" class="compare">Сравнить</div></a>' +
                        '</div>' +
                        '<div class="bets-line"></div>');

                    for (var y in BetsDataXbet.Value[i].Events) { // Deeper into the JSON for bets
                        xBet.Bets = BetsDataXbet.Value[i].Events[y].C; // The Bets
                        xBet.BetsRights = BetsDataXbet.Value[i].Events[y].T; // Only bets about Opp Wins or Draw
                        switch (xBet.BetsRights) {
                            case 1:
                                $('.team-1-bet:last').append(xBet.Bets);
                                break;
                            case 2:
                                $('.team-draw-bet:last').append(xBet.Bets);
                                break;
                            case 3:
                                $('.team-2-bet:last').append(xBet.Bets);
                                break;
                        }
                    }
                }

            }
        });
}