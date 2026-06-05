import Chart from 'chart.js/auto';

console.log('dashboard.js loaded');

/*
|--------------------------------------------------------------------------
| グラフ用データ
|--------------------------------------------------------------------------
*/

const labels = [];

const drawData = [];
const ssrData = [];
const rpsData = [];
const responseData = [];

const MAX_POINTS = 30;


/*
|--------------------------------------------------------------------------
| 総ガチャ回数グラフ
|--------------------------------------------------------------------------
*/


const drawChart = new Chart(
    document.getElementById('drawChart'),
    {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'Total Draws',
                    data: drawData,
                }
            ]
        }
    }
);

/*
|--------------------------------------------------------------------------
| SSR排出数グラフ
|--------------------------------------------------------------------------
*/

const ssrChart = new Chart(
    document.getElementById('ssrChart'),
    {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'SSR Count',
                    data: ssrData,
                }
            ]
        }
    }
);

/*
|--------------------------------------------------------------------------
| RPSグラフ
|--------------------------------------------------------------------------
*/

const rpsChart = new Chart(
    document.getElementById('rpsChart'),
    {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'RPS',
                    data: rpsData,
                }
            ]
        }
    }
);

/*
|--------------------------------------------------------------------------
| レスポンス時間グラフ
|--------------------------------------------------------------------------
*/

const responseChart = new Chart(
    document.getElementById('responseChart'),
    {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'Response Time',
                    data: responseData,
                }
            ]
        }
    }
);

/*
|--------------------------------------------------------------------------
| Reverb受信
|--------------------------------------------------------------------------
*/

window.Echo.channel('dashboard.stats')
    .listen('.dashboard.updated', (e) => {


        /*
        |--------------------------------------------------------------------------
        | カード更新
        |--------------------------------------------------------------------------
        */

        document.getElementById('draws')
            .textContent = e.totalDraws;

        document.getElementById('ssr')
            .textContent = e.ssrCount;

        document.getElementById('rps')
            .textContent = e.rps;

        document.getElementById('response-time')
            .textContent = e.responseTime;

        /*
        |--------------------------------------------------------------------------
        | グラフ更新
        |--------------------------------------------------------------------------
        */

        const time = new Date().toLocaleTimeString();

        labels.push(time);

        drawData.push(e.totalDraws);
        ssrData.push(e.ssrCount);
        rpsData.push(e.rps);
        responseData.push(e.responseTime);

        if (labels.length > MAX_POINTS) {

            labels.shift();

            drawData.shift();
            ssrData.shift();
            rpsData.shift();
            responseData.shift();
        }

        drawChart.update();
        ssrChart.update();
        rpsChart.update();
        responseChart.update();

        addLog(e);
    });

let currentConnections = 0;

window.Echo.join('dashboard.presence')

    .here(users => {

        currentConnections = users.length;

        updateConnectionCard(
            currentConnections
        );
    })

    .joining(() => {

        currentConnections++;

        updateConnectionCard(
            currentConnections
        );
    })

    .leaving(() => {

        currentConnections =
            Math.max(
                0,
                currentConnections - 1
            );

        updateConnectionCard(
            currentConnections
        );
    });

/*
|--------------------------------------------------------------------------
| ログ表示
|--------------------------------------------------------------------------
*/

function addLog(data)
{
    const log = document.getElementById('event-log');

    const li = document.createElement('li');

    li.innerText =
        `[${new Date().toLocaleTimeString()}]
        Draws:${data.totalDraws}
        SSR:${data.ssrCount}
        RPS:${data.rps}
        Response:${data.responseTime}ms`;

    log.prepend(li);

    while (log.children.length > 50)
    {
        log.removeChild(log.lastChild);
    }
}

function updateConnectionCard(count)
{
    document.getElementById(
        'connections'
    ).innerText = count;
}
