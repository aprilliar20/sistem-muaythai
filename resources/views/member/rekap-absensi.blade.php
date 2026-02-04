<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absensi Saya</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        /* Sentuhan tema gelap khusus member agar tetap gahar */
        body { background-color: #0a0a0a; }
        .content { background-color: #0f0f0f; color: white; }
        h3 { color: white; margin-bottom: 20px; }
        .member-table th { background-color: #1a1a1a; color: #ff0000; }
        .member-table td { color: #ccc; border-bottom: 1px solid #222; }
        .member-table tr:hover { background-color: #151515; }
        .admin-label { background: #333; color: #fff; padding: 5px 15px; border-radius: 20px; font-size: 12px; }

        <style>
    /* Paksa layout untuk mengisi seluruh layar */
    html, body {
        height: 100%;
        margin: 0;
    }
    .member-layout {
        display: flex;
        min-height: 100vh;
    }
    .member-sidebar {
        min-height: 100vh;
        background-color: #c20000; /* Pastikan warnanya sama dengan sidebar dashboard */
    }
</style>
    </style>
</head>
<body>

<div class="layout">

    <aside class="member-sidebar">
        <h2>Camp Muaythai<br>Independent</h2>
        <nav>
            <a href="/member/dashboard">Dashboard</a>
            <a href="/member/data-saya">Data Saya</a>
            <a href="/member/rekap-absensi" class="active">Rekap Absensi</a>
            <a href="/logout">Logout</a>
        </nav>
    </aside>

    <main class="content">
        <div class="topbar">
            <span class="admin-label">⚪ Member: {{ Auth::user()->name }}</span>
        </div>

        <h3>🥊 Rekap Latihan Saya</h3>

        <form action="/member/rekap-absensi" method="GET" class="filter-container">
    <select name="bulan" class="filter-input">
        <option value="">Semua Bulan</option>
        @for ($m=1; $m<=12; $m++)
            <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
            </option>
        @endfor
    </select>

    <select name="tahun" class="filter-input">
        <option value="">Semua Tahun</option>
        @for ($y = date('Y'); $y >= 2024; $y--)
            <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
        @endfor
    </select>

    <button type="submit" class="btn-filter">Filter</button>
    
    @if(request('bulan') || request('tahun'))
        <a href="/member/rekap-absensi" class="btn-reset" style="color: red; margin-left: 10px; text-decoration: none;">Reset</a>
    @endif
</form>

        <table class="member-table" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jam Latihan</th>
                    <th>Paket</th>
                    <th>Sisa Token</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dataAbsen as $index => $absen)
                <tr>
                    <td>{{ ($dataAbsen->currentPage() - 1) * $dataAbsen->perPage() + $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($absen->waktu_absen)->translatedFormat('d F Y') }}</td>
                    <td style="font-weight: bold; color: #ff0000;">
                        {{ \Carbon\Carbon::parse($absen->waktu_absen)->format('H:i') }} WIB
                    </td>
                    <td>{{ ucfirst($absen->user->paket ?? '-') }}</td>
                    <td>
                        @if(strtolower($absen->user->paket) == 'unlimited')
                            <span class="badge paket">Unlimited</span>
                        @else
                            {{ $absen->sisa_sesi_snapshot ?? '-' }}
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 30px; color: #888;">
                        🔍 Belum ada riwayat latihan. Tetap semangat!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

       <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div style="color: #666; font-size: 14px;">
        Menampilkan <strong>{{ $dataAbsen->firstItem() ?? 0 }}</strong> - <strong>{{ $dataAbsen->lastItem() ?? 0 }}</strong> dari <strong>{{ $dataAbsen->total() }}</strong> data
    </div>

    <div class="pagination-links">
        {{ $dataAbsen->links() }}
    </div>
</div>

    </main>
</div>

</body>
</html>
