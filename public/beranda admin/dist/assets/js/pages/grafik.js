// Mengambil elemen canvas
const ctx = document.getElementById('myChart').getContext('2d');

// Data untuk grafik
const data = {
    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
    datasets: [{
        label: 'User Activity',
        data: [900, 1100, 1200, 1000, 1300, 1200, 1200, 1500, 2000, 1990, 2100, 1000],
        backgroundColor: 'rgba(92, 114, 187, 0.6)',
        borderColor: '#435ebe',
        borderWidth: 2,
        fill: true,
        tension: 0.4, // Membuat grafik melengkung
        pointBackgroundColor: '#ffffff',
        pointBorderColor: '#435ebe',
        pointRadius: 4
    }]
};

// Konfigurasi grafik
const config = {
    type: 'line', // Jenis grafik: garis
    data: data,
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false // Menyembunyikan legenda
            },
            title: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: '#42424e'
                },
                ticks: {
                    color: '#a0aec0'
                }
            },
            x: {
                grid: {
                    color: '#42424e'
                },
                ticks: {
                    color: '#a0aec0'
                }
            }
        }
    }
};

// Membuat grafik
new Chart(ctx, config);
