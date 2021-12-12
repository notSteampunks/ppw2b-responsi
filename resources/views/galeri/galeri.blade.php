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
    <li class="active ">
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
<a class="navbar-brand" href="javascript:;">Gallery Homestay</a>
@endsection

<!-- content -->
@section('content')
<style>
container {
        padding: 2rem 0rem;
    }

    h4 {
        margin: 2rem 0rem 1rem;
    }

    .table-image {
        vertical-align: middle;
    }
</style>
<head>
    <!-- pesan sukses homestay berhasil ditambahkan, diupdate, dan dihapus -->
    @if(Session::has('success_added'))
        <div class="alert alert-success">{{Session::get('success_added')}}</div>
    @endif
    @if(Session::has('success_updated'))
        <div class="alert alert-primary">{{Session::get('success_updated')}}</div>
    @endif
	  @if(Session::has('success_deleted'))
      <div class="alert alert-danger">{{Session::get('success_deleted')}}</div>
    @endif
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-12">
		<table class="table table-image">
		  <thead>
		    <tr>
		      <th scope="col">NO</th>
		      <th scope="col">Galery Name</th>
		      <th scope="col">Homestay Name</th>
		      <th scope="col">Image</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
			@foreach ($galeri as $data)
			<tr>
				<td>{{ ++$no }}</td>
				<td>{{ $data->nama_galeri }}</td>
				<td>{{ $data->albums->nama }}</td>
                <td><img src="{{ asset('thumb/'.$data->foto) }}" style="width: 100px"></td>
                <td>
                <form>
                    <a href="#" class="btn btn-warning">
                    <i class="fa fa-pencil-alt"></i> Edit </a>
                    <button class="btn btn-danger">
                    <i class="fa fa-times"></i> Delete </button>
                </form>
                </td>
			</tr>
			@endforeach
		  </tbody>
		</table>   
    </div>
  </div>
    <!-- Button Tambah Homestay -->
    <p align="center"><a href="{{ route('galeri.create') }}" class="btn btn-success">Add Galery</a>
    <!-- pagination -->
    <div>{{ $galeri->links() }}</div>
</div>
</body>
@endsection
