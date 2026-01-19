<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Member</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2>Camp Muaythai<br>Independent</h2>
        <nav>
            <a href="/dashboard">Dashboard</a>
            <a href="/member" class="active">Member</a>
            <a href="/rekap">Rekap Absensi</a>
            <a href="/logout">Logout</a>
        </nav>
    </aside>

    <!-- CONTENT -->
    <main class="content">
        <div class="topbar">
            <span class="admin-label">⚪ Admin</span>
        </div>

        <h3>Member</h3>

        <!-- SEARCH + ADD BUTTON -->
        <div class="member-actions">
            <input type="text" class="search-input" placeholder="Cari member...">
            <button class="btn-add">+ Tambah Member</button>
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
                    <th>Masa Aktif</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td><td>April</td><td><a href="#">A123421</a></td><td>Reguler</td><td>5</td><td>20/08/2025</td>
                    <td><span class="badge nonaktif">Non Aktif</span></td>
                    <td>
                        <span class="icon-btn">✏️</span>
                        <span class="icon-btn">🗑️</span>
                    </td>
                </tr>
                <tr>
                    <td>2</td><td>Lala</td><td><a href="#">A772727</a></td><td>Unlimited</td><td>-</td><td>25/08/2025</td>
                    <td><span class="badge aktif">Aktif</span></td>
                    <td>
                        <span class="icon-btn">✏️</span>
                        <span class="icon-btn">🗑️</span>
                    </td>
                </tr>
                <tr>
                    <td>3</td><td>Alex</td><td><a href="#">A901922</a></td><td>Unlimited</td><td>-</td><td>19/08/2025</td>
                    <td><span class="badge aktif">Aktif</span></td>
                    <td>
                        <span class="icon-btn">✏️</span>
                        <span class="icon-btn">🗑️</span>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- FOOTNOTE -->
        <div class="info-row">
            Menampilkan 10 dari 10 member
        </div>

        <!-- PAGINATION -->
        <div class="pagination">
            <span class="page-number active">1</span>
            <span class="page-number disabled">2</span>
            <span class="page-number disabled">3</span>
        </div>

    </main>

</div>

</body>
</html>
