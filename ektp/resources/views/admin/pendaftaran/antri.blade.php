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
    <li class="breadcrumb-item">Pendaftaran</li>
    <li class="breadcrumb-item active">Antrian</li>
@stop

@section('content')
    <!-- /.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-edit"></i>Data Pendaftar Antri</div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">{{ $error }}</div>
                        @endforeach
                    @endif
					<table class="table table-responsive-sm table-striped table-vertical-align">
					<thead>
					<tr>
						<td>Nama</td>
						<td>NRP</td>
						<td>Alat</td>
						<td>Ruang</td>
						<td>Aksi</td>
					<tr>
					</thead>
					<tbody>
					@foreach($models as $model)
					<tr>
					<td>{{$model->pengguna->name}}</td>
					<td>{{$model->pengguna->nrp}}</td>
					<td>{{$model->alat->nama}}</td>
					<td>{{$model->alat->ruang->nama}}</td>
					<td>
						<a class="btn btn-primary" role="button" href="{{route('admin.pendaftaran.close', ['id' => $model->id])}}">Tutup Pendaftaran Pengantri Ini</a>
					</td>
					</tr>
					@endforeach
					</tbody>
					</table>
					</div>
					</div>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
@stop