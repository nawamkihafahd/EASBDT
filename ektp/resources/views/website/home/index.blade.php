@extends('website.layout')

@section('scripts')
	
@stop

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card h-100">
                

                <div class="card-body">
					@if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    <h3>Welcome to JusTap</h3>
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection