@extends('layouts.app')

@section('title', 'Penerima Bantuan Sosial')

@section('content_header')
    <h1>Tambah Penerima Bantuan Sosial</h1>
@endsection

@section('content')
    <main class="px-3 pb-4">
        <hr>
        <section>
            <form class="form" action="{{ url('admin/bansos/penerima') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nik" class="form-label">Calon Penerima Bansos</label>
                    <select class="form-select" id="nik" name="nik" aria-label="Penerima Bantuan Sosial">
                        <option selected value="">Pilih Calon Penerima Bansos</option>
                        @foreach ($members as $member)
                            <option value="{{ $member->anggota_keluarga[0]->nik }}">
                                {{ $member->no_kk }} - {{ $member->anggota_keluarga[0]->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_bansos" class="form-label">Bansos</label>
                    <select class="form-select" id="id_bansos" name="id_bansos" aria-label="Bantuan Sosial">
                        <option selected value="">Pilih Bantuan Sosial</option>
                        @foreach ($bansos as $bs)
                            <option value="{{ $bs->id_bansos }}">{{ $bs->nama_bansos }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal_penerimaan" class="form-label">Tanggal Penerimaan</label>
                    <input type="date" class="form-control" id="tanggal_penerimaan" name="tanggal_penerimaan"
                        aria-describedby="Tanggal Penerimaan Bantuan Sosial" value="{{ old('tanggal_penerimaan') }}"
                        required>
                </div>
                <div class="table-footer">
                    <button type="submit" class="btn btn-primary" id="submit_button">Tambah</button>
                    <a href="{{ url('admin/bansos/penerima') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </section>
    </main>
@endsection

@push('styles')
    {{-- Custom styles --}}
@endpush
