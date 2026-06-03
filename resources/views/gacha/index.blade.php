@extends('layouts.app')

@section('content')
<div id="gacha-app" class="gacha-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- ヘッダー -->
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold">🎲 ガチャシミュレーター</h1>
            </div>

            <!-- ガチャ実行ボタン -->
            <div class="text-center mb-5">
                <button 
                    @click="executeGacha" 
                    :disabled="loading"
                    class="btn btn-primary btn-lg gacha-btn">
                    <span v-if="!loading">
                        ガチャを実行
                    </span>
                    <span v-else>
                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        実行中...
                    </span>
                </button>
            </div>

            <!-- ガチャ結果表示 -->
            <div v-if="latestResult" class="card shadow-lg border-0 mb-4">
                <div class="card-body p-4">
                    <div class="result-item">
                        <div class="text-center mb-3">
                            <img :src="'https://via.placeholder.com/250?text=' + encodeURIComponent(latestResult.item_name)" :alt="latestResult.item_name" class="result-image">
                        </div>
                        <div class="text-center">
                            <h4 :style="{color: getRarityColor(latestResult.rarity)}" class="fw-bold mb-3" v-text="latestResult.item_name">
                            </h4>
                            <p class="mb-3">
                                <span class="badge badge-lg" :style="{backgroundColor: getRarityColor(latestResult.rarity), padding: '10px 20px', fontSize: '1rem'}" v-text="latestResult.rarity">
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 初期表示メッセージ -->
            <div v-else class="alert alert-info text-center">
                <p class="mb-0">ガチャボタンを押してアイテムを獲得しよう！</p>
            </div>
        </div>
    </div>
</div>

<!-- Reverb設定を JavaScript オブジェクトとして埋め込む -->
<script>
    const reverbConfig = {
        key: '{{ config('broadcasting.connections.reverb.key') }}',
        host: '{{ config('broadcasting.connections.reverb.options.host') }}',
        port: '{{ config('broadcasting.connections.reverb.options.port') }}',
        scheme: '{{ config('broadcasting.connections.reverb.options.scheme') }}'
    };
</script>

@endsection

@push('scripts')
<!-- Pusher & Echo ライブラリの読み込み -->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.16.0/dist/echo.iife.js"></script>

<script>
    // Echo設定
    window.Echo = new Echo({
        broadcaster: 'reverb',
        key: reverbConfig.key,
        wsHost: reverbConfig.host,
        wsPort: reverbConfig.port,
        wssPort: reverbConfig.port,
        forceTLS: reverbConfig.scheme === 'https',
        enabledTransports: ['ws', 'wss']
    });

    const app = Vue.createApp({
        data() {
            return {
                latestResult: null,
                loading: false,
                rarityColorMap: {
                    '1': '#808080',
                    '5': '#4169E1',
                    '10': '#9932CC',
                    '20': '#FFD700'
                }
            };
        },
        mounted() {
            this.subscribeToGachaChannel();
        },
        methods: {
            subscribeToGachaChannel() {
                try {
                    const userId = {{ auth()->id() ?? 'null' }};
                    if (!userId) {
                        console.warn('User not authenticated');
                        return;
                    }

                    window.Echo.private(`gacha.${userId}`)
                        .listen('GachaPulled', (event) => {
                            console.log('Gacha result received:', event);
                            this.latestResult = event.result;
                            this.loading = false;
                        })
                        .error((error) => {
                            console.error('Echo error:', error);
                        });
                } catch (error) {
                    console.error('Failed to subscribe to channel:', error);
                }
            },
            executeGacha() {
                this.loading = true;

                axios.post('/api/gacha/draw', {}, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    }
                })
                .then(response => {
                    console.log('Gacha spin executed:', response.data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.loading = false;
                    alert('ガチャの実行に失敗しました');
                });
            },
            getRarityColor(rarity) {
                return this.rarityColorMap[rarity] || '#808080';
            }
        }
    });

    app.mount('#gacha-app');
</script>
@endpush

@push('styles')
<style>
    .gacha-container {
        padding: 40px 20px;
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    h1 {
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .gacha-btn {
        font-size: 1.2em;
        padding: 15px 50px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
        font-weight: bold;
    }

    .gacha-btn:not(:disabled):hover {
        transform: scale(1.05);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .gacha-btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .result-image {
        width: 250px;
        height: 250px;
        object-fit: cover;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        animation: slideIn 0.6s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .badge-lg {
        display: inline-block;
        color: white;
        font-weight: bold;
    }

    .card {
        border-radius: 15px;
        animation: cardSlideIn 0.6s ease-out;
    }

    @keyframes cardSlideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert {
        border-radius: 15px;
        padding: 30px;
        font-size: 1.1rem;
        background: rgba(255, 255, 255, 0.9);
    }
</style>
@endpush
