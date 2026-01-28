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
    <form action="{{ route('member.index') }}" method="GET" style="display: flex; gap: 10px;">
        <input type="text" 
               name="search" 
               class="search-input" 
               placeholder="Cari member..." 
               value="{{ request('search') }}">
        <button type="submit" class="btn-add">Cari</button>
        
        {{-- Tombol reset untuk kembali ke semua data --}}
        @if(request('search'))
            <a href="{{ route('member.index') }}" class="btn-add" style="background: #555;">Reset</a>
        @endif
    </form>
    
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
            @forelse($members as $index => $member)
                <tr>
                    {{-- Rumus agar nomor urut mengikuti halaman dan hasil pencarian --}}
                    <td>{{ ($members->currentPage() - 1) * $members->perPage() + $loop->iteration }}</td>
                    <td>{{ $member->name }}</td>
                    <td>
                        <div style="background: white; padding: 5px; display: inline-block;">
                            {!! QrCode::size(50)->generate($member->id) !!}
                        </div>
                    </td>
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
            Menampilkan {{ $members->firstItem() }} sampai {{ $members->lastItem() }} dari {{ $members->total() }} member
        </div>

        <!-- PAGINATION -->
        <div class="pagination">
    {{ $members->links() }}
</div>

    </main>

</div>

</body>
</html>

