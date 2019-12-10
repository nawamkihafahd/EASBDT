@extends('logs.layout')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Log</li>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Lacak Orang
                </div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    <form action="{{route('logs.find')}}" method="post">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="nama">NIK/Nama:</label>
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan NIK atau Nama"></input>
						</div>
						<button class="btn btn-primary" type="submit">Cari</button>
					</form>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
@stop