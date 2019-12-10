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
                    <i class="fa fa-align-justify"></i> Rekap Pajak Usaha
                </div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    <!--iv class="row">
					<div class="col-md-6">
					<a class="btn btn-primary" href="{{route('logs.merchant')}}">Log Merchant</a>
					</div>
					<div class="col-md-6">
					<a class="btn btn-primary" href="{{route('logs.paymentall')}}">Log Keseluruhan</a>
					</div>
					</div-->
					<table class="table table-responsive-sm table-striped table-vertical-align">
                        <thead class="thead-dark">
                        <tr>
                            <th style="width: 20px;">No</th>
							<th>Nama Usaha</th>
							<th>Alamat </th>
                            <th>Pemilik</th>
                            <th>Penghasilan</th>
							<th>Pajak Terbayar</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
								<td>PT Oke</td>
								<td>Jalan Oke no. 10</td>
								<td>Muhammad Abyan Dzaka</td>
								<td>Rp. 120.000.000,00</td>
                                <td>Rp. 12.000.000,00</td>
								
                            </tr>
							<tr style="background-color: #f57171">
                                <td>2</td>
								<td>CV Bagus</td>
								<td>Jalan Bagus no. 7</td>
								<td>Dhafa Hikmawan</td>
								<td>Rp. 80.000.000,00</td>
                                <td>Rp. 800.000,00</td>
								
                            </tr>
                        </tbody>
                    </table>
					
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
@stop