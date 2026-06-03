@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h2>🎲 ガチャシミュレーター</h2>
                </div>
                <div class="card-body">
                    <!-- ガチャ結果表示エリア -->
                    <div id="gacha-results" class="mb-4">
                        <div class="alert alert-info">ガチャを実行してください</div>
                    </div>

                    <!-- ガチャボタン -->
                    <div class="text-center mb-4">
                        <button id="gacha-button" class="btn btn-lg btn-success" onclick="executeGacha()">
                            ガチャを実行
                        </button>
                        <button id="clear-button" class="btn btn-lg btn-secondary ms-2" onclick="clearResults()">
                            クリア
                        </button>
                    </div>

                    <!-- ローディング表示 -->
                    <div id="loading" class="text-center" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">ガチャ結果を取得中...</p>
                    </div>

                    <!-- 結果一覧 -->
                    <div id="results-list" class="mt-4">
                        <!-- リアルタイムで追加される -->
                         @foreach($items as $item)
                            <div>{{ $item }}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pusher（Reverb）スクリプト -->
<script src="https://cdn.jsdelivr.net/npm/@pusher/push-notifications-web@1.1.1/index.js"></script>
<script>
    // Reverb設定
    const pusher = new Pusher('{{ config('reverb.options.app_key') }}', {
        cluster: '{{ config('reverb.options.cluster') }}',
        wsHost: '{{ config('reverb.options.host') }}',
        wsPort: '{{ config('reverb.options.port') }}',
        forceTLS: false,
        disableStats: true,
        enabledTransports: ['ws', 'wss'],
    });

    // チャンネルに購読
    const gachaChannel = pusher.subscribe(`gacha.{{ auth()->id() ?? 'guest' }}`);

    // イベントリスナー
    gachaChannel.bind('result', function(data) {
        displayGachaResult(data);
    });

    // ガチャ実行関数
    function executeGacha() {
        const button = document.getElementById('gacha-button');
        const loading = document.getElementById('loading');

        button.disabled = true;
        loading.style.display = 'block';

        // APIエンドポイントにリクエスト
        fetch('/api/gacha/draw', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('ガチャ実行:', data);
        })
        .catch(error => {
            console.error('エラー:', error);
            alert('ガチャの実行に失敗しました');
        })
        .finally(() => {
            button.disabled = false;
            loading.style.display = 'none';
        });
    }

    // ガチャ結果表示関数
    function displayGachaResult(data) {
        const resultsList = document.getElementById('results-list');
        const gachaResults = document.getElementById('gacha-results');

        // 初回表示時はalertを非表示
        gachaResults.innerHTML = '';

        // レアリティに応じた色分け
        const rarityColors = {
            'common': '#999999',
            'uncommon': '#00ff00',
            'rare': '#0099ff',
            'epic': '#9900ff',
            'legendary': '#ffaa00'
        };

        const color = rarityColors[data.rarity] || '#999999';

        // 結果カード作成
        const resultCard = document.createElement('div');
        resultCard.className = 'card mb-3 gacha-result-card';
        resultCard.style.borderLeft = `5px solid ${color}`;
        resultCard.innerHTML = `
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center">
                        <img src="${data.item_image}" alt="${data.item_name}" 
                             class="img-fluid rounded" style="max-width: 100px;">
                    </div>
                    <div class="col-md-9">
                        <h5 class="card-title" style="color: ${color}; font-weight: bold;">
                            ${data.item_name}
                        </h5>
                        <p class="card-text">
                            <span class="badge" style="background-color: ${color};">
                                ${data.rarity.toUpperCase()}
                            </span>
                        </p>
                        <p class="card-text text-muted small">
                            ${new Date(data.created_at).toLocaleString('ja-JP')}
                        </p>
                        <p class="card-text">${data.description || 'アイテムの説明'}</p>
                    </div>
                </div>
            </div>
        `;

        resultsList.insertBefore(resultCard, resultsList.firstChild);

        // アニメーション効果
        resultCard.style.animation = 'slideIn 0.5s ease-out';

        // 最大表示件数を制限
        const cards = resultsList.querySelectorAll('.gacha-result-card');
        if (cards.length > 10) {
            cards[cards.length - 1].remove();
        }
    }

    // クリア関数
    function clearResults() {
        document.getElementById('results-list').innerHTML = '';
        document.getElementById('gacha-results').innerHTML = 
            '<div class="alert alert-info">ガチャを実行してください</div>';
    }
</script>

<!-- アニメーションスタイル -->
<style>
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .gacha-result-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .gacha-result-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }

    #gacha-button {
        font-size: 1.2em;
        padding: 12px 40px;
        transition: all 0.3s ease;
    }

    #gacha-button:not(:disabled):hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    #gacha-button:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
</style>
@endsection
