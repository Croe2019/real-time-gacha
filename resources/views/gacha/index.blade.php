
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>リアルタイムガチャ</title>

    @vite([
        'resources/js/app.js',
        'resources/js/gacha.js'
    ])
</head>
<body>

<h1>リアルタイムガチャ</h1>

<button id="drawButton">
    ガチャを引く
</button>

<hr>

<h2>最新結果</h2>

<div id="gachaResult">
    未実行
</div>

<hr>

<h2>リアルタイムログ</h2>

<ul id="gachaLogs">

</ul>

</body>
</html>
