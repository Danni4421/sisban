@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <header>
        <h1>Data Penerima Bantuan Sosial</h1>
    </header>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ url('rt/bansos/penerima/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah
                Penerima Bansos</a>
        </div>
        {{ $dataTable->table() }}
    </div>
@endsection

@push('styles')
    {{-- Custom styles --}}
@endpush

@push('scripts')
    <script>
        function confirmDelete(idBansos, nik) {
            Swal.fire({
                title: "Yakin menghapus penerima bansos?",
                text: "Perubahan tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: `{{ url('/rt/bansos/${idBansos}/penerima/${nik}') }}`,
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}",
                            contentType: 'application/json'
                        },
                        success: function () {
                            Swal.fire({
                                title: "Menghapus Penerima Bantuan Sosial!",
                                text: "Data pengajuan berhasil dihapus.",
                                icon: "success"
                            });
                            
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000)
                        }
                    })
                }
            });
        }
    </script>
    {{ $dataTable->scripts() }}
@endpush
