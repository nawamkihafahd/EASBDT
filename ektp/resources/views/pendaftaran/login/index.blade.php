@extends('pendaftaran.layout')



@section('content')
<br>
<br>
<br>
<div class="container">
    <div class="row justify-content-center">
		<div class="col-md-4">
			<div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    
					@if (count($errors) > 0)
						<div class="alert alert-danget">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<form action= "{{ route('login.store') }}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="nik">NIK: </label>
							<input type="text" class="form-control" id="nik" name="id_nik"></input>
						</div>
						
						<div class="form-group">
							<label for="password">Password: </label>
							<input type="password" class="form-control" id="password" name="password"></input>
						</div>
						
						<br>
						<button type="submit" class="btn btn-primary">Login</input>
					</form>
                </div>
            </div>
		</div>
    </div>
</div>
@endsection