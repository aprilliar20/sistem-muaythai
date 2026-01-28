<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absensi</title>
    <link rel="stylesheet" href="/assets/css/style.css">
   
</head>
<body>

<div class="layout">

    <aside class="sidebar">
        <h2>Camp Muaythai<br>Independent</h2>
        <nav>
            <a href="/dashboard">Dashboard</a>
            <a href="/member">Member</a>
            <a href="/rekap" class="active">Rekap Absensi</a>
            <a href="/logout">Logout</a>
        </nav>
    </aside>

    <main class="content">
        <div class="topbar">
            <span class="admin-label">⚪ Admin</span>
        </div>

        <h3>Rekap Absensi</h3>

        <form action="{{ route('rekap.index') }}" method="GET" class="filter-container">
            <input type="text" name="search" placeholder="Cari member..." value="{{ request('search') }}" class="filter-input" style="flex: 1;">

            <select name="bulan" class="filter-input">
                <option value="">Bulan</option>
                @for ($m=1; $m<=12; $m++)
                    <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                        {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                    </option>
                @endfor
            </select>

            <select name="tahun" class="filter-input">
                <option value="">Tahun</option>
                @for ($y = date('Y'); $y >= 2024; $y--)
                    <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>

            <button type="submit" class="btn-filter">Filter</button>
            
            @if(request('search') || request('bulan') || request('tahun'))
                <a href="{{ route('rekap.index') }}" class="btn-reset">Reset</a>
            @endif
        </form>

        <table class="member-table" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Paket</th>
                    <th>Sisa Sesi</th>
                    <th>Tanggal</th>
                    <th>Jam Absen</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dataAbsen as $index => $absen)
                <tr>
                    <td>{{ ($dataAbsen->currentPage() - 1) * $dataAbsen->perPage() + $loop->iteration }}</td>
                    <td>{{ $absen->user->name ?? 'Member Terhapus' }}</td>
                    <td>{{ ucfirst($absen->user->paket ?? '-') }}</td>
                    <td>
                        @if(($absen->user->paket ?? '') == 'unlimited')
                            Unlimited
                        @else
                            {{ $absen->user->sisa ?? 0 }}
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($absen->waktu_absen)->format('d/m/Y') }}</td>
                    <td style="font-weight: bold; color: #cc0000;">
                        {{ \Carbon\Carbon::parse($absen->waktu_absen)->format('H:i') }} WIB
                    </td>
                    <td>
                        <span class="badge {{ ($absen->user->status ?? 0) == 1 ? 'aktif' : 'nonaktif' }}">
                            {{ ($absen->user->status ?? 0) == 1 ? 'Aktif' : 'Non Aktif' }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 30px; color: #888;">
                        🔍 Tidak ada data absensi yang ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

       <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div style="color: #666;">
        Menampilkan <strong>{{ $dataAbsen->firstItem() }}</strong> sampai <strong>{{ $dataAbsen->lastItem() }}</strong> dari <strong>{{ $dataAbsen->total() }}</strong> data
    </div>

    <div class="pagination-links">
        {{ $dataAbsen->links() }}
    </div>
</div>

    </main>
</div>

</body>
</html>