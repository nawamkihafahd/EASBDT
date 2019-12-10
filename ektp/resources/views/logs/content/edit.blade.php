@extends('admin.layout')

@section('styles')
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />
@stop

@section('scripts')
    
@stop

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">Tracking Orang</li>
@stop

@section('content')
    <!-- /.row-->
	<script>
		console.log("{{$model}}");
	</script>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-edit"></i>Data Orang</div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif	
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">{{ $error }}</div>
                        @endforeach
                    @endif
					<div class="row">
						<div class="col-md-5">
							<br>
							<br>
							<br>
							<table>
								<tr>
									<td><h4>NIK</h4></td>
									<td><h4>: {{$model->id_nik}}</h4></td>
								</tr>
								<tr>
									<td><h4>Nama</h4></td>
									<td><h4>: {{$model->name}}</h4></td>
								</tr>
								<!--
								<tr>
									<td>NRP</td>
									<td>: {{$model->nrp}}</td>
								</tr>
								-->
								<tr>
									<td><h4>Jenis Kelamin</h4></td>
									<td><h4>: {{$model->jenis_kelamin}}</h4></td>
								</tr>
								<tr>
									<td><h4>Alamat</h4></td>
									<td><h4>: {{$model->alamat}}</h4></td>
								</tr>
								<tr>
									<td><h4>Email</h4></td>
									<td><h4>: {{$model->email}}</h4></td>
								</tr>
								<tr>
									<td><h4>Nomor HP</h4></td>
									<td><h4>: {{$model->nohp}}</h4></td>
								</tr>
							</table>
						</div>
						
						
						
						<div class="col-md-7">
							@if($model->active == 1)
							<a class="btn btn-primary" href="">Blokir</a>
							@else
							<a class="btn btn-primary" href="">Unblock</a>
							@endif
						</div>
					</div>
                    
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
@stop