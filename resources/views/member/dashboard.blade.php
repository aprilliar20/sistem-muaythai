<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Member - Muaythai Independent</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<div class="member-layout">

    <aside class="member-sidebar">
        <h2>Camp Muaythai<br>Independent</h2>
        <nav>
            <a href="/member/dashboard" class="{{ request()->is('member/dashboard') ? 'active' : '' }}">Dashboard</a>
            
            <a href="/member/data-saya" class="{{ request()->is('member/data-saya') ? 'active' : '' }}">Data Saya</a>
            
            <a href="/member/rekap-absensi" class="{{ request()->is('member/rekap-absensi') ? 'active' : '' }}">Rekap Absensi</a>
            
            <a href="/logout">Logout</a>
        </nav>
    </aside>

    <main class="member-content">
        <div class="member-topbar">
            ⚪ {{ $user->name }} </div>

        <div class="member-title">Dashboard</div>

        <i style="color: #666;"><b>Welcome to Independent Muaythai Training Camp !!!</b></i>

        <div class="member-info-container">
            <div class="member-info-box">
                Sisa Token 🥊
                <div class="value">{{ $user->paket == 'unlimited' ? '∞' : $user->sisa }}</div>
            </div>
            
            <div class="member-info-box">
                Masa Aktif
                <div class="value">{{ \Carbon\Carbon::parse($user->masa_aktif)->format('d/m/Y') }}</div>
            </div>
            
            <div class="member-info-box">
                Total Hadir ({{ now()->format('F') }})
                <div class="value">{{ $totalKehadiranBulanIni }}</div>
            </div>
        </div>

        <div style="font-size:18px; font-weight:bold; margin-bottom:10px; margin-top: 30px;">
            Riwayat Kehadiran Terakhir
        </div>

        <table class="member-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jam Absen</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayatTerbaru as $index => $absen)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($absen->waktu_absen)->translatedFormat('d F Y') }}</td>
                    <td style="color: #ff0000; font-weight: bold;">
                        {{ \Carbon\Carbon::parse($absen->waktu_absen)->format('H:i') }} WIB
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center; color: #888; padding: 20px;">
                        Belum ada riwayat latihan bulan ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </main>
</div>

</body>
</html>