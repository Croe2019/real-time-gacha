<button onclick="drawGacha()">10連ガチャを引く</button>
<div id="gacha-results"></div>

<script>
async function drawGacha() {
    const response = await fetch('/api/gacha/draw', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    });

    const data = await response.json();
    const resultDiv = document.getElementById('gacha-results');
    resultDiv.innerHTML = ''; // 初期化

    // 結果を描画
    data.results.forEach(item => {
        const div = document.createElement('div');
        div.textContent = `獲得: ${item.name}`;
        resultDiv.appendChild(div);
    });
}
</script>
