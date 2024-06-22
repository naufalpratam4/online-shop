@extends('admin.index')
@section('content')
    <div class=" ">
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
                        var options = {
                            series: [44, 55, 13, 43, 22],
                            chart: {
                                type: 'pie',
                                height: '100%'
                            },
                            labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
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

        </div>
    </div>
@endsection
