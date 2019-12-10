@extends('website.layout')

@section('scripts')
	<script>
		function getCities(that)
		{
			var value 		= $(that).val();
			//console.log(value);
			if(value==""){
				var html 	= '<option value="" >Silahkan pilih Kabupaten/Kota</option>';
				$("#kota").html(html);
				$("#kota").prop('disabled',true);
				return;
			}
			$.ajax({
				url:'{{ route('home.cities', 0) }}',
				method: 	"GET",
				data:  		{'id':value}
			})
			.done(function(data){
				//console.log(data);
				if(data.success==true){
					var html 	= '<option value="" >Silahkan pilih Kabupaten/Kota</option>';
						$.each(data.data , function(key, result) {
						html +='<option value="'+result.id+'">'+result.nama+'</option>';
					});
					$("#kota").html(html);
					$("#kota").prop('disabled',false);
					return;
				}
			})
			.fail(function(e) {
				alert("something wrong");
				console.log(e);
			})
		}
		function getkecamatans(that)
		{
			var value 		= $(that).val();
			//console.log(value);
			if(value==""){
				var html 	= '<option value="" >Silahkan pilih Kecamatan</option>';
				$("#kecamatan").html(html);
				$("#kecamatan").prop('disabled',true);
				return;
			}
			$.ajax({
				url:'{{ route('home.districts', 0) }}',
				method: 	"GET",
				data:  		{'id':value}
			})
			.done(function(data){
				//console.log(data);
				if(data.success==true){
					var html 	= '<option value="" >Silahkan pilih Kecamatan</option>';
						$.each(data.data , function(key, result) {
						html +='<option value="'+result.id+'">'+result.nama+'</option>';
					});
					$("#kecamatan").html(html);
					$("#kecamatan").prop('disabled',false);
					return;
				}
			})
			.fail(function(e) {
				alert("something wrong");
				console.log(e);
			})
		}
		function getdesas(that)
		{
			var value 		= $(that).val();
			//console.log(value);
			if(value==""){
				var html 	= '<option value="" >Silahkan Pilih Kelurahan/Desa</option>';
				$("#desa").html(html);
				$("#desa").prop('disabled',true);
				return;
			}
			$.ajax({
				url:'{{ route('home.subdistricts', 0) }}',
				method: 	"GET",
				data:  		{'id':value}
			})
			.done(function(data){
				//console.log(data);
				if(data.success==true){
					var html 	= '<option value="" >Silahkan Pilih Kelurahan/Desa</option>';
						$.each(data.data , function(key, result) {
						html +='<option value="'+result.id+'">'+result.nama+'</option>';
						console.log(result.id);
					});
					$("#desa").html(html);
					$("#desa").prop('disabled',false);
					return;
				}
			})
			.fail(function(e) {
				alert("something wrong");
				console.log(e);
			})
		}
		var page = 1;
		/*
		function showpage(a)
		{
			
			if(a == 'next')
			{
				if(page == 1)
				{
					document.getElementById("page1").style.display = "none";
					document.getElementById("page2").style.display = "block";
					document.getElementById("prevbtn").style.display = "block";
				}
				else if(page == 2)
				{
					document.getElementById("page2").style.display = "none";
					document.getElementById("page3").style.display = "block";
				}
				else if(page == 3)
				{
					document.getElementById("page3").style.display = "none";
					document.getElementById("page4").style.display = "block";
					document.getElementById("nextbtn").style.display = "none";
					document.getElementById("daftarbtn").style.display = "block";
				}
				page++;
			}
			else if(a == 'prev')
			{
				if(page == 2)
				{
					document.getElementById("page1").style.display = "block";
					document.getElementById("page2").style.display = "none";
					document.getElementById("prevbtn").style.display = "none";
				}
				else if(page == 3)
				{
					document.getElementById("page2").style.display = "block";
					document.getElementById("page3").style.display = "none";
				}
				else if(page == 4)
				{
					document.getElementById("page3").style.display = "block";
					document.getElementById("page4").style.display = "none";
					document.getElementById("daftarbtn").style.display = "none";
					document.getElementById("nextbtn").style.display = "block";
				}
				page--;
			}
			
		}
		*/
		function checkpassword(mode)
			{
				console.log(mode);
				if(mode == 'same')
				{
					var pass1 = document.getElementById("password").value;
					var pass2 = document.getElementById("konfirmasi_password").value;
					if(pass1 == '')
					{
						document.getElementById("daftarbtn").disabled = true;
						document.getElementById("passwordemptyalert").style.display = "block";
						
						document.getElementById("passwordmissalert").style.display = "none";
						document.getElementById("passwordmatchalert").style.display = "none";
					}
					else
					{
						document.getElementById("passwordemptyalert").style.display = "none";
						if(pass1 == pass2)
						{
							document.getElementById("passwordmissalert").style.display = "none";
							document.getElementById("passwordmatchalert").style.display = "block";
							document.getElementById("daftarbtn").disabled = false;
						}
						else
						{
							document.getElementById("daftarbtn").disabled = true;
							document.getElementById("passwordmissalert").style.display = "block";
							document.getElementById("passwordmatchalert").style.display = "none";
						}
					}
					
				}
			}
	</script>
