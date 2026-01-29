<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2>Camp Muaythai<br>Independent</h2>
        <nav>
            <a href="#" class="active">Dashboard</a>
            <a href="/member">Member</a>
            <a href="/rekap">Rekap Absensi</a>
            <a href="/login">Logout</a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="content">
        <div class="topbar">
            <span class="admin-label">⚪ Admin</span>
        </div>

        <h3>Dashboard</h3>

        <!-- CARDS -->
        <div class="card-container">
    <div class="card">
        <p>Total Member</p>
        <h4>{{ $totalMember }}</h4>
    </div>
    <div class="card">
        <p>Reguler</p>
        <h4>{{ $reguler }}</h4>
    </div>
    <div class="card">
        <p>Unlimited</p>
        <h4>{{ $unlimited }}</h4>
    </div>
    <div class="card">
        <p>Absensi Hari Ini</p>
        <h4>{{ $semuaAbsenHariIni->count() }}</h4>
    </div>
</div>

        <!-- SCAN BUTTON -->
        <div style="margin: 40px 0; text-align: center;">
    <a href="{{ route('tampil.scanner') }}" class="btn-scan-huge">
        <div class="icon-circle">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3Zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5ZM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5Zm15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5ZM4 4h1v1H4V4Z"/>
                <path d="M7 2H2v5h5V2ZM3 3h3v3H3V3Zm2 8H4v1h1v-1Z"/>
                <path d="M7 9H2v5h5V9ZM3 10h3v3H3v-3Zm8-8h5v5h-5V2Zm1 1v3h3V3h-3ZM9 9h6v6H9V9Zm1 1v4h4v-4h-4Z"/>
            </svg>
        </div>
        <span>Scan QR Absensi Member</span>
    </a>
</div>

        <!-- TABLE -->
        <div class="card-table" style="margin-top: 30px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h4 style="margin: 0; color: #333;">🔥 Member Latihan Hari Ini</h4>
                <span style="background: #ffe5e5; color: #cc0000; padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                    {{ $semuaAbsenHariIni->count() }} Orang
                </span>
            </div>

            <table class="member-table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; border-bottom: 2px solid #f4f4f4;">
                        <th style="padding: 10px; color: #333;">Jam</th>
                        <th style="padding: 10px; color: #333;">Nama Member</th>
                        <th style="padding: 10px; color: #333;">Paket</th>
                        <th style="padding: 10px; color: #333;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absenLimit as $absen)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px; color: #cc0000 !important; font-weight: bold;">
                            {{ \Carbon\Carbon::parse($absen->waktu_absen)->format('H:i') }}
                        </td>
                        <td style="padding: 10px; color: #333 !important;">
                            {{ $absen->user->name ?? 'User' }}
                        </td>
                        <td style="padding: 10px; color: #333 !important;">
                            <span style="background: #eee; padding: 3px 8px; border-radius: 5px; font-size: 11px; color: #333;">
                                {{ ucfirst($absen->user->paket ?? '-') }}
                            </span>
                        </td>
                        <td style="padding: 10px;">
                            <span class="badge aktif" style="font-size: 11px; background: #28a745; color: white; padding: 3px 8px; border-radius: 4px;">Hadir</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 20px; color: #999;">
                            Belum ada member yang scan pagi ini. Yuk, semangat! 🥊
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div style="margin-top: 15px; text-align: center;">
                <a href="/rekap" style="text-decoration: none; color: #666; font-size: 13px; font-weight: bold;">Lihat Semua Riwayat →</a>
            </div>
        </div>
    </main>
</div>

</body>
</html>
