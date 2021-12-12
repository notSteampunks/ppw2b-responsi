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
<a class="navbar-brand" href="javascript:;">Homestay</a>
@endsection

<!-- content -->
@section('content')
<div class="row mt-3">
    @foreach ($albums as $homestay)
    <div class="col-md-4">
        <div class="card">
            <a href="/detail-homestay/{{ $homestay->gambar_seo }}">
                <img src="{{ asset('thumb/'.$homestay->foto) }}" class="card-img-top" alt="{{ $homestay->nama }}">
            </a>
            <div class="card-body">
                <h5 class="card-title mb-3">{{ $homestay->nama }}</h5>
                <a href="/detail-homestay/{{ $homestay->gambar_seo }}" class="btn btn-primary">
                    <i class="bi bi-eye"></i> Detail Homestay </a>
                <a href="{{ route ('like.foto', $homestay->id)}}" class="btn btn-outline-danger btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-heart" viewBox="0 0 16 16">
                        <path
                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                    </svg>
                    <i class="bi bi-heart"></i>Like</a>
                <span class="badge badge-light"> {{$homestay->like}} </span>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
