@extends('admin.index')
@section('content')
    <div class="min-h-screen">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <div class="grid md:grid-cols-3 gap-4 mb-4">
                <div class="p-4 bg-gray-50 h-72 rounded">
                    <p>Transaksi</p>
                    <div id="splinechart"></div>
                    <div>

                    </div>
                    <script>
                        var customersPerMonth = @json($customersPerMonth); // Menggunakan data dari backend

                        var options = {
                            series: [{
                                name: 'Total Customer',
                                data: Object.values(customersPerMonth)
                            }],
                            chart: {
                                type: 'area',
                                height: '100%',
                                zoom: {
                                    enabled: false
                                }
                            },
                            colors: ['#FF5733'], // Mengganti warna seri dengan kode warna 'red'
                            grid: {
                                borderColor: '#ddd' // Warna garis grid
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                curve: 'smooth'
                            },
                            xaxis: {
                                categories: Object.keys(customersPerMonth)
                            },
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: '100%'
                                    },
                                    xaxis: {
                                        labels: {
                                            rotate: -45,
                                            hideOverlappingLabels: true
                                        }
                                    }
                                }
                            }]
                        };

                        var chart = new ApexCharts(document.querySelector("#splinechart"), options);
                        chart.render();
                    </script>

                </div>

                <div class="p-4 h-72 rounded bg-gray-50 dark:bg-gray-800">
                    <div>Pendapatan Bulanan (Rp)</div>
                    <div id="areachart"></div>
                    <script>
                        var totalHargaPerMonth = @json($totalHargaPerMonth); // Menggunakan data dari backend

                        var options = {
                            series: [{
                                name: 'Laba Kotor',
                                data: Object.values(totalHargaPerMonth)
                            }],
                            chart: {
                                type: 'bar',
                                height: '100%'
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: false,
                                    columnWidth: '50%',
                                    endingShape: 'rounded',
                                    colors: {
                                        backgroundBarColors: [],
                                        backgroundBarOpacity: 1,
                                        backgroundBarRadius: 0,
                                        ranges: [{
                                            from: 0,
                                            to: Infinity,
                                            color: '#4CAF50' // Warna hijau
                                        }]
                                    }
                                },
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                show: true,
                                width: 2,
                                colors: ['transparent']
                            },
                            xaxis: {
                                categories: Object.keys(totalHargaPerMonth),
                            },
                            yaxis: {
                                title: {
                                    text: 'Rp (Rupiah)'
                                }
                            },
                            fill: {
                                opacity: 1
                            },
                            tooltip: {
                                y: {
                                    formatter: function(val) {
                                        return "Rp " + val + " Rupiah"
                                    }
                                }
                            },
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: '100%'
                                    },
                                    plotOptions: {
                                        bar: {
                                            columnWidth: '80%'
                                        }
                                    }
                                }
                            }]
                        };

                        var chart = new ApexCharts(document.querySelector("#areachart"), options);
                        chart.render();
                    </script>
                </div>
                <div class="p-4 h-72 rounded bg-gray-50 dark:bg-gray-800">
                    <div>Stok Product</div>

                    <div id="piechart"></div>

                    <script>
                        // Ambil data dari PHP
                        var labels = @json($labels);
                        var stocks = @json($stocks);

                        var options = {
                            series: stocks,
                            chart: {
                                type: 'pie',
                                height: '100%'
                            },
                            labels: labels,
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: 280
                                    },
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }]
                        };

                        var chart = new ApexCharts(document.querySelector("#piechart"), options);

                        chart.render();
                    </script>

                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-4 ">
                <div class="col-span-2 p-4 bg-gray-50 h-full rounded-md">
                    <div id="heatmapchart"></div>
                    <script>
                        function generateData() {
                            var series = [];
                            var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                            var weeks = 52; // Number of weeks to display

                            for (var day = 0; day < days.length; day++) {
                                var data = [];
                                for (var week = 0; week < weeks; week++) {
                                    var x = 'Week ' + (week + 1);
                                    var y = Math.floor(Math.random() * 100); // Generate random data
                                    data.push({
                                        x: x,
                                        y: y
                                    });
                                }
                                series.push({
                                    name: days[day],
                                    data: data
                                });
                            }
                            return series;
                        }

                        var options = {
                            series: generateData(),
                            chart: {
                                height: 450,
                                type: 'heatmap',
                            },
                            dataLabels: {
                                enabled: false
                            },
                            colors: ["#008FFB"], // Default blue color
                            title: {
                                text: 'Penjualan Harian'
                            },
                            xaxis: {
                                categories: Array.from({
                                    length: 52
                                }, (_, i) => `Week ${i + 1}`),
                                labels: {
                                    rotate: -45
                                }
                            },
                            yaxis: {
                                categories: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
                            },
                            plotOptions: {
                                heatmap: {
                                    shadeIntensity: 0.5,
                                    radius: 0,
                                    useFillColorAsStroke: true,
                                }
                            },
                        };

                        var chart = new ApexCharts(document.querySelector("#heatmapchart"), options);
                        chart.render();
                    </script>
                </div>
                <div class="bg-gray-50 rounded-md p-4">
                    <div class="">
                        <img class="rounded-md w-full" style="aspect-ratio: 1 / 1; " src="https://picsum.photos/1000"
                            alt="" />
                    </div>
                    <div class="font-semibold text-2xl">Produk Terlaris</div>
                    <div class="flex justify-between items-center">
                        <div class="font-bold text-xl">Risol</div>
                        <div class="font-bold">Produk Terjual : 2000 pcs</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
