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
                <h4>32</h4>
            </div>
            <div class="card">
                <p>Reguler</p>
                <h4>20</h4>
            </div>
            <div class="card">
                <p>Unlimited</p>
                <h4>12</h4>
            </div>
            <div class="card">
                <p>Absensi Hari Ini</p>
                <h4>12</h4>
            </div>
        </div>

        <!-- SCAN BUTTON -->
        <button class="scan-btn">Scan QR Absen ></button>

        <!-- TABLE -->
        <h3>Absen Hari Ini</h3>

        <table class="absen-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Member</th>
                    <th>Tanggal</th>
                    <th>Jam Absen</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td><td>April</td><td>20/04/2025</td><td>10.00</td>
                </tr>
                <tr>
                    <td>2</td><td>Lala</td><td>20/04/2025</td><td>10.00</td>
                </tr>
                <tr>
                    <td>3</td><td>Alex</td><td>20/04/2025</td><td>10.00</td>
                </tr>
            </tbody>
        </table>

    </main>
</div>

</body>
</html>
