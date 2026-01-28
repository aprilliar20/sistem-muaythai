<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Saya</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<div class="member-layout">

    <aside class="member-sidebar">
        <h2>Camp Muaythai<br>Independent</h2>
        <nav>
            <a href="/member/dashboard">Dashboard</a>
            <a href="/member/data-saya" class="active">Data Saya</a>
            <a href="/member/rekap-absensi">Rekap Absensi</a>
            <a href="/logout">Logout</a>
        </nav>
    </aside>

    <main class="member-content">
        {{-- Nama di topbar ambil dari user yang login --}}
        <div class="member-topbar">⚪ {{ $user->name }}</div>

        <div class="member-title">Data Saya</div>

        <div class="data-card">

            <div class="form-row">
                <div class="form-col">
                    <label>Nama</label>
                    <input type="text" value="{{ $user->name }}" disabled class="disabled-input">
                </div>
                <div class="form-col">
                    <label>Masa Aktif</label>
                    {{-- Format tanggal ke d/m/Y --}}
                    <input type="text" value="{{ \Carbon\Carbon::parse($user->masa_aktif)->format('d/m/Y') }}" disabled class="disabled-input">
                </div>
                <div class="form-col">
    <label>QR Code Absen</label><br>
    
    <div id="qrcode-container" style="display:none;">
        {!! QrCode::size(300)->generate($user->id) !!}
    </div>

    <a href="javascript:void(0)" onclick="downloadQR()" style="color: #0000EE; text-decoration: underline; font-weight: bold; cursor: pointer;">
        {{ $user->id }} (Klik untuk Download)
    </a>
</div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label>No HP</label>
                    <input type="text" value="{{ $user->no_hp }}" disabled class="disabled-input">
                </div>
                <div class="form-col">
                    <label>Status</label>
                    @if($user->status == 1)
                        <span class="badge aktif">Aktif</span>
                    @else
                        <span class="badge nonaktif">Non Aktif</span>
                    @endif
                </div>
                <div class="form-col">
                    <label>Email</label>
                    <input type="text" value="{{ $user->email }}" disabled class="disabled-input">
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label>Paket</label><br>
                    <span class="badge paket">{{ ucfirst($user->paket) }}</span>
                </div>
                <div class="form-col">
                    <label>Sisa Sesi</label>
                    <input type="text" value="{{ $user->sisa }}" disabled class="disabled-input" style="width: 60px;">
                </div>
                <div class="form-col">
                    <label>Password</label>
                    {{-- Password tidak ditampilkan demi keamanan, tampilkan asteris saja --}}
                    <input type="password" value="********" disabled class="disabled-input">
                    <small style="display:block; color: #ccc; margin-top: 5px;">Hubungi admin untuk ganti password</small>
                </div>
            </div>

        </div>
    </main>

</div>

<script>
function downloadQR() {
    // 1. Ambil elemen SVG-nya
    const svg = document.querySelector('#qrcode-container svg');
    const svgData = new XMLSerializer().serializeToString(svg);
    
    // 2. Buat kanvas untuk menggambar
    const canvas = document.createElement("canvas");
    const ctx = canvas.getContext("2d");
    const img = new Image();
    
    // 3. Proses konversi
    img.onload = function() {
        canvas.width = img.width;
        canvas.height = img.height;
        ctx.drawImage(img, 0, 0);
        
        // 4. Trigger download
        const pngFile = canvas.toDataURL("image/png");
        const downloadLink = document.createElement("a");
        downloadLink.download = "QR_Absen_{{ $user->name }}.png";
        downloadLink.href = pngFile;
        downloadLink.click();
    };

    // Encode SVG ke Base64 supaya bisa dibaca Image object
    img.src = "data:image/svg+xml;base64," + btoa(unescape(encodeURIComponent(svgData)));
}
</script>

</body>
</html>
