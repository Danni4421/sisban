@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
  <h1>Dashboard</h1>
@endsection

@section('content')
  <canvas id="barchart"></canvas>
@endsection

@push('styles')
  {{-- Custom styles --}}
@endpush