@extends('admin.admin_layout.layout_wrapper')
@section('header-title','Dashboard')
@section('header-sub-title','Home')

@section('page_title','Dashboard')
@section('content')

<div class="container">
    <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Pelanggan</h3>
                    <form action="/admin/laporan-harian" method="post" class="d-flex float-right align-items-center justify-content-center" >
                        @csrf
                        <label for="" class="text-nowrap mr-3">Pilih Bulan</label>
                        <div class="form-inline">
                            <div class="input-group" >
                                <select name="bulan" id="input-chart-bulanan" class="form-control">
                                    <option value="" required>Pilih Bulan</option>
                                    @foreach ($bulan as $key=>$bln)
                                        <option  value="{{ $key+1 }}">{{ $bln }}</option>
                                    @endforeach
                                </select>
                              <div class="input-group-append">
                                <button class="btn btn-sidebar bg-main text-white" id="btn-chart-bulanan">
                                  <i class="fas fa-arrow-right fa-fw"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                    </form>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex">
                    <p class="d-flex flex-column">
                      <span class="text-bold text-lg">Grafik Perkembangan Pelanggan
                      </span>
                      {{-- <span>Visitors Over Time</span> --}}
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                      {{-- <span class="text-success">
                        <i class="fas fa-arrow-up"></i> 12.5%
                      </span>
                      <span class="text-muted">Since last week</span> --}}
                    </p>
                  </div>
                  <!-- /.d-flex -->

                  <div class="position-relative mb-4">
                    <canvas id="visitors-chart" height="200"></canvas>
                  </div>

                  <div class="d-flex flex-row justify-content-end">

                    <span class="mr-2">
                        <i class="fas fa-square text-main"></i> Barang Masuk
                      </span>
                      <span  class="mr-2">
                        <i class="fas fa-square text-secondary"></i> Barang Keluar
                      </span>
                  </div>
                </div>
              </div>
              <!-- /.card -->

            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Barang</h3>
                    <form action="/admin/laporan-harian" method="post" class="d-flex float-right align-items-center justify-content-center" >
                        @csrf
                        <label for="" class="text-nowrap mr-3">Pilih Bulan</label>
                        <div class="form-inline">
                            <div class="input-group" >
                                <select name="bulan" id="input-chart-bulanan" class="form-control">
                                    <option value="" required>Pilih Bulan</option>
                                    @foreach ($bulan as $key=>$bln)
                                        <option  value="{{ $key+1 }}">{{ $bln }}</option>
                                    @endforeach
                                </select>
                              <div class="input-group-append">
                                <button class="btn btn-sidebar bg-main text-white" id="btn-chart-bulanan">
                                  <i class="fas fa-arrow-right fa-fw"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                    </form>
                    {{-- <a href="javascript:void(0);">View Report</a> --}}
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex">
                    <p class="d-flex flex-column">
                      <span class="text-bold text-lg">Grafik Barang Tahunan</span>
                      <span>Jumlah Stok yang masuk tahunan dalam grafik</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                      {{-- <span class="text-success">
                        <i class="fas fa-arrow-up"></i> 33.1%
                      </span> --}}
                      <?php
                      $bulan = !request()->segment(3) ? date('m') : last(request()->segments());
                      ?>


                      <span class="text-muted">Pada Bulan {{ numberToMonth($bulan) }}</span>
                    </p>
                  </div>
                  <!-- /.d-flex -->

                  <div class="position-relative mb-4">
                    <canvas id="sales-chart" height="200"></canvas>
                  </div>

                  <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                      <i class="fas fa-square text-main"></i> Barang Masuk
                    </span>
                    <span  class="mr-2">
                      <i class="fas fa-square text-secondary"></i> Barang Keluar
                    </span>
                    </span>
                  </div>
                </div>
              </div>
              <!-- /.card -->

            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
</div>

<script src="{{ asset('AdminLTE-3.1.0/plugins/chart.js/Chart.min.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  /* global Chart:false */

$(function () {
    'use strict'

var ticksStyle = {
  fontColor: '#495057',
  fontStyle: 'bold'
}

var mode = 'index'
var intersect = true

var $salesChart = $('#sales-chart')
// eslint-disable-next-line no-unused-vars
var salesChart = new Chart($salesChart, {
  type: 'bar',
  data: {
    labels: ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
    datasets: [
      {
        backgroundColor: '#295353',
        borderColor: '#295353',
        data: [1000, 2000, 3000, 2500, 2700, 2500, 3000]
      },
      {
        backgroundColor: '#ced4da',
        borderColor: '#ced4da',
        data: [700, 1700, 2700, 2000, 1800, 1500, 2000]
      }
    ]
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      mode: mode,
      intersect: intersect
    },
    hover: {
      mode: mode,
      intersect: intersect
    },
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        // display: false,
        gridLines: {
          display: true,
          lineWidth: '4px',
          color: 'rgba(0, 0, 0, .2)',
          zeroLineColor: 'transparent'
        },
        ticks: $.extend({
          beginAtZero: true,

          // Include a dollar sign in the ticks
          callback: function (value) {
            if (value >= 1000) {
              value /= 1000
              value += 'k'
            }

            return '$' + value
          }
        }, ticksStyle)
      }],
      xAxes: [{
        display: true,
        gridLines: {
          display: false
        },
        ticks: ticksStyle
      }]
    }
  }
})

var $visitorsChart = $('#visitors-chart')
// eslint-disable-next-line no-unused-vars
var visitorsChart = new Chart($visitorsChart, {
  data: {
    labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
    datasets: [{
      type: 'line',
      data: [100, 120, 170, 167, 180, 177, 160],
      backgroundColor: 'transparent',
      borderColor: '#295353',
      pointBorderColor: '#295353',
      pointBackgroundColor: '#295353',
      fill: false
      // pointHoverBackgroundColor: '#295353',
      // pointHoverBorderColor    : '#295353'
    },
    {
      type: 'line',
      data: [60, 80, 70, 67, 80, 77, 100],
      backgroundColor: 'tansparent',
      borderColor: '#ced4da',
      pointBorderColor: '#ced4da',
      pointBackgroundColor: '#ced4da',
      fill: false
      // pointHoverBackgroundColor: '#ced4da',
      // pointHoverBorderColor    : '#ced4da'
    }]
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      mode: mode,
      intersect: intersect
    },
    hover: {
      mode: mode,
      intersect: intersect
    },
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        // display: false,
        gridLines: {
          display: true,
          lineWidth: '4px',
          color: 'rgba(0, 0, 0, .2)',
          zeroLineColor: 'transparent'
        },
        ticks: $.extend({
          beginAtZero: true,
          suggestedMax: 200
        }, ticksStyle)
      }],
      xAxes: [{
        display: true,
        gridLines: {
          display: false
        },
        ticks: ticksStyle
      }]
    }
  }
})

})

// lgtm [js/unused-local-variable]

});
</script>

@endsection
