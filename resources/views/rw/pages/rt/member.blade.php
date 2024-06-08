@extends('layouts.app')

@section('content_header')
    <h1>Data Ketua RT</h1>
@endsection

@section('breadcrumb')
    @livewire('admin.bread-crumb', [
      'links' => [],
      'active' => 'List RT'
    ])
@endsection

@section('content')
    <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
        <div class="d-flex justify-content-end">
            <a href="{{ url('rw/data-rt/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah RT</a>
        </div>

        {{ $dataTable->table() }}
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
        function confirmDelete(idPengurus) {
            Swal.fire({
                title: "Yakin menghapus RT ini?",
                text: "Kamu tidak bisa mengembalikan jika sudah dikonfirmasi!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yakin",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: `{{ url('rw/data-rt/${idPengurus}') }}`,
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}",
                            contentType: 'application/json'
                        },
                        success: function () {
                            Swal.fire({
                                title: "Menghapus RT!",
                                text: "Data RT berhasil diterima.",
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
