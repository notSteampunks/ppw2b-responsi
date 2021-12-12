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
    <li>
        <a href="/listhomestay">
            <i class="nc-icon nc-diamond"></i>
            <p>List Homestay</p>
        </a>
    </li>
    <li class="active ">
        <a href="/galerihomestay">
            <i class="nc-icon nc-pin-3"></i>
            <p>Gallery Homestay</p>
        </a>
    </li>
    <li>
        <a href="/user">
            <i class="nc-icon nc-pin-3"></i>
            <p>List User</p>
        </a>
    </li>
</ul>
@endsection

<!-- title -->
@section('title')
<a class="navbar-brand">Create Gallery Homestay</a>
@endsection

<!-- content -->
@section('content')
<form method="POST" action="{{ route('galeri.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="nama_galeri" class="form-label">Galery Name</label>
        <input type="text" name="nama_galeri" class="form-control">
    </div>
    <div class="mb-3">
        <label for="id_homestay" class="form-label">Choose Homestay</label>
        <select name="id_homestay" class="form-control">
                <option value="" selected> Choose Homestay </option>
                @foreach ($homestay as $data)
                    <option value="{{ $data->id }}">{{ $data->nama }} </option>
                @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="keterangan"> Description </label>
        <textarea name="keterangan" class="form-control"></textarea>
        </div>
    <div class="mb-3">
        <label for="foto" class="form-label">Images</label>
        <input type="file" name="foto" class="form-control">
    </div>
    <!-- button simpan dan batal -->
    <button type="submit" class="btn btn-primary">Save</button>
    <a class="btn btn-danger" href="/galerihomestay">Cancel</a>
</form>
@endsection