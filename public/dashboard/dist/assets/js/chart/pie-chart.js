// pie chart 2
const rawData = window.donutData;

// 1. Ubah ke array berisi label + value
let rawArray = Object.entries(rawData).map(([key, value]) => {
    return {
        label: key.charAt(0).toUpperCase() + key.slice(1),
        value: value
    };
});

// 2. Hitung total dan persentase
const total = rawArray.reduce((sum, item) => sum + item.value, 0);

rawArray = rawArray.map(item => ({
    ...item,
    percent: total > 0 ? (item.value / total) * 100 : 0
}));

// 3. Urutkan dari yang tertinggi
rawArray.sort((a, b) => b.value - a.value);

// 4. Tentukan warna berdasarkan persentase
// Warna utama tiap kategori
const colorGroups = {
    green: ['#52c41a', '#73d13d', '#95de64'],       // Hijau
    blue: ['#1890ff', '#40a9ff', '#69c0ff'],        // Biru Tua
    yellow: ['#faad14', '#ffc53d', '#ffd666'],      // Kuning
    red: ['#ff4d4f', '#ff7875', '#ff9c8a']          // Merah
};

// Tempat penyimpanan hitungan per kategori
const colorUsage = {
    green: 0,
    blue: 0,
    yellow: 0,
    red: 0
};

// Fungsi dapatkan nama kategori berdasarkan persen
const getColorCategory = (percent) => {
    if (percent >= 50) return 'green';
    if (percent >= 40) return 'blue';
    if (percent >= 20) return 'yellow';
    return 'red';
};

// Ambil warna unik dari kategori sesuai urutan
const colorsData = rawArray.map(item => {
    const category = getColorCategory(item.percent);
    const index = colorUsage[category];
    const color = colorGroups[category][index] || colorGroups[category][0]; // default ke warna pertama jika kehabisan
    colorUsage[category]++;
    return color;
});
const seriesData = rawArray.map(item => item.value);
const labelsData = rawArray.map(item => `${item.label}`);

const options_pie_chart_2 = {
    chart: {
        height: 320,
        type: 'donut'
    },
    series: seriesData,
    labels: labelsData,
    colors: colorsData,
    legend: {
        show: true,
        position: 'bottom'
    },
    plotOptions: {
        pie: {
            donut: {
                labels: {
                    show: true,
                    name: {
                        show: true
                    },
                    value: {
                        show: true
                    }
                }
            }
        }
    },
    dataLabels: {
        enabled: true,
        formatter: function (val) {
            return val.toFixed(1) + '%';
        },
        dropShadow: {
            enabled: false
        }
    },
    responsive: [
        {
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    ]
};

const chart_pie_chart_2 = new ApexCharts(document.querySelector('#pie-chart-2'), options_pie_chart_2);
chart_pie_chart_2.render();
