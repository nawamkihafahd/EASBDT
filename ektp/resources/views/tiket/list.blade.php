@extends('tiket.layout')

@section('scripts')
	
@stop

@section('content')

<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cari Tiket</div>

                <div class="card-body">
					@if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    
					@if (count($errors) > 0)
						@foreach ($errors->all() as $error)	
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endforeach
					@endif
					<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-md-3">
										Nama Kereta
									</div>
									<div class="col-md-3">
										Kota Asal
									</div>
									<div class="col-md-3">
										Kota Tujuan
									</div>
									<div class="col-md-3">
										Harga
									</div>
								</div>
							</div>
					</div>
					<br>
					@foreach($models as $model)
						@foreach($model->kelas as $kelas)
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-md-3">
										<h5>{{$model->kereta->nama}}<h5>
										<h6>{{$kelas->nama}}</h6>
									</div>
									<div class="col-md-3">
										<h5>{{$model->asal->nama}}<h5>
										<h6>{{$model->tanggal_berangkat}}</h6>
									</div>
									<div class="col-md-3">
										<h5>{{$model->tujuan->nama}}<h5>
									</div>
									<div class="col-md-3">
										<h5>Rp. {{$kelas->pivot->nominal}},00<h5>
										<a class="btn btn-primary" href="{{route('tiket.edit', [$model->id, $kelas->id])}}">Beli</a>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					@endforeach
				</div>
            </div>
        </div>
    </div>
</div>
@endsection