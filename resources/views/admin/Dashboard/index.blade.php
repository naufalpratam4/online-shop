@extends('admin.index')
@section('content')
    <div class=" ">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <div class="grid md:grid-cols-3 gap-4 mb-4">
                <div class="p-2 bg-gray-50 h-64 rounded">
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
                            }
                        };

                        var chart = new ApexCharts(document.querySelector("#splinechart"), options);
                        chart.render();
                    </script>

                </div>

                <div class="p-2 h-64 rounded bg-gray-50 dark:bg-gray-800">
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
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: false,
                                    columnWidth: '100%',
                                    endingShape: 'rounded'
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
                            }
                        };

                        var chart = new ApexCharts(document.querySelector("#areachart"), options);
                        chart.render();
                    </script>
                </div>
                <div class="p-2 h-64 rounded bg-gray-50 dark:bg-gray-800">
                    <div>Stok Product</div>

                    <div id="piechart"></div>
                    <script>
                        var options = {

                            chart: {
                                type: 'donut'
                            },
                            plotOptions: {
                                pie: {
                                    donut: {
                                        size: '40%'
                                    }
                                }
                            },
                            series: [44, 55, 13, 33],
                            labels: ['Udang Keju', 'Risol Mayo', 'Risol Keju', 'Risol Ayam']

                        }

                        var chart = new ApexCharts(document.querySelector("#piechart"), options);

                        chart.render();
                    </script>
                </div>
            </div>

        </div>
    </div>
@endsection
