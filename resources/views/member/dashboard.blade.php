<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Member</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<div class="member-layout">

    <!-- SIDEBAR -->
    <aside class="member-sidebar">
        <h2>Camp Muaythai<br>Independent</h2>
        <nav>
            <a href="/member/dashboard" class="active">Dashboard</a>
            <a href="/member/data-saya">Data Saya</a>
            <a href="/member/rekap-absensi">Rekap Absensi</a>
            <a href="/logout">Logout</a>
        </nav>
    </aside>

    <!-- CONTENT -->
    <main class="member-content">
        <div class="member-topbar">
            ⚪ April
        </div>

        <div class="member-title">Dashboard</div>

        <i><b>Welcome to Independent Muaythai Training Camp !!!</b></i>

        <div class="member-info-container">
            <div class="member-info-box">
                Sisa Token
                <div class="value">1</div>
            </div>
            <div class="member-info-box">
                Masa Aktif
                <div class="value">12/08/2025</div>
            </div>
            <div class="member-info-box">
                Total Kehadiran Bulan Ini
                <div class="value">12</div>
            </div>
        </div>

        <div style="font-size:18px; font-weight:bold; margin-bottom:10px;">
            Riwayat Kehadiran
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
                <tr>
                    <td>1</td>
                    <td>20/04/2025</td>
                    <td>10.00</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>20/04/2025</td>
                    <td>10.00</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>20/04/2025</td>
                    <td>10.00</td>
                </tr>
            </tbody>
        </table>

    </main>
</div>

</body>
</html>
