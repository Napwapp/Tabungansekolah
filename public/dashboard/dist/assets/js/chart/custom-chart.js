document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('tabunganChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                    label: 'Top Up (Rp)',
                    data: grafikTopup,
                    backgroundColor: 'rgba(40, 167, 69, 0.2)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 2,
                    tension: 0.3
                },
                {
                    label: 'Menabung (Rp)',
                    data: grafikMenabung,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    tension: 0.3
                },
                {
                    label: 'Penarikan (Rp)',
                    data: grafikPenarikan,
                    backgroundColor: 'rgba(246, 195, 67, 0.2)',
                    borderColor: 'rgb(255, 230, 0)', 
                    borderWidth: 2,
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.dataset.label || '';
                            const value = context.parsed.y;
                            return label + ': Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
});