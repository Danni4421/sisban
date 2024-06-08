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
                <i class="bx {{$card->icon}}"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        @endforeach
      </div>
    </section>

    <div class="row gap-2 justify-content-start">
      <div class="col-12 col-lg-7 bg-light p-4 rounded shadow-sm">
        {{ $barChart->render() }}
      </div>
      <div class="col-12 col-lg-4 bg-light py-4 rounded shadow-sm">
        <x-maps-leaflet :centerPoint="['lat' => -7.9224435, 'long' => 112.6065386]" :zoomLevel="15" style="height: 440px"></x-maps-leaflet>
      </div>
    </div>

    <iframe 
        width="1100" 
        height="650"
        class="mt-3" 
        src="https://lookerstudio.google.com/embed/reporting/0c26ab17-4514-43be-ac8a-38a23d056920/page/dJI2D" 
        frameborder="0" style="border:0" allowfullscreen 
        sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"
      ></iframe>
  </div>
@endsection