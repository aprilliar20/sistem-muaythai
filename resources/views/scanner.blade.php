<!DOCTYPE html>
<html lang="id">
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <meta charset="UTF-8">
    <title>Scanner Absensi Muaythai</title>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <style>
        body { background: #000; color: white; text-align: center; font-family: sans-serif; }
        #reader { width: 100%; max-width: 450px; margin: 20px auto; border: 4px solid #cc0000; border-radius: 10px; }
        #result { margin-top: 20px; font-weight: bold; color: yellow; }
    </style>
</head>
<body>
    <h2>SCAN QR ABSENSI</h2>
    <div id="reader"></div>
    <div id="result">Mencari QR Code...</div>
    <br>
    <a href="/dashboard" style="color: white;"> Kembali</a>

    <script>
    function onScanSuccess(decodedText, decodedResult) {
        // Tampilkan loading atau pesan deteksi
        document.getElementById('result').innerText = "Terdeteksi ID: " + decodedText;

        fetch("{{ route('proses.absen') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ user_id: decodedText })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Jika Berhasil (Status Aktif & Sesi Ada)
                alert("BERHASIL: " + data.message);
                window.location.href = "{{ route('rekap.index') }}"; // Langsung ke halaman rekap
            } else {
                // Jika Gagal (Status Non-Aktif atau Sisa Sesi Habis)
                // Pesan ini diambil dari 'message' yang kita buat di Controller
                alert("GAGAL: " + data.message);
                
                // Restart scanner supaya bisa scan ulang tanpa refresh
                setTimeout(() => {
                    location.reload();
                }, 100);
            }
        })
        .catch(err => {
            console.error(err);
            alert("Terjadi kesalahan koneksi ke server.");
        });

        html5QrcodeScanner.clear();
    }

    // Konfigurasi Scanner
    let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", 
    { 
        fps: 60, // Kita naikkan dari 10 ke 30 supaya lebih responsif
        qrbox: { width: 250, height: 250 }, // Kotak scan diperbesar
        aspectRatio: 1.0,
        disableFlip: false,
        experimentalFeatures: {
            useBarCodeDetectorIfSupported: true // Mencoba fitur deteksi bawaan browser jika ada
        }
    }
);
    html5QrcodeScanner.render(onScanSuccess);
    function onScanFailure(error) {
    // Biarkan kosong, jangan pakai console.warn karena bikin lemot
}
</script>
</body>
</html>