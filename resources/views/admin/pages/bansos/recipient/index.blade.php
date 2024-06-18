@extends('layouts.app')

@section('title', 'Penerima Bantuan Sosial')

@section('content_header')
    <header>
        <h1>Data Penerima Bantuan Sosial</h1>
    </header>
@endsection

@section('content')
    <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
        <div class="d-flex justify-content-end">
            <a href="{{ url('admin/bansos/penerima/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah
                Penerima Bansos</a>
        </div>
        {{ $dataTable->table() }}
    </div>
@endsection

@push('styles')
    <style>
        .dataTables_wrapper {
            margin-top: -70px;
        }
    </style>
@endpush
@push('scripts')
    <script>
        function confirmDelete(nik, idBansos) {
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
                        url: `{{ url('/admin/bansos/${idBansos}/penerima/${nik}') }}`,
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
                            
                            $('#recipient-table').DataTable().ajax.reload();
                        }
                    })
                }
            });
        }
    </script>
    {{ $dataTable->scripts() }}
@endpush
