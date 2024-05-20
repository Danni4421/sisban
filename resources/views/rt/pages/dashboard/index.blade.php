@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
  <h1>Dashboard</h1>
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row gap-4">
      {{-- START INFORMATION --}}
      <div class="col-12 col-md-8">
        <div class="row">
 
          {{-- START BOX 1 --}}
          <div class="col-12 col-md-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>50</h3>
    
                <p>title</p>
              </div>
              <div class="icon">
                <i class="bx bx-users"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          {{-- END BOX 1 --}}

          {{-- START BOX 2 --}}
          <div class="col-12 col-md-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>50</h3>
    
                <p>title</p>
              </div>
              <div class="icon">
                <i class="bx bx-users"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          {{-- START BOX 2 --}}

        </div>

        {{-- START PIE CHART --}}
        <section class="row gap-4 justify-content-center">
          <div class="col-12 col-md-5 bg-light card rounded shadow-sm">
            {{ $recipientPieChart->render() }}
          </div>
          <div class="col-12 col-md-5 bg-light card rounded shadow-sm">
            {{ $acceptantPieChart->render() }}
          </div>
        </section>
        {{-- END PIE CHART --}}
      </div>
      {{-- END INFORMATION --}}

      {{-- START INCOMING DATA PENGAJUAN --}}
      <div class="col-12 col-md-3 card card-secondary card-outline bg-light overflow-auto">
        <div class="card-header">
          Data Pengajuan Masuk
        </div>
        <div class="row px-2">
          @foreach ($latestPengajuan as $data)
              <div class="col-12">
                <a href="/rt/pengajuan/masuk" class="card" wire:click="updateActiveItem('/pengajuan/masuk', true)">
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
