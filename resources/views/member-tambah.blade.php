@extends('layouts.app')

@section('content')

<h2 style="margin-bottom: 15px;">Tambah Member</h2>

{{-- Tambahkan ini untuk melihat error jika ada --}}
@if ($errors->any())
    <div style="background: #ff4a4a; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('member.store') }}" method="POST">
    @csrf
    <div class="edit-member-container">
        <div class="form-grid">
            <div class="form-column">
                <label>Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Member">

                <label>No HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="081234567890">

                <label>Paket</label>
                <select name="paket" id="paket" required>
                    <option value="" disabled {{ old('paket') ? '' : 'selected' }}>-- Pilih Paket --</option>
                    <option value="unlimited" {{ old('paket') == 'unlimited' ? 'selected' : '' }}>Unlimited</option>
                    <option value="reguler" {{ old('paket') == 'reguler' ? 'selected' : '' }}>Reguler</option>
                </select>

                <label>Sisa</label>
                <input type="number" name="sisa" value="{{ old('sisa', 0) }}">
            </div>

            <div class="form-column">
                <label>Masa Aktif</label>
                <input type="date" name="masa_aktif" value="{{ old('masa_aktif') }}">

                <label>Status</label>
                <select name="status" required>
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Non Aktif</option>
                </select>

                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="emailmember@gmail.com">

                <label>Password</label>
                <input type="password" name="password" placeholder="password">
                
                {{-- Tambahkan role secara otomatis sebagai member --}}
                <input type="hidden" name="role" value="member">
            </div>
        </div>
        <button type="submit" class="btn-save" style="margin-top: 20px;">Simpan</button>
    </div>
</form>

@endsection
