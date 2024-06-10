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
    <section class="box">
      <div class="row">
        @foreach ($cards as $card)
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-{{$card->backgroundColor}}">
              <div class="inner">
                <h3>{{ $card->data }}</h3>

                <p>{{ $card->title }}</p>
              </div>
              <div class="icon">
                <i class="{{$card->icon}}"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        @endforeach
      </div>
    </section>

    <div class="row gap-4">
      <div 
            class="col-12 col-md-7 card shadow-none px-4 py-3" 
            style="border-radius: 30px; background: #ffffff !important;"
          >
            <div class="d-flex mb-3 justify-content-between align-items-center">
              <h6>Jumlah Pengajuan Tiap RT</h6>
              <a 
                href="{{ route('rt.penerima.bansos') }}" 
                class="view-all border"
                wire:click="updateActiveItem('/bansos/penerima', true)"
              >View all</a>
            </div>
            {{ $barChart->render() }}
          </div>
        <div 
          class="col-12 col-md-4 card shadow-none px-4 py-3" 
          style="border-radius: 30px; background: #ffffff !important;"
        >
          <div class="d-flex mb-3 justify-content-between align-items-center">
            <h6>Peta Dusun Ketangi</h6>
            <a 
              href="https://www.google.com/maps/@-7.9219288,112.6066689,17z?entry=ttu" 
              class="view-all border"
              wire:click="updateActiveItem('/bansos/penerima', true)"
            >Lihat</a>
          </div>
          <x-maps-leaflet :centerPoint="['lat' => -7.9224435, 'long' => 112.6065386]" :zoomLevel="15" style="height: 440px"></x-maps-leaflet>
        </div>
    </div>

    <iframe 
        class="mt-3 w-100" 
        height="700px"
        src="https://lookerstudio.google.com/embed/reporting/0c26ab17-4514-43be-ac8a-38a23d056920/page/dJI2D" 
        frameborder="0" style="border:0" allowfullscreen 
        sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"
      ></iframe>
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