@extends('admin.admin_layout.layout_wrapper')
@section('header-title','laporan stok keluar')
@section('header-sub-title','Home')
@section('page_title','laporan stok keluar')
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


                    <h5 class="m-0 d-inline">Data laporan stok keluar</h5>


                </div>
                <div class="card-body">
                    <table class="table table-striped text-sm" id="table1" >
                        <thead>
                            <th>No</th>
                            <th>Tgl</th>
                            <th>Barcode</th>
                            <th>nama produk</th>
                            <th>Jumlah</th>
                            <th>keterangan</th>
                        </thead>
                        <tbody>
                            @foreach ($stok_keluar as $usr)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $usr['tanggal'] }}</td>
                                    <td>{{ $usr['barcode'] }}</td>
                                    <td>{{ $usr['nama_produk'] }}</td>
                                    <td>{{ $usr['jumlah'] }}</td>
                                    <td>{{ $usr['keterangan'] }}</td>
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
