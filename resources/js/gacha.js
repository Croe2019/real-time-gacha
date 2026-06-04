import axios from 'axios';
import { createApp } from 'vue';
import './Echo';

createApp({
    data() {
        return {
            results: [],
            loading: false,
            errorMessage: '',
            rarityColorMap: {
                1: '#808080',
                5: '#4169E1',
                10: '#9932CC',
                20: '#FFD700',
            },
        };
    },
    mounted() {
        this.subscribeToGachaChannel();
    },
    methods: {
        subscribeToGachaChannel() {
            const userId = document.getElementById('gacha-app')?.dataset.userId;

            if (!userId || !window.Echo) {
                return;
            }

            window.Echo.private(`gacha.${userId}`)
                .listen('.result', (event) => {
                    this.results = event.results ?? [];
                    this.loading = false;
                    this.errorMessage = '';
                })
                .error((error) => {
                    console.error('Echo error:', error);
                });
        },
        executeGacha() {
            this.loading = true;
            this.errorMessage = '';

            axios.post('/api/gacha/draw')
                .then((response) => {
                    this.results = response.data.results ?? [];
                })
                .catch((error) => {
                    console.error('Error:', error);
                    this.errorMessage = 'ガチャの実行に失敗しました';
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        getRarityColor(rarity) {
            return this.rarityColorMap[rarity] || '#808080';
        },
    },
}).mount('#gacha-app');
