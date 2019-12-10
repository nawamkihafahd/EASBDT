@extends('rs.layout')

@section('styles')
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />
@stop



@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">Pasien Baru</li>
    <li class="breadcrumb-item active">Pendaftaran Pasien BPJS</li>
@stop

@section('content')
    <!-- /.row-->
    <div class="row">
        <div class="col-lg-3">
            
        </div>
		<div class="col-lg-6">
            <div class="card">
				<input type="hidden" id="pengguna_id" value=""></input>
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
                        <thead class="thead-dark">
                        <tr>
                            <th style="width: 20px;">No</th>
                            <th>Nama</th>
                            <th>Diagnosa</th>
                            <th>Tanggal Rujukan</th>
                            <th>Pilih</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($models as $key => $model)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <h5>{{$model->pengguna->nama}}</h5>
                                </td>
                                <td>
									<h5>{{$model->diagnosa}}</h5>
                                </td>
                                <td>
									<h5>{{$model->created_at}}</h5>
                                </td>
                                <td>
                                    <!-- /btn-group-->
									<a class="btn btn-primary" href="{{ route('pasien.show', $model->id) }}">Pilih</a>
                                    <!-- /btn-group-->
                                </td>
                            </tr>
                        @endforeach
                        @if ($models->isEmpty())
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
    <!-- /.row-->
@stop