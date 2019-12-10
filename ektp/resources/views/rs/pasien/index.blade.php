@extends('rs.layout')

@section('styles')
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />
@stop

@section('headscripts')
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('js/select2.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/datatables.min.js') }}" defer></script>
	<script>
	var searchbpjs = 1;
	var url1 = "{{route('pasien.load', -1)}}";
	//alert(url1);
	var url2 = url1.slice(0, -2);
	//alert(url2);
    $(document).ready(function() {
		
		getBpjs();
	});
	function getBpjs()
	{
		$.ajax({ 
				type: 'GET', 
				url: 'http://ektp.ktp/transaksi/1', 
				dataType: 'json'
			}).done(function (msg){
				console.log(msg);
				//alert("here");
				if(msg.status!=200){
				//alert(msg.msg);
					if(searchbpjs == 1)
					{
						setTimeout(function(){getBpjs();}, 500);
					}
				}else{
					//alert("else");
					if(msg.res == 0)
					{
						//alert('');
					}
					else
					{
						$('#pengguna_id').val(msg.id);
						//alert('Nomor Hp = ' + msg.nohp);
					}
					if(searchbpjs == 1 && $('#pengguna_id').val() != "")
					{
						
						var url = url2.concat($('#pengguna_id').val().toString());
						window.location = url;
							searchbpjs = 0;
					}
					setTimeout(function(){getBpjs();}, 500);
				}
				
				
			}).fail(function(x,e){
				if (x.status==0) {
					alert('You are offline!!\n Please Check Your Network.');
				} else if(x.status==404) {
					alert('Requested URL not found.');
				} else if(x.status==500) {
					alert('Internel Server Error.');
				} else if(e=='parsererror') {
					alert('Error.\nParsing JSON Request failed.');
				} else if(e=='timeout'){
					alert('Request Time out.');
				} else {
					alert('Unknown Error.\n'+x.responseText);
				}
				if(searchnohp == 1)
				{
					setTimeout(function(){getNoHp();}, 500);
				}
			})
	}
	</script>
@stop

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">Pasien Baru</li>
    <li class="breadcrumb-item active">Pendaftaran Pasien Baru</li>
@stop

@section('content')
    <!-- /.row-->
    <div class="row">
        <div class="col-lg-3">
            
        </div>
		<div class="col-lg-6">
            <div class="card">
				<input type="hidden" id="pengguna_id" value=""></input>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">{{ $error }}</div>
                        @endforeach
                    @endif
					<div class="form-group">
					
					
					<h3 style="text-align: center">Menunggu Input Kartu Pasien</h3>
					<img src="{{url('static/website/img/card.png')}}" style="display: block;margin-left: auto;margin-right: auto;"</img>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
@stop