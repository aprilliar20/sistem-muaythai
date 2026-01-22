<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absensi</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<div class="member-layout">

    <!-- SIDEBAR -->
    <aside class="member-sidebar">
        <h2>Camp Muaythai<br>Independent</h2>
        <nav>
            <a href="/member/dashboard">Dashboard</a>
            <a href="/member/data-saya">Data Saya</a>
            <a href="/member/rekap-absensi" class="active">Rekap Absensi</a>
            <a href="/logout">Logout</a>
        </nav>
    </aside>

    <!-- CONTENT -->
    <main class="member-content">
        <div class="member-topbar">⚪ April</div>

        <div class="member-title">Rekap Absensi</div>

        <div class="attendance-card">

            <table class="attendance-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jam Absen</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>1</td><td>25/04/2025</td><td>10.00</td></tr>
                    <tr><td>2</td><td>22/04/2025</td><td>10.00</td></tr>
                    <tr><td>3</td><td>20/04/2025</td><td>10.00</td></tr>
                    <tr><td>4</td><td>10/04/2025</td><td>10.00</td></tr>
                    <tr><td>5</td><td>09/04/2025</td><td>10.00</td></tr>
                    <tr><td>6</td><td>05/04/2025</td><td>10.00</td></tr>
                </tbody>
            </table>

            <div class="pagination-member">
                <span class="page disabled">←</span>
                <span class="page active">1</span>
                <span class="page disabled">→</span>
            </div>

        </div>

    </main>

</div>

</body>
</html>
