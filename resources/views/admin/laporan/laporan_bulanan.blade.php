@extends('admin.admin_layout.layout_wrapper')
@section('header-title','Laporan')
@section('header-sub-title','Laporan Bulanan')
@section('page_title','Laporan Bulanan')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card my-card shadow-none p-0">
                <div class="card-header bg-main text-white">
                    <?php
                    $strBln = 0;
                        if(request()->segment(3)){
                            $strBln = numberToMonth(last(request()->segments()));
                        }
                    ?>
                    <h5 class="d-inline">Laporan Bulanan Per {{ !request()->segment(3) ? date('F Y') : $strBln . " " .date('Y') }}</h5>
                    <form action="/admin/laporan-harian" method="post" class="d-flex float-right align-items-center justify-content-center" >
                        @csrf
                        <label for="" class="text-nowrap mr-3">Pilih Bulan</label>
                        <div class="form-inline">
                            <div class="input-group" >
                                <select name="bulan" id="input-laporan-bulanan" class="form-control">
                                    <option >Pilih Bulan</option>
                                    @foreach ($bulan as $key=>$bln)
                                        <option  value="{{ $key+1 }}">{{ $bln }}</option>
                                    @endforeach
                                </select>
                              <div class="input-group-append">
                                <button class="btn btn-sidebar btn-light" id="btn-laporan-bulanan">
                                  <i class="fas fa-arrow-right fa-fw"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                    </form>
                </div>
                <div class="card-body">
                    <?php
                        // get last day from a month
                        $endOFmonth =0;
                        if(!$lastDay){
                            $endOfMonth = 31;
                        } else {
                            $endOfMonth = explode("-",$lastDay->tgl_akhir);
                            $endOfMonth = end($endOfMonth);
                        }
                    ?>

                    <table class="table text-xs table-striped table-bordered table-hover table-laporan-absen-bulanan" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pegawai</th>
                                @for ($i=1;$i<=$endOfMonth;$i++)
                                    <th class="absen-row">{{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $bulan = !request()->segment(3) ? date('m') : last(request()->segments());
                             ?>
                            @foreach ($user as $usr)
                            <?php
                                    $checkin = DB::table('absensi')->where(DB::raw('MONTH(tgl)'), '=', $bulan)->where('user_id', $usr->id)->get();
                                    ?>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $usr->name }}</td>
                                    <?php
                                        $arrTgl = [];
                                        foreach ($checkin as $c ) {
                                            $tgl = explode("-", $c->tgl);
                                            $tgl = end($tgl);
                                            $arrTgl[] = $tgl;
                                        }
                                        $j=1;
                                        $staticTgl = [];
                                        for($i=1;$i<=$endOfMonth;$i++){
                                            $staticTgl[] = $i;
                                        }
                                        $tgl = $arrTgl;

                                        $intersection = array_intersect($tgl, $staticTgl);
                                        $diff = array_diff($staticTgl, $tgl);

                                        $result = array();
                                        foreach ($intersection as $value) {
                                            $result[$value] =  ' <i class="fas fa-check text-success"></i>';
                                            $result[$value] .=  ' <p hidden>H</p>';
                                        }
                                        foreach ($diff as $value) {
                                            $result[$value] =  ' <i class="fas fa-times text-danger"></i>';
                                            $result[$value] .=  ' <p hidden>A</p>';
                                        }
                                        ksort($result);

                                        foreach ($result as $r) {
                                            echo "<td>".$r."</td>";
                                        }

                                        // var_dump($result);
                                        // echo implode(', ', $result);
                                    ?>

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
                            <h6 class="font-weight-bold">Kondisi Dan Waktu Checkin</h6>
                            <p id="kondisi-dan-waktu-checkin"></p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                        <div class="lapor-posisi-1-wrapper text-center">
                            <img src="{{ asset('img/ilustration_icon/report.svg') }}" alt="gps_ilustration" width="200" class="mb-3">
                            <h6 class="font-weight-bold">Lokasi Lapor Posisi Pertama</h6>
                            <p id="lokasi-lapor-posisi-pertama"></p>
                            <h6 class="font-weight-bold">Kondisi Dan Waktu Lapor Posisi Pertama</h6>
                            <p id="kondisi-dan-waktu-lapor-posisi-pertama"></p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
                        <div class="lapor-posisi-2-wrapper text-center">
                            <img src="{{ asset('img/ilustration_icon/report.svg') }}" alt="gps_ilustration" width="200" class="mb-3">
                            <h6 class="font-weight-bold">Lokasi Lapor Posisi Kedua</h6>
                            <p id="lokasi-lapor-posisi-kedua"></p>
                            <h6 class="font-weight-bold">Kondisi Dan Waktu Lapor Posisi kedua</h6>
                            <p id="kondisi-dan-waktu-lapor-posisi-kedua"></p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
                        <div class="lapor-checkout text-center">
                            <img src="{{ asset('img/ilustration_icon/checkin.svg') }}" alt="gps_ilustration" width="200" class="mb-3">
                            <h6 class="font-weight-bold">Lokasi checkout</h6>
                            <p id="lokasi-checkout"></p>
                            <h6 class="font-weight-bold">Kondisi Dan Waktu Checkout</h6>
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
