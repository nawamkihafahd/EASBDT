@extends('logs.layout')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Log</li>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> History Tapping
                </div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    <div class="row">
					<div class="col-md-6">
					<a class="btn btn-primary" href="{{route('logs.paymentindex')}}">Smart Payment</a>
					</div>
					<div class="col-md-6">
					<a class="btn btn-primary" href="{{route('logs.parking')}}">Smart Parking</a>
					</div>
					</div>
					<br>
					<br>
					<div class="row">
					<div class="col-md-6">
					<a class="btn btn-primary" href="{{route('logs.presence')}}">Smart Presence</a>
					</div>
					<div class="col-md-6">
					<a class="btn btn-primary" href="{{route('logs.bpjs')}}">Smart BPJS</a>
					</div>
					</div>
					<br>
					<br>
					<div class="row">
					<div class="col-md-6">
					<a class="btn btn-primary" href="{{route('logs.ticket')}}">Smart Ticket</a>
					</div>
					<div class="col-md-6">
					<a class="btn btn-primary" href="{{route('logs.search')}}">Cari Orang</a>
					</div>
					</div>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
@stop