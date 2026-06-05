<!DOCTYPE html>

<html lang="ja">

<head>
    <meta charset="UTF-8">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/dashboard.js'
    ])

    <style>
        body {
            padding: 20px;
            font-family: sans-serif;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
        }

        .card h2 {
            margin-top: 0;
        }

        .card div {
            font-size: 24px;
            font-weight: bold;
        }

        .chart-container {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        canvas {
            width: 100%;
            max-width: 1200px;
            height: 400px;
        }

        #event-log {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
    ```

</head>

<body>

<h1>リアルタイムガチャ監視</h1>

<div class="grid">


    <div class="card">
        <h2>接続数</h2>
        <div id="connections">0</div>
    </div>

    <div class="card">
        <h2>総ガチャ回数</h2>
        <div id="draws">0</div>
    </div>

    <div class="card">
        <h2>SSR排出数</h2>
        <div id="ssr">0</div>
    </div>

    <div class="card">
        <h2>RPS</h2>
        <div id="rps">0</div>
    </div>

    <div class="card">
        <h2>レスポンス時間(ms)</h2>
        <div id="response-time">0</div>
    </div>
    ```

</div>

<div class="chart-container">
    <canvas id="drawChart"></canvas>
</div>

<div class="chart-container">
    <canvas id="ssrChart"></canvas>
</div>

<div class="chart-container">
    <canvas id="rpsChart"></canvas>
</div>

<div class="chart-container">
    <canvas id="responseChart"></canvas>
</div>

<div>

    <h2>リアルタイムログ</h2>

    <ul id="event-log">

    </ul>


</div>

</body>

</html>
