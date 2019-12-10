@extends('rs.layout')

@section('styles')
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />
@stop

@section('scripts')
    
@stop

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('rs.index') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">BPJS</li>
    <li class="breadcrumb-item active">Pencarian BPJS</li>
@stop

@section('content')
    <!-- /.row-->
	<script>
		console.log("{{$model->pengguna}}");
	</script>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-edit"></i>Data BPJS</div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
					<div class="alert alert-success" role="alert">Pendaftaran Pasien BPJS Berhasil</div>
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">{{ $error }}</div>
                        @endforeach
                    @endif
					<img src="{{asset('static\website\img\logo-bpjs.png')}}"></img>
					<div class="row">
					<div class="col-md-6">
							<br>
							<br>
							<br>
							<table>
								<tr>
									<td><h4>NIK</h4></td>
									<td><h4>: {{$model->pengguna->id_nik}}</h4></td>
								</tr>
								<tr>
									<td><h4>Nama</h4></td>
									<td><h4>: {{$model->pengguna->name}}</h4></td>
								</tr>
								<!--
								<tr>
									<td>NRP</td>
									<td>: {{$model->pengguna->nrp}}</td>
								</tr>
								-->
								<tr>
									<td><h4>Jenis Kelamin</h4></td>
									<td><h4>: {{$model->pengguna->jenis_kelamin}}</h4></td>
								</tr>
								<tr>
									<td><h4>Alamat</h4></td>
									<td><h4>: {{$model->pengguna->alamat}}</h4></td>
								</tr>
								<tr>
									<td><h4>Email</h4></td>
									<td><h4>: {{$model->pengguna->email}}</h4></td>
								</tr>
								<tr>
									<td><h4>Nomor HP</h4></td>
									<td><h4>: {{$model->pengguna->nohp}}</h4></td>
								</tr>
							</table>
						</div>
						<div class="col-md-6">
							<br>
							<br>
							<br>
							<table>
								<tr>
									<td><h4>Diagnosa</h4></td>
									<td><h4>: {{$model->diagnosa}}</h4></td>
								</tr>
								<tr>
									<td><h4>Rumah Sakit Rujukan</h4></td>
									<td><h4>: {{$model->rs_rujukan}}</h4></td>
								</tr>
								<tr>
									<td><h4>Faskes Tingkat I</h4></td>
									<td><h4>: {{$model->faskes_tingkat1}}</h4></td>
								</tr>
								<tr>
									<td><h4>Rumah Sakit Perujuk</h4></td>
									<td><h4>: {{$model->rs_perujuk}}</h4></td>
								</tr>
								<!--
								<tr>
									<td>NRP</td>
									<td>: {{$model->pengguna->nrp}}</td>
								</tr>
								-->
								<!--tr>
									<td><h4>Nominal</h4></td>
									<td><h4>: Rp. 1.000.000,00</h4></td>
								</tr-->
								<tr>
									<td><h4>Status BPJS</h4></td>
									<td><h4>: Aktif</h4></td>
								</tr>
								
								<!--
								<tr>
									<td><h4>Email</h4></td>
									<td><h4>: {{$model->pengguna->email}}</h4></td>
								</tr>
								<tr>
									<td><h4>Nomor HP</h4></td>
									<td><h4>: {{$model->pengguna->nohp}}</h4></td>
								</tr>
								-->
							</table>
						</div>
						
						<!--
						<div class="col-md-7">
							<form class="form-horizontal" action="{{ route('rs.pendaftaran.buka')}}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
								<div class="form-group">
									<div class="card">
										<div class="card-header">
											<h5>Hak Akses Penggunaan</h5>
										</div>
										<div class="card-body">
										@foreach($rooms as $ruang)
											@php
											$found = 0;
											@endphp
											@foreach($model->pengguna->ruangs as $regrooms)
												@if($regrooms->id == $ruang->id)
													@php
													$found=1;
													@endphp
												@endif
											@endforeach
											<div class="checkbox">
												<label><input type="checkbox" name="hak_akses[]" value="{{$ruang->id}}" @if($found == 1) checked @endif>{{$ruang->nama}}</label>
											</div>
											
										@endforeach
										</div>
									</div>
									<div class="controls">
										<input class="form-control" id="id" type="hidden" name="pengguna_id" value= "{{$model->pengguna->id}}"required>
									</div>
									<div class="card">
										<div class="card-header">
											<h5>Detil Pendaftaran</h5>
										</div>
										<div class="card-body">
											<div class="controls">
												<label for="tipe">Tipe Kartu Yang Didaftarkan:</label>
												<select class="form-control" id="tipe" name="tipe" required>
													<option value="">Silahkan Pilih Jenis Kartu</option>
													<option value="KTM">KTM</option>
													<option value="KTP">KTP</option>
													<option value="Lainnya">Lainnya</option>
												</select>
												<br>
												<label for="alat_id">Alat yang Digunakan Untuk Mendaftar:</label>
												<select class="form-control" id="alat_id" name="alat_id" required>
													<option value="">Silahkan Pilih Alat yang Digunakan</option>
													@foreach($alats as $alat)
														<option value="{{$alat->id}}">{{$alat->nama}} (Ruang {{$alat->ruang->nama}})</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
								</div>
                        
								<div class="form-actions">
									<button class="btn btn-primary" type="submit">Buka Pendaftaran</button>
								</div>
							</form>
						</div>
						-->
					</div>
                    
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
@stop