@extends('layouts.app')

@section('content_header')
    <h1>Data Ketua RT</h1>
@endsection

@section('content')
    <div class="container-md">
        <hr>
        <div class="container">
            <div class="row mb-3">
                <div class="col-8">
                    Tampilkan
                    <select>
                        <option>10</option>
                        <option>20</option>
                        <option>30</option>
                        <!-- Add more options as needed -->
                    </select>
                    data
                </div>
                <div class="col-4 text-right">
                    <a href="{{ url('rw/data-rt/create') }}" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <!-- Headers -->
                    <thead>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>No.Telp</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </thead>

                    <!-- Data Rows -->
                    <tbody>
                        @foreach ($data as $d)
                            @if (strpos($d->jabatan, 'RT') !== false)
                                <tr>
                                    <td>{{ $d->id_pengurus }}</td>
                                    <td>{{ $d->nama }}</td>
                                    <td>{{ $d->jabatan }}</td>
                                    <td>{{ $d->nomor_telepon }}</td>
                                    <td>{{ $d->alamat }}</td>
                                    <td>
                                        <a href="{{ url('rw/data-rt/' . $d->id_pengurus . '/edit/') }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <!-- Added btn-sm class for smaller button -->
                                        <a href="{{ url('rw/data-rt/delete/' . $d->id_pengurus) }}"
                                            class="btn btn-danger btn-sm">Hapus</a>
                                        <!-- Added btn-sm class for smaller button -->
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endsection

        @push('styles')
            {{-- Custom styles --}}
        @endpush
