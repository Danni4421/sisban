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
  @if (count($applicantsByRT) != 0)
    @livewire('r-w.notification', ['applicantsByRT' => $applicantsByRT])
  @else
    <span>Tidak ada notifikasi</span>
  @endif
</div>


@endsection