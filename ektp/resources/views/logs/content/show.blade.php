@extends('logs.layout')

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
							<table>
								<tr>
									<td><h4>NIK</h4></td>
									<td><h4>: {{$pengguna->id_nik}}</h4></td>
								</tr>
								<tr>
									<td><h4>Nama</h4></td>
									<td><h4>: {{$pengguna->name}}</h4></td>
								</tr>
								<tr>
									<td><h4>Jenis Kelamin</h4></td>
									<td><h4>: {{$pengguna->jenis_kelamin}}</h4></td>
								</tr>
								<tr>
									<td><h4>Alamat</h4></td>
									<td><h4>: {{$pengguna->alamat}}</h4></td>
								</tr>
								<tr>
									<td><h4>Email</h4></td>
									<td><h4>: {{$pengguna->email}}</h4></td>
								</tr>
								<tr>
									<td><h4>Nomor HP</h4></td>
									<td><h4>: {{$pengguna->nohp}}</h4></td>
								</tr>
							</table>
						</div>
						
						
						
						<div class="col-md-7">
							<br>
							@if($pengguna->active == 1)
							<a class="btn btn-primary" href="{{route('logs.block', $pengguna->id)}}">Block</a>
							@else
							<a class="btn btn-primary" href="{{route('logs.unblock', $pengguna->id)}}">Unblock</a>
							@endif
						</div>
					</div>
                    
                </div>
            </div>
			<div class="card">
				<div class="card-header">Log Go-Tap</div>
				<div class="card-body">
					<table class="table table-responsive-sm table-striped table-vertical-align">
                        <thead class="thead-dark">
                        <tr>
                            <th style="width: 20px;">No</th>
							<th>Nama</th>
							<th>Tempat </th>
							<th>Tipe Kartu</th>
                            <th>Waktu Tapping</th>
                            <th>UID Kartu</th>
							<th>Gambar</th>
							<th>Hasil</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($models as $key => $model)
                            <tr>
                                <td>{{ $key+1 }}</td>
								<td>{{ $model->nama}}<br><span class="text-muted">NIK : {{ $model->id_nik }}</span></td>
								<td>{{ $model->ruangan}}<br><span class="text-muted">Fitur : @if($model->mode=="parking") Smart Parking @elseif($model->mode=="faskes1") Smart BPJS, Faskes Tingkat 1 @elseif($model->mode=="bpjs") Smart BPJS, Faskes Lanjutan @elseif($model->mode=="checkin") Smart Ticket @elseif($model->mode=="transaksi") Smart Payment @elseif($model->mode=="absensi") Smart Presence @endif</span></td>
								<td>{{ $model->tipe_kartu}}</td>
								<td>{{ $model->created_at}}</td>
                                <td>
									{{ $model->uid_kartu}}
                                </td>
								<td>
                                    <div class="thumbnail">
                                        <img class="img-thumbnail" src="{{ asset($model->showImage()) }}" alt="" style="object-fil:cover;height: 100px;width: 100px;">
											{{asset($model->showImage())}}
                                    </div>
                                </td>
								<td>
									@if($model->hasil == 0)
										Tapping Gagal: Kartu Tidak Dikenal
									@else
										@if($model->hasil == 2)
											Tapping Berhasil: Kartu Dikenal
										@else
											@if($model->hasil == 1)
												Tapping Berhasil: Pendaftaran Berhasil
											
											@else	
												@if($model->hasil == 4)
													Wajah Tidak Sesuai
												@else
													@if($model->hasil == 3)
														Tapping Berhasil: Kartu dan Wajah Dikenal
													@endif
												@endif
											@endif
										@endif
									@endif
                                </td>
								
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
    <!-- /.row-->
@stop