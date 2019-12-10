@extends('rs.layout')

@section('styles')
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />
@stop

@section('scripts')
    
@stop

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('pasien.index') }}">Dashboard</a>
    </li>
    <!--li class="breadcrumb-item">BPJS</li>
    <li class="breadcrumb-item active">Pencarian BPJS</li-->
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
                    <i class="fa fa-edit"></i>Data Pasien</div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
					<div class="alert alert-success" role="alert">Pendaftaran Pasien Baru Berhasil</div>
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">{{ $error }}</div>
                        @endforeach
                    @endif	
					<div class="row">
					<div class="col-md-6">
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
							<table>
								<tr>
									<td><h4>Poli</h4></td>
									<td><h4>: {{$model->polipasien->nama}}</h4></td>
								</tr>
								<tr>
									<td><h4>Nomor Antrian	</h4></td>
									<td><h4>: {{$model->nomor_antrian}}</h4></td>
								</tr>
								<tr>
									<td><h4>Diagnosa</h4></td>
									<td><h4>: {{$model->diagnosa}}</h4></td>
								</tr>
								
								<tr>
									<td><h4>Rumah Sakit Rujukan</h4></td>
									<td><h4>: {{$model->rs_rujukan}}</h4></td>
								</tr>
								<tr>
									<td><h4>Rumah Sakit Perujuk</h4></td>
									<td><h4>: {{$model->rs_perujuk}}</h4></td>
								</tr>
								<tr>
									<td><h4>Faskes Tingkat I</h4></td>
									<td><h4>: {{$model->faskes_tingkat1}}</h4></td>
								</tr>
								<tr>
									<td><h4>Nomor Antrian</h4></td>
									<td><h4>: {{$model->nomor_antrian}}</h4></td>
								</tr>
								
								<!--tr>
									<td><h4>Status BPJS</h4></td>
									<td><h4>: Aktif</h4></td>
								</tr-->
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