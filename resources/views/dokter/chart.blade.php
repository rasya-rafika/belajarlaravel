<x-app-layout>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translate(0, 0px); }
            50% { transform: translate(0, -10px); }
            100% { transform: translate(0, -0px); }
        }
        
        .chart-container {
            background: linear-gradient(135deg, #ffffff 0%, #fef7f0 100%);
            position: relative;
            overflow: hidden;
            border: 1px solid #fed7aa;
        }
        
        .chart-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(249, 115, 22, 0.03) 0%, rgba(251, 146, 60, 0.03) 100%);
            pointer-events: none;
        }
        
        .doctor-card {
            background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .doctor-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .doctor-card:hover::before {
            opacity: 1;
        }
        
        .rating-stars {
            color: #fbbf24;
            filter: drop-shadow(0 2px 4px rgba(251, 191, 36, 0.3));
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #ea580c 0%, #f97316 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(249, 115, 22, 0.3);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            transition: all 0.3s ease;
        }
        
        .btn-success:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
        }
        
        .stats-counter {
            background: linear-gradient(135deg, #ffffff 0%, #fed7aa 100%);
            color: #c2410c;
            border: 2px solid #fed7aa;
        }
        
        .header-icon {
            background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
            box-shadow: 0 8px 25px rgba(249, 115, 22, 0.3);
        }
        
        .page-background {
            background: linear-gradient(135deg, #ffffff 0%, #fef7f0 30%, #fef2e8 100%);
            position: relative;
            min-height: 100vh;
        }
        
        .page-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.7;
        }
        
        .content-wrapper {
            position: relative;
            z-index: 1;
        }
    </style>

    <div class="page-background">
        <div class="content-wrapper max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
            <!-- Header Section -->
            <div class="text-center mb-16">
                <div class="inline-flex items-center justify-center w-20 h-20 header-icon rounded-full mb-6 floating">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h1 class="text-5xl sm:text-6xl font-black text-gray-800 mb-6">
                    Chart <span class="gradient-text">Rating</span> Dokter
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Analisis rating dan kepuasan pasien terhadap dokter hewan terbaik
                </p>
                
                <!-- Quick Stats -->
                <div class="flex justify-center mt-8 space-x-8">
                    <div class="stats-counter px-6 py-3 rounded-full">
                        <span class="font-bold text-lg">{{ count($chartData ?? []) }}</span>
                        <span class="text-sm ml-2">Dokter</span>
                    </div>
                    <div class="stats-counter px-6 py-3 rounded-full">
                        <span class="font-bold text-lg">{{ array_sum(array_column($chartData ?? [], 'total_rating')) }}</span>
                        <span class="text-sm ml-2">Total Review</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-between items-center gap-6 mb-12">
                <a href="{{ route('dokter.index') }}" class="btn-primary inline-flex items-center gap-3 text-white font-bold py-4 px-8 rounded-full shadow-xl group">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar Dokter
                </a>

                <button id="exportPdf" class="btn-success inline-flex items-center gap-3 text-white font-bold py-4 px-8 rounded-full shadow-xl group">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export PDF
                </button>
            </div>

            <!-- Chart Section -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 mb-12 card-hover chart-container">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold gradient-text mb-3">Rating Dokter Hewan</h2>
                    <p class="text-gray-600 text-lg">Grafik menampilkan rating rata-rata dan performa setiap dokter</p>
                </div>
                <div class="relative h-96 w-full">
                    <canvas id="doctorRatingChart" class="w-full h-full"></canvas>
                </div>
            </div>

            <!-- Doctor Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($chartData as $index => $data)
                    <div class="doctor-card p-6 rounded-2xl shadow-xl card-hover relative z-10">
                        <div class="flex items-start justify-between mb-4">
                            <div class="bg-white/20 p-3 rounded-full">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="bg-white/20 px-3 py-1 rounded-full text-sm font-semibold">
                                    #{{ $index + 1 }}
                                </div>
                            </div>
                        </div>
                        
                        <h3 class="text-xl font-bold text-white mb-2">{{ $data['nama'] }}</h3>
                        
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-4 h-4 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p class="text-white/80 text-sm">{{ $data['lokasi'] }}</p>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1 rating-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($data['rata_rating']))
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-white/40" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-white">{{ number_format($data['rata_rating'], 1) }}</div>
                                <div class="text-white/60 text-xs">{{ $data['total_rating'] }} reviews</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dokterNames = @json($dokterNames ?? []);
            const ratings = @json($ratings ?? []);

            const ctx = document.getElementById('doctorRatingChart').getContext('2d');
            if (window.myChart) window.myChart.destroy();

            // Create gradient for bars
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(249, 115, 22, 0.9)');
            gradient.addColorStop(1, 'rgba(234, 88, 12, 0.7)');

            window.myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dokterNames,
                    datasets: [{
                        label: 'Rating',
                        data: ratings,
                        backgroundColor: gradient,
                        borderColor: 'rgba(249, 115, 22, 1)',
                        borderWidth: 2,
                        borderRadius: 12,
                        borderSkipped: false,
                        barThickness: 50,
                        maxBarThickness: 60
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: 'rgba(249, 115, 22, 1)',
                            borderWidth: 1,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                title: function(context) {
                                    return context[0].label;
                                },
                                label: function(context) {
                                    return `Rating: ${context.parsed.y}/5 ⭐`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 5,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)',
                                drawBorder: false
                            },
                            ticks: {
                                color: '#6b7280',
                                font: {
                                    size: 12,
                                    weight: '500'
                                },
                                callback: function(value) {
                                    return value + '/5';
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6b7280',
                                font: {
                                    size: 12,
                                    weight: '500'
                                },
                                maxRotation: 45
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeOutQuart'
                    }
                }
            });
        });

        document.getElementById('exportPdf').addEventListener('click', async () => {
            // Add loading state
            const button = document.getElementById('exportPdf');
            const originalText = button.innerHTML;
            button.innerHTML = `
                <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Generating PDF...
            `;
            button.disabled = true;

            try {
                const canvas = document.getElementById('doctorRatingChart');
                const imgData = canvas.toDataURL('image/png');

                const response = await fetch("{{ route('dokter.generatePdf') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ chart: imgData })
                });

                if (response.ok) {
                    const blob = await response.blob();
                    const url = window.URL.createObjectURL(blob);
                    const link = document.createElement('a');
                    link.href = url;
                    link.download = 'laporan-rating-dokter.pdf';
                    link.click();
                    window.URL.revokeObjectURL(url);
                } else {
                    throw new Error('Failed to generate PDF');
                }
            } catch (error) {
                console.error('Error generating PDF:', error);
                alert('Gagal menggenerate PDF. Silakan coba lagi.');
            } finally {
                // Restore button state
                button.innerHTML = originalText;
                button.disabled = false;
            }
        });
    </script>

</x-app-layout>