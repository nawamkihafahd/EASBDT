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
	var current = {{$setting->nomor_antrian}};
	var url1= "{{route('pasien.getantrian')}}";
	var searchbpjs = 1;
	$(document).ready(function() {
		
		getAntrian();
	});
	
	function getAntrian()
	{
		$.ajax({ 
				type: 'GET', 
				url: url1, 
				dataType: 'json'
			}).done(function (msg){
				console.log(msg);
				//alert("here");
				if(msg.status!=200){
				//alert(msg.msg);
					if(searchbpjs == 1)
					{
						setTimeout(function(){getAntrian();}, 500);
					}
				}else{
					//alert("else");
					if(msg.res == 0)
					{
						//alert('');
						setTimeout(function(){getAntrian();}, 500);
					}
					else
					{
						if(msg.nomor != current)
						{
							document.location.reload();
						}
						else{
							setTimeout(function(){getAntrian();}, 500);
						}
						//alert('Nomor Hp = ' + msg.nohp);
					}
					
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
				setTimeout(function(){getAntrian();}, 500);
			})
	}
    </script>
@stop

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('pasien.index') }}">Dashboard</a>
    </li>
    <!--li class="breadcrumb-item">BPJS</li>
    <li class="breadcrumb-item active">Pencarian BPJS</li-->
@stop

@section('content')
    <!-- /.row-->
	<script>
		console.log("{{$model->pengguna}}");
	</script>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-edit"></i>Form Diagnosis Pasien</div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">{{ $error }}</div>
                        @endforeach
                    @endif	
					
					
					<div class="card">
					<div class="card-header">
						Data Pasien
					</div>
					<div class="card-body">
					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Nama:</label>
							<input type="text" class="form-control" id="name" value = "{{$model->pengguna->name}}"readonly></input>
						</div>
						<div class="form-group">
							<label for="nik">NIK:</label>
							<input type="text" class="form-control" id="nik" value = "{{$model->pengguna->id_nik}}"readonly></input>
						</div>
						<div class="form-group">
							<label for="jenis_kelamin">Jenis Kelamin:</label>
							<input type="text" class="form-control" id="jenis_kelamin" value = "{{$model->pengguna->jenis_kelamin}}"readonly></input>
						</div>
						<div class="form-group">
							<label for="alamat">Alamat:</label>
							<input type="text" class="form-control" id="alamat" value = "{{$model->pengguna->alamat}}"readonly></input>
						</div>
						<!--div class="form-group">
							<label for="faskes_tingkat1">Faskes Tingkat 1:</label>
							<input type="text" class="form-control" id="faskes_tingkat1" value = "{{$model->faskes_tingkat1}}"readonly></input>
						</div>
						<div class="form-group">
							<label for="rs_perujuk">Rumah Sakit Perujuk:</label>
							<input type="text" class="form-control" id="rs_perujuk" value = "{{$model->rs_perujuk}}"readonly></input>
						</div>
						<div class="form-group">
							<label for="bpjs">Status Bpjs:</label>
							<input type="text" class="form-control" id="bpjs" value = "Aktif" readonly></input>
						</div-->
					</div>
					<div class="col-md-6">
					<div class="form-group">
							<label for="alamat">Poli:</label>
							<input type="text" class="form-control" id="poli" value = "{{$model->polipasien->nama}}"readonly></input>
						</div>
					<form action="{{route('pasien.faskes1.simpan', $model->id)}}" method="post">
						{{csrf_field()}}
						{{ method_field('PUT') }}
						<div class="form-group">
							<label for="diagnosa">Diagnosa:</label>
							<textarea class="form-control" rows="5" id="diagnosa" name="diagnosa">{{$model->diagnosa}}</textarea>
						</div>
						<!--iv class="form-group">
							<label for="rs_rujukan">Rumah Sakit Rujukan:</label>
							<select class="form-control" id="rs_rujukan" name="rs_rujukan">
								<option value="">-</option>
								<option value="RS Mantap" @if($model->rs_rujukan == 'RS Mantap') selected @endif>RS Mantap</option>
							</select>
						</div-->
						<button type="submit" class="btn btn-primary">Simpan</button>
					
					</form>
					</div>
						
						
						
					</div>
                   </div>
                </div>
				</div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
@stop