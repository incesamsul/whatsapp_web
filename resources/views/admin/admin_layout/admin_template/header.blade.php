<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- csrf token  --}}
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Kasir</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('AdminLTE-3.1.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLTE-3.1.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLTE-3.1.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

{{-- sweetalert --}}
<link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/sweetalert2/sweetalert2.min.css') }}">

    {{-- adminlte and my css --}}
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
