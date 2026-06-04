const drawButton = document.getElementById('drawButton');

drawButton.addEventListener('click', async () => {

    try {

        const response = await fetch('/gacha/draw', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN':
                document.querySelector(
                    'meta[name="csrf-token"]'
                ).content
            }
        });

        console.log(await response.text());

    } catch (error) {

        console.error(error);

    }

});


window.Echo
    .channel('gacha.dashboard')
    .listen('.gacha.pulled', (event) => {

        const resultArea =
            document.getElementById('gachaResult');

        resultArea.innerHTML =
            `
${event.item_name}
(${event.rarity})
`;

        const log =
            document.createElement('li');

        log.innerHTML =
            `[${event.timestamp}]
${event.item_name}
(${event.rarity})`;

        document
            .getElementById('gachaLogs')
            .prepend(log);

        console.log(event);

    });
