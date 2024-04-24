@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <header>
        <h1>Data Penerima Bantuan Sosial</h1>
    </header>
@endsection

@section('content')
    <main class="px-3">
        <hr>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ url('rw/bansos/penerima/create') }}" class="btn btn-primary">Tambah Penerima Bansos</a>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <th>Nama</th>
                <th>NIK</th>
                <th>No.WA</th>
                <th>Jenis Bansos</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($recipients as $recipient)
                    <tr>
                        <td>{{ $recipient->warga->nama }}</td>
                        <td>{{ $recipient->warga->nik }}</td>
                        <td>{{ $recipient->warga->no_hp }}</td>
                        <td>{{ $recipient->bansos->nama_bansos }}</td>
                        <td class="d-flex gap-2">
                            <a href="{{ url('/rw/bansos/' . $recipient->bansos->id_bansos . '/penerima/' . $recipient->warga->nik . '/edit') }}"
                                class="btn btn-warning">Edit</a>
                            <form
                                action="{{ url('/rw/bansos/' . $recipient->bansos->id_bansos . '/penerima/' . $recipient->warga->nik) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submite" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection

@push('styles')
    {{-- Custom styles --}}
@endpush
