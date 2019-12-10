@extends('tiket.layout')

@section('scripts')
	
@stop

@section('content')

<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card h-100">
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
					<form action= "{{ route('tiket.list') }}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="kota_asal">Kota Asal: </label>
							<div class="controls">
                                <select class="form-control" id="kota_asal" name="kota_asal" required>
                                    <option>Silahkan Pilih Kota Asal</option>
									@foreach($models as $model)
									<option value="{{$model->id}}" @if(old('kota_asal') == "{{$model->id}}") selected @endif >{{$model->nama}}</option>
									@endforeach
                                </select>
                            </div>
						</div>
						<div class="form-group">
							<label for="kota_tujuan">Kota Tujuan: </label>
							<div class="controls">
                                <select class="form-control" id="kota_tujuan" name="kota_tujuan" required>
                                    <option>Silahkan Pilih Kota Tujuan</option>
									@foreach($models as $model)
									<option value="{{$model->id}}" @if(old('kota_tujuan') == "{{$model->id}}") selected @endif >{{$model->nama}}</option>
									@endforeach
                                </select>
                            </div>
						</div>
						
						<div class="form-group">
							<label for="tanggal_berangkat">Tanggal Keberangkatan: </label>
							<input type="date" class="form-control" id="tanggal_berangkat" name="tanggal_berangkat" value ="{{old('tanggal_berangkat')}}" required></input>
						</div>
						<div class="row">
							<div class="col-md-10">
							</div>
							<div class="col-md-2">
								<button type="submit" class="btn btn-primary">Cari</button>
							</div>
						</div>
						
						
						
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection