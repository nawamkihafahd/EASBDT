@extends('website.layout')

@section('scripts')
	
@stop

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card h-100">

                <div class="card-body">
                    
					@if (count($errors) > 0)
						@foreach ($errors->all() as $error)	
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endforeach
					@endif
					<h3>Tentang JusTap</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection