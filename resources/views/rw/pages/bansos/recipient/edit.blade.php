@extends('layouts.app')

@section('title', 'Penerima Bantuan Sosial')

@section('content_header')
    <h1>Ubah Penerima Bantuan Sosial</h1>
@endsection

@section('content')
    <main class="px-3 pb-4">
        <hr>
        <section>
            <form class="form" action="{{ url('rw/bansos/' . $recipient->id_bansos . '/penerima/' . $recipient->nik) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="penerima" class="form-label">Penerima Bansos</label>
                    <select class="form-select" id="nik" name="nik" aria-label="Penerima Bantuan Sosial">
                        @foreach ($candidates as $candidate)
                            <option value="{{ $candidate->anggota_keluarga[0]->nik }}"
                                @if ($candidate->anggota_keluarga[0]->nik == $recipient->nik) selected @endif>
                                {{ $candidate->no_kk }} - {{ $candidate->anggota_keluarga[0]->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="penerima" class="form-label">Bansos</label>
                    <select class="form-select" id="id_bansos" name="id_bansos" aria-label="Bantuan Sosial">
                        @foreach ($bansos as $bs)
                            <option value="{{ $bs->id_bansos }}" @if ($bs->id_bansos == $recipient->id_bansos) selected @endif>
                                {{ $bs->nama_bansos }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal_penerimaan" class="form-label">Tanggal Penerimaan</label>
                    <input type="date" class="form-control" id="tanggal_penerimaan" name="tanggal_penerimaan"
                        aria-describedby="Tanggal Penerimaan Bantuan Sosial" value="{{ $recipient->tanggal_penerimaan }}"
                        required>
                </div>
                <div class="table-footer">
                    <button type="submit" class="btn btn-warning">Ubah</button>
                    <a href="{{ url('admin/bansos/penerima') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </section>
    </main>
@endsection

@push('styles')
    {{-- Custom styles --}}
@endpush
