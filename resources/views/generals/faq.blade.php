@extends('layouts.app')

@section('title', 'Bantuan & Pertanyaan')

@section('content_header')
  <h1>Bantuan & Pertanyaan</h1>
@endsection

@section('content')
  <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
    @livewire('admin.faq', ['faqs' => $faqs])
  </div>
@endsection
