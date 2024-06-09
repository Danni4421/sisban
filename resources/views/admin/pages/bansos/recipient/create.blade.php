@extends('layouts.app')

@section('title', 'Tambah Penerima Bantuan Sosial')

@section('content_header')
    <h1>Tambah Penerima Bantuan Sosial</h1>
@endsection

@section('content')
    <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
        <section>
            <form class="form" action="{{ url('admin/bansos/penerima') }}" method="POST">
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
                    <a href="{{ url('admin/bansos/penerima') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span class="ms-1">Kembali</span></a>
                    <button type="submit" class="btn btn-primary" id="submit_button">
                        <i class="fa-solid fa-plus"></i>
                        <span class="ms-1">Tambah</span>
                    </button>
                </div>
            </form>
        </section>
    </div>
@endsection

@push('styles')
    {{-- Custom styles --}}
@endpush
