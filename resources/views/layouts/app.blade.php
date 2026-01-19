<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camp Muaythai Independent</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <h2>Camp Muaythai Independent</h2>
            <nav>
                <a href="/dashboard">Dashboard</a>
                <a href="/member" class="active">Member</a>
                <a href="/rekap">Rekap Absensi</a>
                <a href="/logout">Logout</a>
            </nav>
        </aside>

        <main class="content">
            <div class="topbar">
                <span class="admin-label">Admin</span>
            </div>
            
            @yield('content')
        </main>
    </div>
</body>
</html>
