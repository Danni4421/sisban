@extends('layouts.app')

@section('title', 'Edit Penerima Bantuan Sosial')

@section('content_header')
    <h1>Ubah Penerima Bantuan Sosial</h1>
@endsection

@section('content')
    <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
        <section>
            <form class="form" action="{{ url('admin/bansos/' . $recipient->id_bansos . '/penerima/' . Crypt::encrypt($recipient->nik)) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="penerima" class="form-label">Penerima Bansos</label>
                    <select class="form-select" id="nik" name="nik" aria-label="Penerima Bantuan Sosial">
                        @foreach ($candidates as $candidate)
                            <option value="{{ Crypt::encrypt($candidate->kepala_keluarga->nik) }}"
                                @if ($candidate->kepala_keluarga->nik == $recipient->nik) selected @endif>
                                {{ $candidate->kepala_keluarga->nama }}
                            </option>
                        @endforeach
                    </select>

                    @error('nik')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="penerima" class="form-label">Bansos</label>
                    <select class="form-select" id="id_bansos" name="id_bansos" aria-label="Bantuan Sosial">
                        @foreach ($bansos as $bs)
                            <option value="{{ $bs->id_bansos }}" @if ($bs->id_bansos == $recipient->id_bansos) selected @endif>
                                {{ $bs->nama_bansos }}</option>
                        @endforeach
                    </select>

                    @error('id_bansos')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal_penerimaan" class="form-label">Tanggal Penerimaan</label>
                    <input type="date" class="form-control" id="tanggal_penerimaan" name="tanggal_penerimaan"
                        aria-describedby="Tanggal Penerimaan Bantuan Sosial" value="{{ $recipient->tanggal_penerimaan }}"
                        required>

                    @error('tanggal_penerimaan')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror
                </div>
                <div class="table-footer">
                    <a href="{{ url('admin/bansos/penerima') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span class="ms-1">Kembali</span>
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="fa-regular fa-pen-to-square"></i>
                        <span class="ms-1">Ubah</span>
                    </button>
                </div>
            </form>
        </section>
    </div>
@endsection
