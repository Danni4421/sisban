@extends('layouts.app')

@section('title', 'Penerima Bantuan Sosial')

@section('content_header')
    <h4>Tambah Penerima Bantuan Sosial</h4>
@endsection

@section('breadcrumb')
    @livewire('admin.bread-crumb', [
      'links' => [
        ['href' => route('rw.penerima.bansos'), 'label' => 'Penerima Bansos']
      ],
      'active' => 'Tambah'
    ])
@endsection

@section('content')
    <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
        <form class="form" action="{{ url('rw/bansos/penerima') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nik" class="form-label">Calon Penerima Bansos</label>
                <select class="form-select" id="nik" name="nik" aria-label="Penerima Bantuan Sosial">
                    <option selected value="">Pilih Calon Penerima Bansos</option>
                    @foreach ($members as $member)
                        <option value="{{ $member->kepala_keluarga->nik }}">
                            {{ $member->no_kk }} - {{ $member->kepala_keluarga->nama }}
                        </option>
                    @endforeach
                </select>

                @error('nik')
                    @livewire('alert-message', ['class' => 'danger', 'message', $message])
                @enderror

            </div>
            <div class="mb-3">
                <label for="id_bansos" class="form-label">Bansos</label>
                <select class="form-select" id="id_bansos" name="id_bansos" aria-label="Bantuan Sosial">
                    <option selected value="">Pilih Bantuan Sosial</option>
                    @foreach ($bansos as $bs)
                        <option value="{{ $bs->id_bansos }}">{{ $bs->nama_bansos }}</option>
                    @endforeach
                </select>

                @error('id_bansos')
                    @livewire('alert-message', ['class' => 'danger', 'message', $message])
                @enderror

            </div>
            <div class="mb-3">
                <label for="tanggal_penerimaan" class="form-label">Tanggal Penerimaan</label>
                <input type="date" class="form-control" id="tanggal_penerimaan" name="tanggal_penerimaan"
                    aria-describedby="Tanggal Penerimaan Bantuan Sosial" value="{{ old('tanggal_penerimaan', now()->format('Y-m-d')) }}"
                    required>

                @error('tanggal_penerimaan')
                    @livewire('alert-message', ['class' => 'danger', 'message', $message])
                @enderror

            </div>
            <div class="table-footer">
                <button type="submit" class="btn btn-primary" id="submit_button">Tambah</button>
                <a href="{{ url('rw/bansos/penerima') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection