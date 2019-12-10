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
					<div class="row">
						<div class="col-md-7">
							<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										Nama Kereta
									</div>
									<div class="col-md-6">
										: {{$model->kereta->nama}}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										Kota Asal
									</div>
									<div class="col-md-6">
										: {{$model->asal->nama}}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										Kota Tujuan
									</div>
									<div class="col-md-6">
										: {{$model->tujuan->nama}}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										Waktu Keberangkatan
									</div>
									<div class="col-md-6">
										: {{$model->tanggal_berangkat}}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										Kelas
									</div>
									<div class="col-md-6">
										: {{$kelas}}
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										Harga
									</div>
									<div class="col-md-6">
										: {{$nominal}}
									</div>
								</div>
							</div>
					</div>
						</div>
						<div class="col-md-5">
							<div class="card">
								<div class="card-body">
									<form action="{{route('tiket.update')}}" method="post">
										{{csrf_field()}}
										<div class="form-group">
											<label for="id_nik">NIK</label>
											<input type="text" class="form-control" id="id_nik" name="id_nik" placeholder="NIK" required></input>
											<input type="hidden" name="tiket_id" value="{{$model->id}}"></input>
											<input type="hidden" name="kelas_id" value="{{$kelas_id}}"></input>
										</div>
										<button type="submit" class="btn btn-primary">Beli</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					
					
				</div>
            </div>
        </div>
    </div>
</div>
@endsection