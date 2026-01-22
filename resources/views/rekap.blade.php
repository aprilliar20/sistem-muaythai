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
                    <th>QR Code</th>
                    <th>Paket</th>
                    <th>Sisa</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td><td>April</td><td><a href="#">A123421</a></td><td>Reguler</td><td>5</td><td>20/08/2025</td>
                    <td><span class="badge aktif">Aktif</span></td>
                </tr>
                <tr>
                    <td>2</td><td>Lala</td><td><a href="#">A772727</a></td><td>Unlimited</td><td>-</td><td>20/08/2025</td>
                    <td><span class="badge aktif">Aktif</span></td>
                </tr>
                <tr>
                    <td>3</td><td>Alex</td><td><a href="#">A901922</a></td><td>Unlimited</td><td>-</td><td>19/08/2025</td>
                    <td><span class="badge aktif">Aktif</span></td>
                </tr>
            </tbody>
        </table>

        <!-- FOOTER INFO -->
        <div class="info-row">
            Menampilkan 3 dari 50 member
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
