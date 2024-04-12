@extends('layouts.app')

@section('title', 'Data RT')

@section('content_header')
    <h1>Data RT</h1>
@endsection

@section('content')
    <main class="px-3">
        <hr>
        <div class="mb-3 d-flex justify-content-end">
            <a href="{{ url('admin/data-rt/create') }}" class="btn btn-primary">Tambah RT</a>
        </div>
        <table class="table table-striped">
            <thead>
                <th>Id</th>
                <th>Jabatan</th>
                <th>Nama</th>
                <th>Nomor Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($rts as $rt)
                    <tr>
                        <td>{{ $rt->id_pengurus }}</td>
                        <td>{{ $rt->jabatan }}</td>
                        <td>{{ $rt->nama }}</td>
                        <td>{{ $rt->nomor_telepon }}</td>
                        <td>{{ $rt->alamat }}</td>
                        <td class="d-flex gap-2">
                            <a href="{{ url('admin/data-rt/' . $rt->id_pengurus . '/edit') }}"
                                class="btn btn-warning">Edit</a>
                            <form action="{{ url('admin/data-rt/' . $rt->id_pengurus) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
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
