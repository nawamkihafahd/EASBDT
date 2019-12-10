@extends('admin.layout')





@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Alat</li>
    <li class="breadcrumb-menu d-md-down-none">
        <div class="btn-group" role="group" aria-label="Button group">
            <a class="btn" href="{{ route('admin.alat.create') }}">
                <i class="icon-plus"></i>  Add Alat</a>
        </div>
    </li>
@stop

@section('content')
    <!-- /.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-edit"></i>Form Alat</div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">{{ $error }}</div>
                        @endforeach
                    @endif
                    <form class="form-horizontal" action="{{ route('admin.alat.update', $model->id) }}" method="post" enctype="multipart/form-data">
                        {{ method_field('put') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-form-label" for="nama">Nama</label>
                            <div class="controls">
                                <input class="form-control" id="nama" type="text" name="nama" placeholder="Nama Alat" value="{{ $model->nama }}" required>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-form-label" for="ruang_id">Ruang</label>
                            <div class="controls">
                                <select class="form-control" id="ruang_id" name="ruang_id" required>
                                    <option>Silahkan Pilih Ruangan</option>
                                    @foreach ($ruangs as $ruang)
                                        <option value="{{ $ruang->id }}" {{ ($model->ruang_id == $ruang->id) ? 'selected':'' }}>{{ $ruang->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-form-label" for="ruang_id">Mode</label>
                            <div class="controls">
                                <select class="form-control" id="mode" name="mode" required>
                                    <option>Silahkan Pilih Mode</option>
                                    <option value="gembok" {{ ($model->mode == 'gembok') ? 'selected':'' }}>Buka Pintu</option>
									<option value="transaksi" {{ ($model->mode == 'transaksi') ? 'selected':'' }}>Transaksi</option>
									<option value="absensi" {{ ($model->mode == 'absensi') ? 'selected':'' }}>Absensi</option>
									<option value="faskes1" {{ ($model->mode == 'faskes1') ? 'selected':'' }}>Pendaftaran Pasien Rumah Sakit</option>
									<option value="checkin" {{ ($model->mode == 'check in kereta') ? 'selected':'' }}>Check In Kereta</option>									
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">Save changes</button>
                            <a href="{{ route('admin.alat.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
@stop