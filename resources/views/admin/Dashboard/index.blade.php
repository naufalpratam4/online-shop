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
                        var options = {
                            series: <?php echo json_encode($stocks); ?>,
                            chart: {
                                type: 'polarArea',
                                height: '100%'

                            },
                            labels: <?php echo json_encode($labels); ?>,
                            fill: {
                                opacity: 0.8
                            }
                        };

                        var chart = new ApexCharts(document.querySelector("#piechart"), options);
                        chart.render();
                    </script>

                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-4 ">
                <div class=" p-4 bg-gray-50 h-full rounded-md hover:border-2 hover:border-green-500">
                    <div id="heatmapchart"></div>
                    <h1 class="text-2xl font-bold mb-6 text-center">Hitung Laba Kotor dan Laba Bersih</h1>

                    @csrf
                    <div class="mb-4">
                        <label for="revenue" class="block text-sm font-medium text-gray-700">Pendapatan:</label>
                        <input type="number" id="revenue" name="revenue" value="{{ old('revenue') }}" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    </div>
                    <div class="mb-6">
                        <label for="expenses" class="block text-sm font-medium text-gray-700">Biaya:</label>
                        <input type="number" id="expenses" name="expenses" value="{{ old('expenses') }}" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    </div>
                    <button type="button" onclick="calculateProfit()"
                        class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Hitung
                    </button>

                    <div class="result" id="result"></div>

                    <script>
                        function calculateProfit() {
                            // Get the values from the input fields
                            const revenue = parseFloat(document.getElementById('revenue').value);
                            const expenses = parseFloat(document.getElementById('expenses').value);

                            // Calculate the profit
                            const profit = revenue - expenses;

                            // Display the result
                            document.getElementById('result').textContent = `Keuntungan: Rp ${profit}`;
                        }
                    </script>

                </div>
                <div class="bg-gray-50 rounded-md p-4 hover:border-2 hover:border-green-500">
                    <div class="flex justify-between">
                        <div class="font-semibold text-2xl">Produk Terlaris</div>
                        <div class="font-semibold text-2xl">Risol</div>
                    </div>

                    <div class="px-16">
                        <img class="rounded-md w-full" style="aspect-ratio: 1 / 1; " src="https://picsum.photos/200"
                            alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
