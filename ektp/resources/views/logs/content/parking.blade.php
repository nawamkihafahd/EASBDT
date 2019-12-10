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
                    <i class="fa fa-align-justify"></i> History Tapping Smart Parking
                </div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    <table class="table table-responsive-sm table-striped table-vertical-align">
                        <thead class="thead-dark">
                        <tr>
                            <th style="width: 20px;">No</th>
							<th>Nama</th>
							<th>Tempat </th>
							<th>Tipe Kartu</th>
                            <th>Waktu Masuk</th>
							<th>Waktu Keluar</th>
                            <th>UID Kartu</th>
							<th>Hasil</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($models as $key => $model)
                            <tr>
                                <td>{{ $key+1 }}</td>
								<td>{{ $model->nama}}<br><span class="text-muted">NIK : {{ $model->id_nik }}</span></td>
								<td>{{ $model->ruangan}}<br><span class="text-muted">Fitur : Smart Parking</span></td>
								<td>{{ $model->tipe_kartu}}</td>
								<td>{{ $model->created_at}}</td>
								<td>@if($model->created_at == $model->updated_at) - @else {{ $model->updated_at}} @endif</td>
                                <td>
									{{ $model->uid_kartu}}
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
													@elseif($model->hasil == 5)
														Telah Keluar
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
@stop