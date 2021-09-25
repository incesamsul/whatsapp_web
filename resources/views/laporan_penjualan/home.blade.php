@extends('admin.admin_layout.layout_wrapper')
@section('header-title','laporan penjualan')
@section('header-sub-title','Home')
@section('page_title','laporan penjualan')
@section('content')
<meta name="csrf_token" content="{{ csrf_token() }}" />

@if (session('message'))
    {{ sweetAlert(session('message'), 'success') }}
@endif
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card my-card shadow-none p-0">
                <div class="card-header bg-main text-white">



                    <h5 class="m-0 d-inline">Data laporan penjualan</h5>


                </div>
                <div class="card-body">
                    <table class="table table-striped text-sm" id="table1" >
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                        </thead>
                        <tbody>
                            @foreach ($penjualan as $usr)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $usr['nama'] }}</td>
                                    <td>{{ $usr['harga'] }}</td>
                                    <td>{{ $usr['jumlah'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
