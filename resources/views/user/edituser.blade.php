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
    <li>
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
    <li class="active ">
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
<form method="POST" action="{{ route('user.update', $data_user->id) }}">
    @csrf
    <div class="mb-3">
        <label for="inputNama" class="form-label">Name</label>
        <input type="text" name="nama" class="form-control" value="{{$data_user->name}}">
    </div>
    <div class="mb-3">
        <label for="inputEmail" class="form-label">Email</label>
        <input type="text" name="email" class="form-control" value="{{$data_user->email}}">
    </div>
    <div class="mb-3">
        <label for="inputLevel" class="form-label">Level</label>
        <input type="text" name="level" class="form-control" value="{{$data_user->level}}">
    </div>

    <!-- button simpan dan batal -->
    <button type="submit" class="btn btn-primary">Save</button>
    <a class="btn btn-danger" href="/user">Cancel</a>
</form>
@endsection
