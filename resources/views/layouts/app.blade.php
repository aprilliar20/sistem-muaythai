<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Camp Muaythai Independent' }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body>

    <div class="layout">

        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Camp Muaythai</h2>
            <nav>
                <a href="/dashboard">Dashboard</a>
                <a href="/member">Kelola Member</a>
                <a href="/absen">Rekap Absensi</a>
                <a href="/logout">Logout</a>
            </nav>
        </div>

        <!-- Content -->
        <div class="content">
            @yield('content')
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
function setPaket(value) {
    document.getElementById("paket").value = value;
    document.querySelectorAll(".paket-btn").forEach(btn => btn.classList.remove("active"));
    document.querySelectorAll(".paket-btn").forEach(btn => btn.classList.add("inactive"));
    event.target.classList.add("active");
}
</script>

</body>

</html>
