window.onload = function(){
    const stats = [
        { id: 'timer_colab', target: 20, increment: 1, interval: 150 },
        { id: 'timer_imoveis', target: 50, increment: 1, interval: 60 },
        { id: 'timer_vendas', target: 10, increment: 1, interval: 310 },
    ];

    stats.forEach(stat => {
        let currentValue = 0;

        function updateTimer() {
            const timerElement = document.getElementById(stat.id);

            if (currentValue < stat.target) {
                currentValue += stat.increment;
                timerElement.textContent = currentValue;
            } else {
                clearInterval(timerInterval);
            }
        }
        const timerInterval = setInterval(updateTimer, stat.interval);
    });
};