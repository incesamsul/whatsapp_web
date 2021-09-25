@extends('admin.admin_layout.layout_wrapper')
@section('header-title','Laporan')
@section('header-sub-title','Laporan Harian')
@section('page_title','Laporan Harian')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card my-card shadow-none p-0">
                <div class="card-header bg-main text-white">
                    <h5 class="d-inline">Laporan Harian {{ !request()->segment(3) ? date('Y-m-d') : last(request()->segments()) }}</h5>
                    <form action="/admin/laporan-harian" method="post" class="d-flex float-right align-items-center justify-content-center" >
                        @csrf
                        <label for="" class="text-nowrap mr-3">Pilih Tanggal</label>
                        <div class="form-inline">
                            <div class="input-group" >
                              <input id="input-date-laporan-harian" class="form-control " type="date" value="{{ !request()->segment(3) ? date('Y-m-d') : last(request()->segments()) }}" name="tgl">
                              <div class="input-group-append">
                                <button class="btn btn-sidebar btn-light" id="btn-laporan-harian">
                                  <i class="fas fa-arrow-right fa-fw"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table text-sm table-striped table-hover " id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pegawai</th>
                                <th>Tgl Absen</th>
                                <th>Check In</th>
                                <th hidden>Lokasi Checkin</th>
                                <th hidden>kondisi checkin</th>
                                <th>Lapor Posisi Pertama</th>
                                <th hidden>Lokasi lapor posisi 1</th>
                                <th hidden>kondisi lapor posisi 1</th>
                                <th>Lapor Posisi Kedua</th>
                                <th hidden>Lokasi lapor posisi 2</th>
                                <th hidden>kondisi lapor posisi 2</th>
                                <th>Check Out</th>
                                <th hidden>Lokasi checkout</th>
                                <th hidden>kondisi checkout</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absensi as $absen)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $absen->user->name }}</td>
                                    <td>{{$absen->tgl->translatedFormat('l, d F Y')}}</td>
                                    <td>{{ $absen->checkin }}</td>
                                    <td hidden>{{ $absen->posisi_checkin }}</td>
                                    <td hidden>{{ $absen->kondisi_checkin }}</td>
                                    <td>{{ !$absen->lapor_posisi_1 ? '---' : $absen->lapor_posisi_1 }}</td>
                                    <td hidden>{{ $absen->posisi_lapor_posisi_1 }}</td>
                                    <td hidden>{{ $absen->kondisi_lapor_posisi_1 }}</td>
                                    <td>{{ !$absen->lapor_posisi_2 ? '---' : $absen->lapor_posisi_2 }}</td>
                                    <td hidden>{{ $absen->posisi_lapor_posisi_2 }}</td>
                                    <td hidden>{{ $absen->kondisi_lapor_posisi_2 }}</td>
                                    <td>{{ !$absen->checkout ? '---' : $absen->checkout }}</td>
                                    <td hidden>{{ $absen->posisi_checkout }}</td>
                                    <td hidden>{{ $absen->kondisi_checkout }}</td>
                                    <td><button data-detailabsen="{{ $absen }}"  data-toggle="modal" data-target="#modalDetail" class="btn btn-sm bg-main text-white btn-detail-absen">Detail</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



  <!-- Modal -->
  {{-- modal detail laporan pegawai --}}
  <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="card m-0  card-tabs">
            <div class="card-header modal-header p-0 pt-1 bg-main text-white">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                    <li class="pt-2 px-3">
                        <h3 class="card-title" id="modalDetailLabel">Card Title</h3>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Checkin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Lapor Posisi 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Lapor Posisi 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Checkout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-jml-jam-kerja" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Jumlah Jam kerja</a>
                    </li>
                </ul>
            </div>
            <div class="card-body modal-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                        <div class="checkin-info-wrapper text-center">
                            <img src="{{ asset('img/ilustration_icon/checkin.svg') }}" alt="gps_ilustration" width="200" class="mb-3">
                            <h6 class="font-weight-bold">Lokasi Checkin</h6>
                            <p id="lokasi-checkin"></p>
                            <h6 class="font-weight-bold">Kordinat Checkin</h6>
                            <p id="kordinat-checkin"></p>
                            <h6 class="font-weight-bold">Kondisi, Status Kerja Dan Waktu Checkin</h6>
                            <p id="kondisi-dan-waktu-checkin"></p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                        <div class="lapor-posisi-1-wrapper text-center">
                            <img src="{{ asset('img/ilustration_icon/report.svg') }}" alt="gps_ilustration" width="200" class="mb-3">
                            <h6 class="font-weight-bold">Lokasi Lapor Posisi Pertama</h6>
                            <p id="lokasi-lapor-posisi-pertama"></p>
                            <h6 class="font-weight-bold">Kordinat Lapor Posisi Pertama</h6>
                            <p id="kordinat-lapor-posisi-pertama"></p>
                            <h6 class="font-weight-bold">Kondisi, Status Kerja Dan Waktu Lapor Posisi Pertama</h6>
                            <p id="kondisi-dan-waktu-lapor-posisi-pertama"></p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
                        <div class="lapor-posisi-2-wrapper text-center">
                            <img src="{{ asset('img/ilustration_icon/report.svg') }}" alt="gps_ilustration" width="200" class="mb-3">
                            <h6 class="font-weight-bold">Lokasi Lapor Posisi Kedua</h6>
                            <p id="lokasi-lapor-posisi-kedua"></p>
                            <h6 class="font-weight-bold">Kordinat Lapor Posisi Kedua</h6>
                            <p id="kordinat-lapor-posisi-kedua"></p>
                            <h6 class="font-weight-bold">Kondisi, Status Kerja Dan Waktu Lapor Posisi kedua</h6>
                            <p id="kondisi-dan-waktu-lapor-posisi-kedua"></p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
                        <div class="lapor-checkout text-center">
                            <img src="{{ asset('img/ilustration_icon/checkin.svg') }}" alt="gps_ilustration" width="200" class="mb-3">
                            <h6 class="font-weight-bold">Lokasi checkout</h6>
                            <p id="lokasi-checkout"></p>
                            <h6 class="font-weight-bold">Kordinat Checkout</h6>
                            <p id="kordinat-checkout"></p>
                            <h6 class="font-weight-bold">Kondisi, Status Kerja Dan Waktu Checkout</h6>
                            <p id="kondisi-dan-waktu-checkout"></p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-two-jml-jam-kerja" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
                        <div class="jml-jam-kerja-wrapper text-center">
                            <img src="{{ asset('img/ilustration_icon/time.svg') }}" alt="gps_ilustration" width="200" class="mb-3">
                            <h6 class="font-weight-bold">Jumlah Jam Kerja</h6>
                            <p id="jml-jam-kerja"></p>
                        </div>
                    </div>
                </div>
            </div>
    </div>

      </div>
    </div>
  </div>

@endsection
