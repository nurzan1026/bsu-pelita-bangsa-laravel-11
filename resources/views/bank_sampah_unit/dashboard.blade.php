@extends('bank_sampah_unit.layout')

@section('content')
    <div class="w-full px-10 text-2xl sm:text-3xl lg:text-3xl font-bold tracking-wider mt-14">
        <div class="w-fit pb-2 flex items-center gap-2">
            <div class="w-10 h-10 bg-purple-400 rounded-full flex items-center justify-center">
                <svg class="w-7 h-7 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                </svg>
            </div>
            <h1>Dashboard</h1>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-6 mx-10">
        <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between">
            <div class="flex flex-col gap-3 text-gray-600">
                <h2 class="text-lg sm:text-xl lg:text-2xl font-semibold">Penjualan Sampah</h2>
                <p class="text-xl sm:text-2xl lg:text-3xl font-bold">Rp
                    {{ number_format($totalHargaPenjualan, 0, ',', '.') }}</p>
            </div>
            <div class="w-fit h-fit p-2 rounded-full bg-green-400">
                <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.6 16.733c.234.269.548.456.895.534a1.4 1.4 0 0 0 1.75-.762c.172-.615-.446-1.287-1.242-1.481-.796-.194-1.41-.861-1.241-1.481a1.4 1.4 0 0 1 1.75-.762c.343.077.654.26.888.524m-1.358 4.017v.617m0-5.939v.725M4 15v4m3-6v6M6 8.5 10.5 5 14 7.5 18 4m0 0h-3.5M18 4v3m2 8a5 5 0 1 1-10 0 5 5 0 0 1 10 0Z" />
                </svg>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between">
            <div class="flex flex-col gap-3 text-gray-600">
                <h2 class="text-lg sm:text-xl lg:text-2xl font-semibold">Setoran Sampah</h2>
                <p class="text-xl sm:text-2xl lg:text-3xl font-bold">{{ number_format($totalBeratSetoran, 2, ',', '.') }} Kg
                </p>
            </div>
            <div class="w-fit h-fit p-2 rounded-full bg-green-400">
                <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 7 2 2 4-4m-5-9v4h4V3h-4Z" />
                </svg>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between">
            <div class="flex flex-col gap-3 text-gray-600">
                <h2 class="text-lg sm:text-xl lg:text-2xl font-semibold">Sampah Daur Ulang</h2>
                <p class="text-xl sm:text-2xl lg:text-3xl font-bold">{{ number_format($totalBeratDaurUlang, 2, ',', '.') }}
                    Kg</p>
            </div>
            <div class="w-fit h-fit p-2 rounded-full bg-green-400">
                <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 12c.263 0 .524-.06.767-.175a2 2 0 0 0 .65-.491c.186-.21.333-.46.433-.734.1-.274.15-.568.15-.864a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 12 9.736a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 16 9.736c0 .295.052.588.152.861s.248.521.434.73a2 2 0 0 0 .649.488 1.809 1.809 0 0 0 1.53 0 2.03 2.03 0 0 0 .65-.488c.185-.209.332-.457.433-.73.1-.273.152-.566.152-.861 0-.974-1.108-3.85-1.618-5.121A.983.983 0 0 0 17.466 4H6.456a.986.986 0 0 0-.93.645C5.045 5.962 4 8.905 4 9.736c.023.59.241 1.148.611 1.567.37.418.865.667 1.389.697Zm0 0c.328 0 .651-.091.94-.266A2.1 2.1 0 0 0 7.66 11h.681a2.1 2.1 0 0 0 .718.734c.29.175.613.266.942.266.328 0 .651-.091.94-.266.29-.174.537-.427.719-.734h.681a2.1 2.1 0 0 0 .719.734c.289.175.612.266.94.266.329 0 .652-.091.942-.266.29-.174.536-.427.718-.734h.681c.183.307.43.56.719.734.29.174.613.266.941.266a1.819 1.819 0 0 0 1.06-.351M6 12a1.766 1.766 0 0 1-1.163-.476M5 12v7a1 1 0 0 0 1 1h2v-5h3v5h7a1 1 0 0 0 1-1v-7m-5 3v2h2v-2h-2Z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row lg:justify-between mt-0 md:mt-6 mx-10 gap-x-6">
        <div class="lg:w-3/5 w-full mt-5 lg:mt-0 lg:ml-0 bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-lg sm:text-xl lg:text-2xl font-semibold mb-4">Grafik Penjualan Sampah</h2>
            <canvas id="penjualanChart" width="400" height="270"
                data-labels="{{ json_encode(['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']) }}"
                data-data="{{ json_encode($penjualanBulanan) }}"></canvas>
        </div>

        <div class="lg:w-2/5 w-full mt-5 lg:mt-0 lg:mr-0 bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-lg sm:text-xl lg:text-2xl font-semibold mb-2">Nasabah Teraktif</h2>
            <ul>
                @foreach ($nasabahTerbaru as $nasabah)
                    <li class="flex items-center mb-4 p-2 border-b-[3px] border-gray-300">
                        <img src="{{ $nasabah->foto }}" alt="{{ $nasabah->nama }}" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <p class="text-base sm:text-lg lg:text-xl font-semibold">{{ $nasabah->nama }}</p>
                            <p class="text-sm sm:text-base lg:text-lg text-gray-600">
                                Setoran : {{ number_format($nasabah->total_berat, 2, ',', '.') }} Kg</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row mt-0 md:mt-6 mx-10 gap-6">
        <div class="lg:w-3/5 w-full mt-5 lg:mt-0 lg:ml-0 bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-lg sm:text-xl lg:text-2xl font-semibold mb-4">Grafik Setoran Sampah</h2>
            <canvas id="setoranChart" style="max-width: 100%;" width="400" height="200"
                data-labels="{{ json_encode(['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']) }}"
                data-data="{{ json_encode($setoranBulanan) }}"></canvas>
        </div>
        <div class="w-2/5"></div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const penjualanCtx = document.getElementById('penjualanChart').getContext('2d');
            const penjualanLabels = JSON.parse(document.getElementById('penjualanChart').dataset.labels);
            const penjualanData = JSON.parse(document.getElementById('penjualanChart').dataset.data);
            const penjualanDataset = new Array(12).fill(0);
            penjualanData.forEach(item => {
                penjualanDataset[item.bulan - 1] = item.total;
            });

            if (typeof Chart !== 'undefined') {
                new Chart(penjualanCtx, {
                    type: 'bar',
                    data: {
                        labels: penjualanLabels,
                        datasets: [{
                            label: 'Penjualan Sampah',
                            data: penjualanDataset,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Grafik Penjualan Sampah'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return 'Rp ' + tooltipItem.raw.toString().replace(
                                            /\B(?=(\d{3})+(?!\d))/g, ".");
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Bulan'
                                },
                                grid: {
                                    display: true,
                                    color: 'rgba(200, 200, 200, 0.2)'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Total Penjualan (Rp)'
                                },
                                grid: {
                                    display: true,
                                    color: 'rgba(200, 200, 200, 0.2)'
                                }
                            }
                        }
                    }
                });

                const setoranCtx = document.getElementById('setoranChart').getContext('2d');
                const setoranLabels = JSON.parse(document.getElementById('setoranChart').dataset.labels);
                const setoranData = JSON.parse(document.getElementById('setoranChart').dataset.data);
                const setoranDataset = new Array(12).fill(0);
                setoranData.forEach(item => {
                    setoranDataset[item.bulan - 1] = item.total;
                });

                new Chart(setoranCtx, {
                    type: 'bar',
                    data: {
                        labels: setoranLabels,
                        datasets: [{
                            label: 'Setoran Sampah',
                            data: setoranDataset,
                            borderColor: 'rgba(153, 102, 255, 1)',
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderWidth: 2,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Grafik Setoran Sampah'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.raw.toString().replace(
                                            /\B(?=(\d{3})+(?!\d))/g, ".") + ' Kg';
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Bulan'
                                },
                                grid: {
                                    display: true,
                                    color: 'rgba(200, 200, 200, 0.2)'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Total Setoran (Kg)'
                                },
                                grid: {
                                    display: true,
                                    color: 'rgba(200, 200, 200, 0.2)'
                                }
                            }
                        }
                    }
                });
            } else {
                console.error('Chart is not defined');
            }
        });
    </script>
@endsection
