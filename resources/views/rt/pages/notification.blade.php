@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content_header')
  <header>
    <h1>Notifikasi</h1>
  </header>
@endsection

@section('content')
<div class="container-fluid">
  <hr>
  @livewire('r-t.notification', ['aplicants' => $aplicants])
</div> 


@endsection

@push('styles')
  {{-- Custom styles --}}
@endpush

