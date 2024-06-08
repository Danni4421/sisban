@extends('layouts.app')

@section('title', 'Keluarga')

@section('content_header')
    <header>
        <h1>Keluarga RT </h1>
    </header>
@endsection

@section('breadcrumb')
    @livewire('admin.bread-crumb', [
      'links' => [],
      'active' => 'Keluarga'
    ])
@endsection

@section('content')
    <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
        <div class="d-flex justify-content-end">
            <a href="{{ url('/rt/keluarga/create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i>
                Tambah Keluarga
            </a>
        </div>
        
        <div>
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection

@push('styles')
    <style>
        @media (min-width: 576px) {
            .dataTables_wrapper {
                margin-top: -70px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        function deleteKeluarga(noKK) {
            Swal.fire({
                title: "Apakah Anda yakin menghapus User?",
                text: "Tindakan ini membuat user terhapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    $.ajax({
                        type: 'DELETE',
                        url: `{{ url('/rt/keluarga/${noKK}') }}`,
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}",
                            contentType: 'application/json'
                        },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire({
                                    title: "Terhapus!",
                                    text: "Keluarga berhasil dihapus.",
                                    icon: "success"
                                });

                                $('#keluarga-table').DataTable().ajax.reload();
                            }
                        }
                    });
                }
            });
        }
    </script>

    {{ $dataTable->scripts() }}
@endpush