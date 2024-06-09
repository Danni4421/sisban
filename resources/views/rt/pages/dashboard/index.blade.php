@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
  <h1>Dashboard</h1>
@endsection

@section('breadcrumb')
    @livewire('admin.bread-crumb', [
      'links' => [],
      'active' => 'Dashboard'
    ])
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row gap-4">
      {{-- START INFORMATION --}}
      <div class="row">

          @foreach ($cards as $card)
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="small-box bg-{{$card["color"]}}">
                <div class="inner">
                  <h3>{{ $card["data"] }}</h3>
      
                  <p>{{ $card["label"] }}</p>
                </div>
                <div class="icon">
                  <i class="{{ $card["icon"] }}"></i>
                </div>
                <a 
                  href="{{ $card["href"] }}" 
                  class="small-box-footer"
                >
                  Lihat selengkapnya 
                  <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          @endforeach
        </div>

        {{-- START PIE CHART --}}
        <section class="row gap-4">
          <div 
            class="col-12 col-md-3 card shadow-none px-4 py-3" 
            style="border-radius: 30px; background: #ffffff !important;"
          >
            <div class="d-flex mb-3 justify-content-between align-items-center">
              <h6>Persentase Penerima Bansos</h6>
              <a 
                href="{{ route('rt.penerima.bansos') }}" 
                class="view-all border"
                wire:click="updateActiveItem('/bansos/penerima', true)"
              >View all</a>
            </div>
            <div class="d-flex mx-auto w-75 h-100 justify-content-center align-items-center">
              {{ $recipientPieChart->render() }}
            </div>
          </div>
          <div 
            class="col-12 col-md-3 card shadow-none px-4 py-3" 
            style="border-radius: 30px; background: #ffffff !important;"
          >
            <div class="d-flex mb-3 justify-content-between align-items-center">
              <h6>Persentase Pengajuan Diterima</h6>
              <a 
                href="{{ route('rt.pengajuan.approved') }}" 
                class="view-all border"
                 wire:click="updateActiveItem('/pengajuan/disetujui', true)"
              >View all</a>
            </div>
            <div class="d-flex mx-auto w-75 h-100 justify-content-center align-items-center">
              {{ $acceptantPieChart->render() }}
            </div>
          </div>
          <div 
            class="col-12 col-md-5 card shadow-none px-4 py-3" 
            style="border-radius: 30px; background: #ffffff !important;"
          >
            <div class="d-flex mb-3 justify-content-between align-items-center">
              <h6>Pengajuan Masuk</h6>
              <a 
                href="{{ route('rt.pengajuan.incoming') }}" 
                class="view-all border"
                 wire:click="updateActiveItem('/pengajuan/masuk', true)"
              >View all</a>
            </div>
            {{ $pengajuanLineChart->render() }}
          </div>
        </section>
        {{-- END PIE CHART --}}
      </div>
      {{-- END INFORMATION --}}

    <div class="row gap-4">
      <iframe 
        src="https://lookerstudio.google.com/embed/reporting/9b38c6a9-92ae-4c2c-9f49-4117b3c0d86f/page/TmU2D?params=%7B%22df4%22:%22include%25EE%2580%25801%25EE%2580%2580IN%25EE%2580%2580{{substr(auth()->user()->pengurus->jabatan, 3)}}%22%7D" 
        frameborder="0" 
        class="col-12 col-md-8"
        {{-- width="750px" --}}
        height="600px"
        style="border:0; border-radius: 30px;" 
        allowfullscreen 
        sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"
      ></iframe>
      {{-- START INCOMING DATA PENGAJUAN --}}
      <div class="col-12 col-md-3 card card-secondary card-outline overflow-auto">
        <div class="card-header">
          Data Pengajuan Masuk
        </div>
        <div class="row px-2">
          @foreach ($latestPengajuan as $data)
              <div class="col-12">
                <a 
                  href="/rt/pengajuan/masuk" 
                  class="card" 
                  wire:click="updateActiveItem('/pengajuan/masuk', true)"
                >
                  <div class="card-body">
                    <h5 class="card-title">{{ $data->nama }}</h5>
                    <p class="card-text">{{ date_format($data->created_at, 'D, d-m-Y') }}</p>
                  </div>
                </a>
              </div>
          @endforeach
        </div>
      </div>
{{-- END INCOMING DATA PENGAJUAN --}}
    </div>
  </div>
@endsection

@push('styles')
    <style>
      .view-all {
        font-size: .75rem;
        border-radius: 14px;
        padding: 2px 12px;
        color: #707070;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .view-all:hover {
        background-color: #a5a5a5;
        color: #ffffff;
        transition: .4s;
      }
    </style>
@endpush