@extends('layout.master')

<!-- activebar -->
@section('activebar')
<ul class="nav">
    <li>
        <a href="/home">
            <i class="nc-icon nc-bank"></i>
            <p>Dashboard</p>
        </a>
    </li>
    @if(Auth::check() && Auth::user()->level == 'admin')
    <li class="active ">
        <a href="/listhomestay">
            <i class="nc-icon nc-tile-56"></i>
            <p>List Homestay</p>
        </a>
    </li>
    @endif
    @if(Auth::check() && Auth::user()->level == 'admin')
    <li>
        <a href="/galerihomestay">
            <i class="nc-icon nc-album-2"></i>
            <p>Gallery Homestay</p>
        </a>
    </li>
    @endif
    @if(Auth::check() && Auth::user()->level == 'admin')
    <li>
        <a href="/user">
            <i class="nc-icon nc-touch-id"></i>
            <p>List User</p>
        </a>
    </li>
    @endif
</ul>
@endsection

<!-- title -->
@section('title')
<a class="navbar-brand">Create Homestay</a>
@endsection

<!-- content -->
@section('content')
@if (count($errors) > 0 )
<ul class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif
<form method="POST" action="{{ route('list.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="inputNama" class="form-label">Homestay Name</label>
        <input type="text" name="nama" class="form-control">
    </div>
    <div class="mb-3">
        <label for="foto" class="form-label">Images</label>
        <input type="file" name="foto" class="form-control">
    </div>
    <div class="mb-3">
        <label for="inputLokasi" class="form-label">Location</label>
        <input type="text" name="lokasi" class="form-control">
    </div>
    <div class="mb-3">
        <label for="inputHarga" class="form-label">Price</label>
        <input type="text" name="harga" class="form-control">
    </div>
    <div class="mb-3">
        <label for="inputTglTerbit" class="form-label">Date</label>
        <input type="date" id="tgl_terbit" name="tgl_terbit" class="date form-control" placeholder="dd/mm/yyyy">
    </div>

    <!-- button simpan dan batal -->
    <button type="submit" class="btn btn-primary">Save</button>
    <a class="btn btn-danger" href="/listhomestay">Cancel</a>
</form>
@endsection