@extends('bank_sampah_pusat.layout')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Dashboard Bank Sampah Pusat</h1>
    <div class="bg-white p-4 rounded-lg shadow-md mb-4">
        <h2 class="text-lg font-semibold">Total Pengumpulan Sampah Tahun Ini: {{ number_format($totalBerat, 2) }} kg</h2>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold">Statistik Sampah yang terkumpul</h2>
        <canvas id="jenisSampahChart"></canvas>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg mt-8">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Daftar Bank Sampah Unit</h3>
        </div>
        <ul class="divide-y divide-gray-200">
            @foreach($units as $unit)
                <li class="px-4 py-4 flex items-center">
                    <img class="h-10 w-10 rounded-full" src="{{ $unit->profile_picture ?? 'https://via.placeholder.com/40' }}" alt="">
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">{{ $unit->name }}</p>
                        <p class="text-sm text-gray-500">{{ $unit->address }}</p>
                        <p class="text-sm text-gray-500">{{ $unit->phone }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('jenisSampahChart').getContext('2d');
    var chartData = {
        labels: {!! json_encode(array_values($months)) !!},
        datasets: [
            @foreach($kategoriSampahList as $kategori)
            {
                label: '{{ $kategori }} (kg)',
                data: [
                    @foreach(array_keys($months) as $month)
                    {{ isset($monthlyData[$month][$kategori]) ? $monthlyData[$month][$kategori] : 0 }},
                    @endforeach
                ],
                backgroundColor: 'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                borderColor: 'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 1)',
                borderWidth: 1
            },
            @endforeach
        ]
    };

    var jenisSampahChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Berat (kg)'
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.raw + ' kg';
                            return label;
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection
