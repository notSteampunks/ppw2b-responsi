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
    <li  class="active ">
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
<a class="navbar-brand" href="javascript:;">List User</a>
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
    @if(Session::has('success_updated'))
        <div class="alert alert-primary">{{Session::get('success_updated')}}</div>
    @endif
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-12">
		<table class="table table-image">
		  <thead>
		    <tr>
		      <th scope="col">Name</th>
		      <th scope="col">Email</th>
		      <th scope="col">Level</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
			@foreach ($data_user as $user)
			<tr>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->level }}</td>
        <td>
            <form>
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">
                  <i class="fa fa-pencil-alt"></i> Edit </a>
            </form>
        </td>
			</tr>
			@endforeach
		  </tbody>
		</table>   
    </div>
  </div>
      <!-- Count Homestay -->
      <h6 align="center">Number of Active User : {{$banyak_user}}</h6>
</div>
</body>
@endsection