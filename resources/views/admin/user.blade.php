@extends('admin.admin_layout.layout_wrapper')
@section('header-title','Manajemen User')
@section('header-sub-title','Home')
@section('page_title','Management User')
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
                    <div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="modalUserLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-main">
                            <h5 class="modal-title " id="modalLabel">Tambah User</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body text-black-50">
                                <form method="POST" id="form-user" action="tambah-user">
                                    @csrf
                                    <input type="hidden" id="id_user" name="id">
                                    <div class="form-group">
                                      <label for="nama">Nama Pengguna</label>
                                      <input required name="nama" type="text" class="form-control" id="nama" >
                                    </div>
                                    <div class="form-group">
                                      <label for="email">Email address</label>
                                      <input required name="email" type="email" class="form-control" id="email" >
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" id="btn-modal-user" class="btn bg-main text-white">Tambah User</button>
                                </form>
                                </div>
                        </div>
                        </div>
                    </div>
                    {{-- end of modal  --}}

                    <h5 class="m-0 d-inline judul-halaman">Data User</h5>
                    <a class="btn btn-light float-right m-0 btn-sm"  data-toggle="modal" data-target="#modalUser" id="btn-tambah-user">Tambah User</a>

                </div>
                <div class="card-body">
                    <table class="table table-striped text-sm" id="table1" >
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($user as $usr)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $usr['name'] }}</td>
                                    <td>{{ $usr['username'] }}</td>
                                    <td>{{ $usr['email'] }}</td>
                                    <td><div class="dropdown">
                                        <button class="btn bg-main text-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a data-toggle="modal" data-target="#modalUser" data-edit="{{ $usr }}" class="dropdown-item edit" href="#"><i class="fas fa-pen"></i> Edit</a>
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
