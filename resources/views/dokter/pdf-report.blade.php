<x-app-layout>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; font-size: 12px; line-height: 1.4; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 20px; }
        .header h1 { color: #333; margin: 0; font-size: 24px; }
        .header p { margin: 5px 0; color: #666; }
        .chart-container { background-color: #ffffff; border: 1px solid #ddd; border-radius: 5px; padding: 25px; margin-bottom: 30px; page-break-inside: avoid; text-align: center; }
        .chart-title { font-size: 18px; font-weight: bold; color: #333; margin-bottom: 25px; }
        .chart-image { max-width: 100%; height: auto; border: 1px solid #ccc; padding: 10px; border-radius: 5px; }
        .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #666; border-top: 1px solid #ddd; padding-top: 15px; }
        @media print { body { margin: 0; padding: 15px; } }
    </style>

    <div class="header">
        <h1>Laporan Rating Dokter Hewan</h1>
        <p>Tanggal: {{ $tanggal }} - Grafik Perbandingan Rating Dokter</p>
    </div>

    <div class="chart-container">
        <div class="chart-title">Rating Dokter - Grafik Perbandingan</div>
        @if(isset($chartBase64))
            <img src="{{ $chartBase64 }}" class="chart-image">
        @else
            <p style="color: #888;">Grafik tidak tersedia.</p>
        @endif
    </div>

    <div class="footer">
        <p>Laporan ini dibuat secara otomatis pada {{ now()->format('d/m/Y H:i:s') }}</p>
        <p><strong>Sistem Informasi Rating Dokter Hewan</strong></p>
    </div>
</x-app-layout>