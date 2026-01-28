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
        <h4>{{ $absenHariIni->count() }}</h4>
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
