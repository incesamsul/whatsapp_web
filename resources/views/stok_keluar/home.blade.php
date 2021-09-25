@extends('admin.admin_layout.layout_wrapper')
@section('header-title','stok keluar')
@section('header-sub-title','Home')
@section('page_title','stok keluar')
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

                    {{-- modal --}}
                    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-main">
                            <h5 class="modal-title " id="modalLabel">Tambah stok keluar</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body text-black-50">
                                <form method="POST" id="form" action="tambah-stok_keluar">
                                    @csrf
                                    <input type="hidden" id="id_user" name="id">
                                    <div class="form-group">
                                      <label for="tanggal">tanggal</label>
                                      <input required name="tanggal" type="date" class="form-control" id="tanggal" >
                                    </div>
                                    <div class="form-group">
                                      <label for="barcode">Barcode</label>
                                      <input required name="barcode" type="barcode" class="form-control" id="barcode" >
                                    </div>
                                    <div class="form-group">
                                      <label for="nama_produk">nama_produk </label>
                                      <input required name="nama_produk" type="nama_produk" class="form-control" id="nama_produk" >
                                    </div>
                                    <div class="form-group">
                                      <label for="jumlah">jumlah </label>
                                      <input required name="jumlah" type="jumlah" class="form-control" id="jumlah" >
                                    </div>
                                    <div class="form-group">
                                      <label for="keterangan">keterangan </label>
                                      <input required name="keterangan" type="keterangan" class="form-control" id="keterangan" >
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" id="btn-modal" class="btn bg-main text-white">Tambah stok masuk</button>
                                </form>
                                </div>
                        </div>
                        </div>
                    </div>
                    {{-- end of modal  --}}

                    <h5 class="m-0 d-inline judul-halaman">Data stok keluar</h5>
                    <a class="btn btn-light float-right m-0 btn-sm"  data-toggle="modal" data-target="#modal" id="btn-tambah-user">Tambah stok keluar</a>

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
                            <th>action</th>
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
                                    <td><div class="dropdown">
                                        <button class="btn bg-main text-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a data-toggle="modal" data-target="#modal" data-edit="{{ $usr }}" class="dropdown-item edit" href="#"><i class="fas fa-pen"></i> Edit</a>
                                          <a data-iduser="{{ $usr['id'] }}" class="dropdown-item hapus" href="/hapus/{{ $usr['id'] }}"><i class="fas fa-trash"></i> Hapus</a>
                                          <a class="dropdown-item" href="#"><i class="fas fa-info-circle"></i> Detail</a>
                                        </div>
                                      </div></td>
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
