<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Saya</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        /* Tambahan CSS khusus untuk merapikan layout QR */
        .data-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap; /* Supaya kalau dibuka di HP otomatis numpuk ke bawah */
        }
        .info-section {
            flex: 2; /* Kolom data teks lebih lebar */
            min-width: 300px;
        }
        .qr-card-section {
            flex: 1; /* Kolom QR lebih ramping */
            min-width: 300px;
            background: #f9f9f9;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            border: 1px solid #eee;
        }
        .qr-wrapper {
            background: white;
            padding: 15px;
            display: inline-block;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 15px;
        }
        .screenshot-note {
            font-size: 12px;
            color: #666;
            font-style: italic;
            background: #fff3cd;
            padding: 8px;
            border-radius: 5px;
            display: block;
        }
    </style>
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
        <div class="member-topbar">⚪ {{ $user->name }}</div>
        <div class="member-title">Data Saya</div>

        <div class="data-card">
            <div class="data-container">
                
                <div class="info-section">
                    <div class="form-row">
                        <div class="form-col" style="width: 100%;">
                            <label>Nama Lengkap</label>
                            <input type="text" value="{{ $user->name }}" disabled class="disabled-input">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <label>No HP</label>
                            <input type="text" value="{{ $user->no_hp }}" disabled class="disabled-input">
                        </div>
                        <div class="form-col">
                            <label>Email</label>
                            <input type="text" value="{{ $user->email }}" disabled class="disabled-input">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <label>Paket</label><br>
                            <span class="badge paket" style="padding: 8px 15px; font-size: 14px;">{{ ucfirst($user->paket) }}</span>
                        </div>
                        <div class="form-col">
                            <label>Sisa Sesi</label>
                            <input type="text" value="{{ $user->paket == 'unlimited' ? '∞' : $user->sisa }}" disabled class="disabled-input" style="font-weight: bold; color: #cc0000;">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <label>Masa Aktif</label>
                            <input type="text" value="{{ \Carbon\Carbon::parse($user->masa_aktif)->format('d/m/Y') }}" disabled class="disabled-input">
                        </div>
                        <div class="form-col">
                            <label>Status Member</label><br>
                            <span class="badge {{ $user->status == 1 ? 'aktif' : 'nonaktif' }}">
                                {{ $user->status == 1 ? 'Aktif' : 'Non-Aktif' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="qr-card-section">
                    <h4 style="margin-top: 0; color: #333;">QR Code Absensi</h4>
                    <div class="qr-wrapper" id="qrcode-container">
                        {!! QrCode::size(220)->margin(1)->generate($user->id) !!}
                    </div>
                    
                    <span class="screenshot-note">
                        📸 <strong>PENTING:</strong> Silakan screenshot QR Code ini untuk memudahkan absensi saat di kasir tanpa harus login kembali.
                    </span>
                    
                    <div style="margin-top: 20px; text-align: left; font-size: 12px; color: #999; border-top: 1px dashed #ccc; padding-top: 10px;">
                        * ID Member: #{{ $user->id }}<br>
                        * Gunakan kecerahan layar maksimal saat scan.
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

</body>
</html>
