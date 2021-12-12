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
<a class="navbar-brand" href="javascript:;">List Homestay</a>
@endsection

<!-- content -->
@section('content')
<style>
    .container {
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
    <!-- pesan sukses list homestay berhasil ditemukan -->
    @if(count($data_homestay))
    <div class="alert alert-success">Ditemukan <strong>{{count($data_homestay)}}</strong> data dengan kata: <strong>{{ $cari }}</strong></div>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-12">
		<table class="table table-image">
		  <thead>
		    <tr>
		      <th scope="col">ID</th>
		      <th scope="col">Images</th>
		      <th scope="col">Homestay Name</th>
		      <th scope="col">Location</th>
		      <th scope="col">Price</th>
		      <th scope="col">Date</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
			@foreach ($data_homestay as $homestay)
			<tr>
				<td>{{ $homestay->id }}</td>
				<td><img src="{{ asset('images/'.$homestay->foto) }}" style="width:75px; height:75px;"></td>
				<td>{{ $homestay->nama }}</td>
				<td>{{ $homestay->lokasi }}</td>
				<td>{{ number_format($homestay->harga,0, ',', '.') }}</td>
				<td>{{ Carbon\Carbon::parse($homestay->tgl_terbit)->format('d-m-Y') }}</td>
				<td>
            <form action="{{ route('list.destroy', $homestay->id) }}" method="post">@csrf
                <button type="button" class="btn btn-info">View</button>
                <a href="{{ route('list.edit', $homestay->id) }}" class="btn btn-warning">
                  <i class="fa fa-pencil-alt"></i> Edit </a>
                <button class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')">
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
    <p align="center"><a href="{{ route('list.create') }}" class="btn btn-success">Add Homestay</a>
    <!-- pagination -->
    <div>{{ $data_homestay->links() }}</div>
</div>
@else
    <div class="alert alert-warning"><h4>Data {{ $cari }} tidak ditemukan</h4><a href="/listhomestay" class="btn btn-warning">Kembali</a></div>
@endif
</body>
@endsection