@stop

@section('content')

<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-header">Daftar JusTap</div>

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
					<form action= "{{ route('home.storing') }}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div id="page1" >
						<div class="form-group">
							<label for="nik">NIK: </label>
							<input type="text" class="form-control" maxlength="16" id="nik" name="id_nik" placeholder="NIK*" value ="{{old('id_nik')}}"></input>
						</div>
						<div class="form-group">
							<input type="hidden" value="12345678901234" class="form-control" maxlength="14" id="nrp" name="nrp" placeholder="NRP*" value ="{{old('nrp')}}"></input>
						</div>
						<div class="form-group">
							<label for="name">Nama: </label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Nama*" value ="{{old('name')}}"></input>
						</div>
						<div class="form-group">
							<label for="jenis_kelamin">Jenis Kelamin: </label>
							<div class="controls">
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option>Silahkan Pilih Jenis Kelamin</option>
									<option value="Laki-Laki" @if(old('jenis_kelamin') == "Laki-Laki") selected @endif >Laki-Laki</option>
									<option value="Perempuan" @if(old('jenis_kelamin') == "Perempuan") selected @endif>Perempuan</option>
                                </select>
                            </div>
						</div>
						<div class="form-group">
							<label for="nama">Alamat: </label>
							<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat*" value ="{{old('alamat')}}"></input>
						</div>
						<div class="form-group">
							<label for="email">Email: </label>
							<input type="text" class="form-control" id="email" name="email" placeholder="Email*" value ="{{old('email')}}"></input>
						</div>
						<div class="form-group">
							<label for="nohp">Nomor HP (Utamakan nomor yang digunakan di OVO): </label>
							<input type="text" class="form-control" id="nohp" name="nohp" placeholder="Nomor HP*" value ="{{old('nohp')}}"></input>
						</div>
						<div class="form-group">
							<div class="alert alert-danger" id="passwordemptyalert" style="display:none;">
								Password tidak boleh kosong
							</div>
							<label for="password">Password: </label>
							<input type="password" class="form-control" id="password" name="password" onchange="checkpassword('same')"></input>
						</div>
						<div class="form-group">
							<div class="alert alert-danger" id="passwordmissalert" style="display:none;">
								Password tidak sesuai
							</div>
							<div class="alert alert-success" id="passwordmatchalert" style="display:none;">
								Password sesuai
							</div>
							<label for="password">Konfirmasi Password: </label>
							<input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" onchange="checkpassword('same')"></input>
						</div>
						<div class="row">
							<div class="col-md-10">
							</div>
							<div class="col-md-2">
								<button type="submit" class="btn btn-primary" id="daftarbtn" disabled>Daftar</button>
							</div>
						</div>
						</div>
						
						
						
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection