@extends('website.layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
		<div class="col-md-4">
			<div class="card">
                <div class="card-header">QRCode Pendaftaran</div>

                <div class="card-body">
                    
					<div class="visible-print text-center">
     
						{!! QrCode::size(250)->generate($qrcode); !!}
     
					</div>
                </div>
            </div>
		</div>
    </div>
</div>
    
@endsection