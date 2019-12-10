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
                    <i class="fa fa-align-justify"></i> Tracking
                </div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    <table class="table table-responsive-sm table-striped table-vertical-align">
                        <thead class="thead-dark">
                        <tr>
                            <th style="width: 20px;">No</th>
							<th>NIK:</th>
							<th>Nama: </th>
							<th>Nomor Telepon:</th>
                            <th>Email: </th>
							<th>Aksi: </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($models as $key => $model)
                            <tr>
                                <td>{{ $key+1 }}</td>
								<td>{{ $model->id_nik}}</td>
								<td>{{ $model->name}}</td>
								<td>{{ $model->nohp}}</td>
								<td>{{ $model->email}}</td>
								<td> <a class="btn btn-primary" href="{{route('logs.show', $model->id)}}">Lihat</a> </td>
                            </tr>
                        @endforeach
                        @if ($models->count()==0)
                            <tr>
                                <td colspan="5" class="text-center"> <b>Table Was Empty</b> </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
@stop