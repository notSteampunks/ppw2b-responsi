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
<a class="navbar-brand" href="javascript:;">Detail Homestay</a>
@endsection

<!-- content -->
@section('content')
<section id="album" class="py-1 text-center bg-light">
    <div class="container">
        <h2>Gallery : {{ $albums->nama }}</h2>
        <hr>
        <div class="row justify-content-center">
            @foreach ($galeris as $data)
            <div class="col-md-4">
                <a href="{{ asset('images/'.$data->foto) }}" data-lightbox="image-1"data-title="{{ $data->keterangan }}">
                <img src="{{ asset('images/'.$data->foto) }}" style="width:150px; height:150px;"></a>
                <p>
                    <h5>{{ $data->nama_galeri }}</h5>
                </p>
            </div>
            @endforeach
            <div>{{ $galeris->links() }}</div>
        </div>
</section>
<div class="card my-4">
    <h5 class="card-header">Leave Comments</h5>
    <div class="card-body">
        <form method="post" action="{{ route('detail.komentar', $albums->id) }}">
            @csrf
            <div class="coment-bottom bg-white p-2 px-4">
                <div class="d-flex flex-row add-comment-section mt-4 mb-4">
                    <input type="text" class="form-control mr-3" placeholder="leave Comment" name="comment">
                    <input class="btn btn-primary" type="submit"></input>
                </div>
            </div>
        </form>
        @if (count($post) != 0)
        @foreach ($post as $komen)
        <div class="card py-3 px-3 text-left mb-3" style="background-color: #242424; color:white;">
            <div class="card-title">{{ $komen->user->name }}</div>
            <div class="card-text">Komentar : {{ $komen->comment }}</div>
        </div>
        @endforeach
        @else
        <p class="text-center lead w-100 text-info">There is no comment</p>
        @endif
    </div>
</div>
@endsection
