<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>株価チャート</title>
        <!--jQuery-->
        <script src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
        <!--モーダル-->
        <script src="https://cdn.jsdelivr.net/npm/modaal@0.4.4/dist/js/modaal.min.js" integrity="sha256-e8kfivdhut3LQd71YXKqOdkWAG1JKiOs2hqYJTe0uTk=" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/modaal@0.4.4/dist/css/modaal.min.css"/>
        <!--Chart.js-->
        <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.js"
        integrity="sha256-8AdWdyRXkrETyAGla9NmgkYVlqw4MOHR6sJJmtFGAYQ=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
        integrity="sha512-mf78KukU/a8rjr7aBRvCa2Vwg/q0tUjJhLtcK53PHEbFwCEqQ5durlzvVTgQgKpv+fyNMT6ZQT1Aq6tpNqf1mg=="
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-streaming@1.8.0/dist/chartjs-plugin-streaming.min.js"
        integrity="sha256-wqXny6qh3ioeH5yAUB6xPVTJ/EcNaHOR1HvuSZuEFXU=" crossorigin="anonymous"></script>
        <!--CSS-->
        <link rel="stylesheet" href="{{ asset('css/stockchart.css') }}">
    </head>
    <body>
        <h1>株価チャート</h1>
        <!--モーダル-->
        <a href="#modal" class="choice_modal">銘柄選択</a>
        <div id="modal">
            <h2>株価チャートに表示する銘柄を選択してください</h2>
            <div id="stock_list"></div>
            <button id="button">選択した銘柄の株価を表示</button>
        </div>
        <!--株価チャート-->
        <div class="chart-container">
            <canvas id="canvas"></canvas>
        </div>

        <script type="text/javascript" src="{{ asset('js/stockchart.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/chart_vertical_line.js') }}"></script>
    </body>
</html>
