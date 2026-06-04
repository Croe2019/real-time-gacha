@extends('layouts.app')

@section('content')
    <div id="gacha-app" class="gacha-container" data-user-id="{{ auth()->id() }}">
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
                <div v-if="results.length" class="card shadow-lg border-0 mb-4">
                    <h2 class="h4 fw-bold text-center mb-4">ガチャ結果</h2>
                    <div class="results-grid">
                        <div v-for="result in results" :key="result.id" class="result-item text-center">
                            <div class="mb-3">
                                <img :src="'https://via.placeholder.com/250?text=' + encodeURIComponent(result.item_name)" :alt="result.item_name" class="result-image">
                            </div>
                            <h4 :style="{color: getRarityColor(result.rarity)}" class="fw-bold mb-3" v-text="result.item_name"></h4>
                                <p class="mb-3">
                                    <span class="badge badge-lg" :style="{backgroundColor: getRarityColor(result.rarity), padding: '10px 20px', fontSize: '1rem'}" v-text="result.rarity"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 初期表示メッセージ -->
                <div v-else-if="errorMessage" class="alert alert-danger text-center">
                    <p class="mb-0" v-text="errorMessage"></p>
                </div>
                <div v-else class="alert alert-info text-center">
                    <p class="mb-0">ガチャボタンを押してアイテムを獲得しよう！</p>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @vite('resources/js/gacha.js')

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

        .results-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 24px;
        }

        .result-image {
            width: 100%;
            max-width: 180px;
            height: 180px;
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
