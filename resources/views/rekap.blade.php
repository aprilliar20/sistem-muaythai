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

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2>Camp Muaythai<br>Independent</h2>
        <nav>
            <a href="/dashboard">Dashboard</a>
            <a href="/member">Member</a>
            <a href="/rekap" class="active">Rekap Absensi</a>
            <a href="/logout">Logout</a>
        </nav>
    </aside>

    <!-- CONTENT -->
    <main class="content">
        <div class="topbar">
            <span class="admin-label">⚪ Admin</span>
        </div>

        <h3>Rekap Absensi</h3>

        <!-- FILTER -->
        <div class="filter-row">
            <input type="text" class="search-input" placeholder="Cari member...">
            <select class="select-month">
                <option>Jan</option><option>Feb</option><option>Mar</option><option>Apr</option>
                <option>May</option><option>Jun</option><option>Jul</option><option>Aug</option>
                <option>Sep</option><option>Oct</option><option>Nov</option><option>Dec</option>
            </select>
            <select class="select-year">
                <option>2024</option>
                <option selected>2025</option>
                <option>2026</option>
            </select>
        </div>

        <!-- TABLE -->
       <table class="member-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Paket</th>
            <th>Sisa</th>
            <th>Tanggal</th>
            <th>Jam Absen</th> <th>Status</th>
        </tr>
    </thead>
   <tbody>
    @forelse($dataAbsen as $index => $absen)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $absen->user->name ?? 'Member Terhapus' }}</td>
        <td>{{ ucfirst($absen->user->paket ?? '-') }}</td>
        <td>{{ ($absen->user && $absen->user->paket == 'unlimited') ? '-' : ($absen->user->sisa ?? '-') }}</td>
        {{-- Mengambil Tanggal dari waktu_absen --}}
        <td>{{ \Carbon\Carbon::parse($absen->waktu_absen)->format('d/m/Y') }}</td>
        {{-- Mengambil Jam dari waktu_absen --}}
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
        <td colspan="8" style="text-align: center;">Belum ada data absensi hari ini.</td>
    </tr>
    @endforelse
</tbody>
</table>

        <!-- FOOTER INFO -->
        <div class="info-row">
    Menampilkan {{ $dataAbsen->count() }} data absensi
</div>

        <!-- PAGINATION -->
        <div class="pagination">
            <span class="page-number active">1</span>
            <span class="page-number disabled">2</span>
            <span class="page-number disabled">3</span>
            <span class="page-arrow">➜</span>
        </div>

    </main>
</div>

</body>
</html>
