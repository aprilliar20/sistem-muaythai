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
            <a href="{{ route('member.tambah') }}" class="btn-add">+ Tambah Member</a>
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
            @forelse($members as $member)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $member->name }}</td>
                    <td><a href="#">{{ $member->qr_code ?? '-' }}</a></td>
                    <td>{{ $member->paket ?? '-' }}</td>
                    <td>{{ $member->sisa ?? '-' }}</td>
                    <td>{{ $member->masa_aktif ?? '-' }}</td>

                   <td>
                @if($member->status == 1)
                    <span class="badge aktif">Aktif</span>
                @else
                    <span class="badge nonaktif">Non Aktif</span>
                @endif
            </td>


                    <td>
                        <a href="{{ route('member.edit', $member->id) }}" class="icon-btn">✏️</a>

                        <form action="{{ route('member.destroy', $member->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="icon-btn" style="border:none; background:none; cursor:pointer;">🗑️</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center;">Belum ada member</td>
                </tr>
            @endforelse
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

