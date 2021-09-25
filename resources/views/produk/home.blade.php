@extends('admin.admin_layout.layout_wrapper')
@section('header-title','produk')
@section('header-sub-title','Home')
@section('page_title','produk')
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
                            <h5 class="modal-title " id="modalLabel">Tambah produk</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body text-black-50">
                                <form method="POST" id="form" action="tambah-produk">
                                    @csrf
                                    <input type="hidden" id="id_user" name="id">
                                    <div class="form-group">
                                      <label for="barcode">barcode </label>
                                      <input required name="barcode" type="barcode" class="form-control" id="barcode" >
                                    </div>
                                    <div class="form-group">
                                      <label for="nama">nama </label>
                                      <input required name="nama" type="nama" class="form-control" id="name" >
                                    </div>
                                    <div class="form-group">
                                      <label for="satuan">satuan </label>
                                      <input required name="satuan" type="satuan" class="form-control" id="satuan" >
                                    </div>
                                    <div class="form-group">
                                      <label for="kategori">kategori </label>
                                      <input required name="kategori" type="kategori" class="form-control" id="kategori" >
                                    </div>
                                    <div class="form-group">
                                      <label for="harga">harga </label>
                                      <input required name="harga" type="harga" class="form-control" id="harga" >
                                    </div>
                                    <div class="form-group">
                                      <label for="stok">stok </label>
                                      <input required name="stok" type="stok" class="form-control" id="stok" >
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" id="btn-modal" class="btn bg-main text-white">Tambah produk</button>
                                </form>
                                </div>
                        </div>
                        </div>
                    </div>
                    {{-- end of modal  --}}

                    <h5 class="m-0 d-inline judul-halaman">Data produk</h5>
                    <a class="btn btn-light float-right m-0 btn-sm"  data-toggle="modal" data-target="#modal" id="btn-tambah-user">Tambah produk</a>

                </div>
                <div class="card-body">
                    <table class="table table-striped text-sm" id="table1" >
                        <thead>
                            <th>No</th>
                            <th>barcode</th>
                            <th>nama</th>
                            <th>satuan</th>
                            <th>kategori</th>
                            <th>harga</th>
                            <th>stok</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($produk as $usr)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $usr['barcode'] }}</td>
                                    <td>{{ $usr['nama'] }}</td>
                                    <td>{{ $usr['satuan'] }}</td>
                                    <td>{{ $usr['kategori'] }}</td>
                                    <td>{{ $usr['harga'] }}</td>
                                    <td>{{ $usr['stok'] }}</td>
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
