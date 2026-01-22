@extends('layouts.app')

@section('content')

<h2 style="margin-bottom: 15px;">Tambah Member</h2>

<div class="edit-member-container">

    <div class="form-grid">

        <!-- Kolom Kiri -->
        <div class="form-column">
            <label>Nama</label>
            <input type="text" placeholder="Nama Member">

            <label>No HP</label>
            <input type="text" placeholder="081234567890">

            <label>Paket</label>
          <div class="paket-select">
                <button type="button" class="paket-btn active" onclick="setPaket('Reguler')">Reguler</button>
                <button type="button" class="paket-btn inactive" onclick="setPaket('Unlimited')">Unlimited</button>
          </div>

<input type="hidden" name="paket" id="paket" value="Reguler">


            <label>Sisa</label>
            <input type="number" value="0">
        </div>

        <!-- Kolom Kanan -->
        <div class="form-column">
            <label>Masa Aktif</label>
            <input type="date">

            <label>Status</label>
            <span class="status aktif">Aktif</span>
            <input type="hidden" name="status" value="Aktif">


            <label>Email</label>
            <input type="email" placeholder="emailmember@gmail.com">

            <label>Password</label>
            <input type="password" placeholder="password">
        </div>

    </div>

    <button type="button" class="btn-save" style="margin-top: 20px;">Simpan</button>

</div>

@endsection
