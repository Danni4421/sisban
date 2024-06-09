@extends('layouts.app')

@section('title', 'Tambah Kandidat')

@section('content_header')
    <h4>Tambah Kandidat Bantuan Sosial</h4>
@endsection

@section('breadcrumb')
    @livewire('admin.bread-crumb', [
      'links' => [
        ['href' => route('rt.kandidat'), 'label' => 'Kandidat']
      ],
      'active' => 'Tambah'
    ])
@endsection

@section('content')
    <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
        <form action="{{ route('rt.kandidat.store') }}" method="POST">
            @csrf
            
            <x-label for="kandidat">Pilih Kandidat</x-label>
            <select class="form-select p-3 my-3" name="kandidat" id="kandidat">
                <option selected>Pilih Kandidat Alternatif Penerima Bansos</option>
                @foreach ($kandidat as $key => $knd)
                    <option value="{{$knd->no_kk}}">{{ $knd->kepala_keluarga->nama }}</option>
                @endforeach
            </select>

            @error('kandidat')
                @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
            @enderror

            <a href="{{ route('rt.kandidat') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i>
                <span class="ms-1">Kembali</span>
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i>
                <span class="ms-1">Tambah Kandidat</span>
            </button>
        </form>
    </div>
@endsection

