@extends('layouts.app')

@section('content')

<div class="edit-member-container">
    <h2>Edit Member</h2>

    <div class="form-grid">

        <div class="form-column">
            <label>Nama</label>
            <input type="text" value="Aprillia R">

            <label>No HP</label>
            <input type="text" value="08127382929">

            <label>Paket</label>
            <div class="paket-select">
                <span class="paket inactive">Unlimited</span>
                <span class="paket active">Reguler</span>
            </div>

            <label>Sisa</label>
            <input type="number" value="5">
        </div>

        <div class="form-column">
            <label>Masa Aktif</label>
            <input type="date" value="2025-08-20">

            <label>Status</label>
            <span class="status nonaktif">Non Aktif</span>

            <label>Email</label>
            <input type="email" value="ramanapril@gmail.com">

            <label>Password</label>
            <input type="password" value="april123#">

            <label>QR Code</label>
            <a href="#" class="qr-link">A123421</a>
        </div>
    </div>

    <button type="button" class="btn-save">Simpan</button>
</div>

@endsection



