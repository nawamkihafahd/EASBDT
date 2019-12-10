@extends('website.layout')

@section('content')
<div class="visible-print text-center">
	<h1>Your Registration QRCode</h1>
     
    {!! QrCode::size(250)->generate($qrcode); !!}
     
</div>
    
@endsection