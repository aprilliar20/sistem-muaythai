@extends('layouts.app')

@section('content')

<div class="edit-member-container">
    <h2>Edit Member</h2>
<form action="{{route('member.update',$user)}}" method="post">
    <div class="form-grid">
        @csrf @method('put')

        <div class="form-column">
            <label>Nama</label>
            <input name="name" type="text" value="{{ $user->name }} ">

            <label>No HP</label>
            <input name="no_hp" type="text" value="{{ $user->no_hp }}">

            <label>Paket</label>
  <select name="paket" id="cars">
    <option {{ $user->paket =='unlimited'?'selected':"" }} value="unlimited">Unlimited</option>
    <option {{ $user->paket =='reguler'?'selected':"" }} value="reguler">Reguler</option>
  </select>

            <label>Sisa</label>
            <input name="sisa" type="number" value="{{ $user->sisa }}">
        </div>

        <div class="form-column">
            <label>Masa Aktif</label>
            <input name="masa_aktif" type="date" value="{{ $user->masa_aktif }}">

            <label>Status</label>
           <select name="status" id="cars">
    <option {{ $user->status ?'selected':"" }} value="aktif">Aktif</option>
    <option {{ $user->status ?'selected':"" }} value="non aktif">Non Aktif</option>
  </select>

            <label>Email</label>
            <input name="email" type="email" value="{{ $user->email }}">

            <label>Password</label>
            <input name="password" type="password" value="{{ $user->password }}">

            <label>QR Code</label>
            <a href="#" class="qr-link">A123421</a>
        </div>
    </div>

    <button type="submit" class="btn-save">Simpan</button>
    </form>
</div>

@endsection



